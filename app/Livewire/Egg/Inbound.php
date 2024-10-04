<?php

namespace App\Livewire\Egg;

use App\Models\Egg;
use App\Models\EggMutasi;
use App\Models\EggSupplier;
use App\Models\EggTransTemp;
use App\Models\EggTrx;
use App\Models\HutangPlasma;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Inbound extends Component
{
    //public $dataEgg;
    public $bound; //jenis transaksi
    public $key = '';
    public $keyPelanggan = '';
    public $idPelanggan;
    public $custname;
    public $custHutang;
    public $items;
    public $sumTx;
    public $idEditQty;
    public $qty;
    public $disc = 0;
    public $pay;
    public $paymentStatus = 'pending';
    public $dataCust;
    public $cust;
    public $tipetrx; //Egg, Medic, Pakan

    public function mount($bound, $tipe, $userid)
    {
        
        $this->bound = $bound;
        $this->tipetrx = $tipe;
        $this->idPelanggan = $userid;

        $this->addPelanggan();
    }

    public function render()
    {
        $this->getTemp();
        $this->getSumTx();
        $this->updateddisc();
        $this->getCostumer();
        return view('livewire.egg.inbound', [
            'dataEgg' => $this->search(),
            'items'   => $this->items,
            'pelanggan' => $this->searchPelanggan(),
        ]);
    }

    public function getCostumer()
    {
        if ($this->bound == 'pembelian') {
            $this->cust = '1';
        } else {
            $this->dataCust = User::where('level', '5')->get();
        }
    }
    
    public function modalAdd()
    {
        $this->dispatch('modalAdd');
    }

    public function getTemp()
    {
        $data = EggTransTemp::join('eggs', 'eggs.id', '=', 'egg_trans_temps.egg_id')
                    ->where('status', 'active')
                    ->select('egg_trans_temps.id', 'name', 'qty', 'price', 'total', 'code')
                    ->get();
        $this->items = $data;
    }

    public function getSumTx()
    {
        $data = EggTransTemp::where('status', 'active')->sum('total');
        $this->sumTx = $data ?? 0;
    }

    public function editQty($id)
    {
        $temp = EggTransTemp::findOrFail($id);
        $this->qty = $temp->qty;
        $this->idEditQty = $id;
        $this->dispatch('modalEditQty');
    }

    public function updateQty()
    {
        try {
            $temp = EggTransTemp::findOrFail($this->idEditQty);
            $price = $temp->price;
            $newTotal = $this->qty*$price;

            $temp->update(['total' => $newTotal, 'qty' => $this->qty]);
            $this->reset('qty');

            $this->dispatch('closeModal');
        } catch (Exception $e) {
            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Gagal mengedit item',
                'icon'      => 'error', 
                'error'     => $e,
            ]);
        }
        
    }

    public function deleteTemp($id)
    {
        try {
            $temp = EggTransTemp::findOrFail($id);
            $temp->delete();
        } catch (Exception $e) {
            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Gagal menghapus item',
                'icon'      => 'error', 
                'error'     => $e,
            ]);
        }
    }


    public function search()
    {
        if ($this->key == '') {
            $data = Egg::all();
        } else {
            // Pencarian di beberapa kolom menggunakan orWhere
            $data = Egg::where('code', 'like', '%'.$this->key.'%')
            ->orWhere('name', 'like', '%'.$this->key.'%')
            ->orWhere('sellprice', 'like', '%'.$this->key.'%')
            ->orWhere('stock', 'like', '%'.$this->key.'%')
            ->get();
        }
        return $data;    
    }

    public function addPelanggan()
    {
        //$this->reset('custname', 'custHutang', 'idPelanggan');
        //$this->idPelanggan = $id;

        $user = User::findOrFail($this->idPelanggan);
        $hutang = HutangPlasma::where('user_id', $user->id)->first();

        $this->custHutang = $hutang->hutang;
        $this->custname = $user->name;
        $this->dispatch('closeModal');
    }

    public function searchPelanggan()
    {
        if ($this->keyPelanggan == '') {
            $data = User::all();
        } else {
            // Pencarian di beberapa kolom menggunakan orWhere
            $data = User::where('name', 'like', '%'.$this->keyPelanggan.'%')
            ->orWhere('phone', 'like', '%'.$this->keyPelanggan.'%')
            ->orWhere('address', 'like', '%'.$this->keyPelanggan.'%')
            ->get();
        }
        return $data;    
    }

    public function addEgg($id)
    {
        $eggs = Egg::findOrFail($id);
        if ($this->bound == 'pembelian') {
            $price = $eggs->buyprice;
        } else {
            $price = $eggs->sellprice;
        }
        try {
            EggTransTemp::create([
                'egg_id'        => $id,
                'qty'           => 1,
                'price'         => $price,
                'total'         => $price,
                'status'        => 'active',
            ]);
            $this->dispatch('closeModal');
        } catch (Exception $e) {
            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Gagal menambahkan item',
                'icon'      => 'error', 
            ]);
        }
    }

    public function modalPayment()
    {

        $this->dispatch('modalPayment');
    }

    public function updateddisc()
    {
        $this->disc = (float)($this->disc ?? 0); // Pastikan $this->disc selalu berupa angka
        $this->sumTx = $this->sumTx - $this->disc;
    }


    public function prosesPayment()
    {
        $this->validate([
            'pay'               => 'required|integer',
            'idPelanggan'       => 'required',
        ]);

        $idtransaksi = time();
        $totalTrx = $this->sumTx-$this->disc;
        $data = [
            'idtransaksi'       => $idtransaksi,
            'user_id'           => Auth::user()->id,
            'costumer_id'       => $this->idPelanggan,
            'tipetrx'           => $this->tipetrx,
            'payment_status'    => $this->paymentStatus,
            'trxtipe'           => $this->bound,
            'totalprice'        => $this->sumTx,
            'disc'              => $this->disc,
        ];

        if ($this->pay >= $totalTrx) {

            try {

                //Simpan ke tabel transaksi
                EggTrx::create($data);

                //update table transaksi sementara
                EggTransTemp::where('status', 'active')->update([
                    'trx_id'    => $idtransaksi,
                    'status'    => 'inactive',
                ]);

                //simpan data ke mutasi
                $trxTemp = EggTransTemp::where('trx_id', $idtransaksi)->get();
                foreach($trxTemp as $tx){
                    $eggs = Egg::findOrFail($tx->egg_id);
                    
                    //stockAkhir
                    if ($this->bound == 'pembelian') {
                        $sa = $eggs->stock+$tx->qty ?? 0;
                    } else {
                        $sa = $eggs->stock-$tx->qty ?? 0;
                    }

                    EggMutasi::create([
                        'egg_id'        => $tx->egg_id,
                        'supplier_id'   => $this->idPelanggan,
                        'qty'           => $tx->qty,
                        'stockawal'     => $eggs->stock,
                        'atockakhir'    => $sa,
                        'date'          => date('Y-m-d'),
                        'user_id'       => Auth::user()->id,
                    ]);

                    //update stok telur
                    $updateStock = Egg::findOrFail($tx->egg_id);
                    $updateStock->update(['stock' => $sa]);
                }

                if ($this->bound == 'pembelian') {

                    $hutang = HutangPlasma::where('user_id', $this->idPelanggan)->first();
                    $hutangAwal = $hutang->hutang;
                    if ($this->bound == 'pembelian') {
                        $hutangAkhir = $hutangAwal-$totalTrx;
                    } else {
                        $hutangAkhir = $hutangAwal+$totalTrx;
                    }

                    HutangPlasma::where('user_id', $this->idPelanggan)->update([
                        'hutang' => $hutangAkhir
                    ]);
                    $this->custHutang = $hutangAkhir;

                }

                return redirect('hutang/'.$this->idPelanggan.'/report')->with('success', 'Data berhasil disimpan.');

            } catch (Exception $e) {
                $this->dispatch('alert', [
                    'title'     => 'Terjadi kesalahan',
                    'message'   => 'Periksa mutasi stok anda',
                    'icon'      => 'error',
                    'error'     => $e->getMessage(),
                ]);
            }

        } else {
            $this->dispatch('alert', [
                'title'     => 'Uang Kurang',
                'message'   => 'Input Jumlah bayar dengan benar',
                'icon'      => 'error',
            ]);
        }


    }

    public function modalPelanggan()
    {
        $this->dispatch('modalPelanggan');
    }
}

