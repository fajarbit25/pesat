<?php

namespace App\Livewire\Transaksi;

use App\Models\EggMutasi;
use App\Models\EggTransTemp;
use App\Models\EggTrx;
use App\Models\HutangPlasma;
use App\Models\Medicine;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Pos extends Component
{
    public $products;
    public $pay;
    public $disc;
    public $sumTx;
    public $qty;
    private $items;
    public $key;
    public $idEditQty;

    public $keyPelanggan;
    public $idPelanggan;
    public $custname;
    public $dataCust;
    public $custHutang;

    public $tanggal;

    public function mount($userid)
    {
        $this->idPelanggan = $userid;
        $this->tanggal = date('Y-m-d');
        $this->addPelanggan();
    }

    public function render()
    {
        $this->getCostumer();
        $this->getProducts();
        $this->getItems();
        $this->getSumTx();
        $this->updateddisc();
        return view('livewire.transaksi.pos', [
            'items'         => $this->items,
            'pelanggan'     => $this->dataCust,
        ]);
    }

    public function getItems()
    {
        $this->items = EggTransTemp::join('medicines', 'medicines.id', '=', 'egg_trans_temps.egg_id')
                        ->where('status', 'active')
                        ->select('egg_trans_temps.id', 'name', 'qty', 'egg_trans_temps.price', 'total', 'code')
                        ->get();
    }

    public function modalPelanggan()
    {
        $this->dispatch('modalPelanggan');
    }

    public function addPelanggan()
    {
        // $this->reset('custname', 'custHutang', 'idPelanggan');
        // $this->idPelanggan = $id;

        $user = User::findOrFail($this->idPelanggan);
        $hutang = HutangPlasma::where('user_id', $user->id)->first();

        $this->custHutang = $hutang->hutang;
        $this->custname = $user->name;
        $this->dispatch('closeModal');
    }

    public function getCostumer()
    {
        if ($this->keyPelanggan == "") {
            $this->dataCust = User::where('level', '3')->get();
        } else {
            $this->dataCust = User::where('name', 'like', '%'.$this->keyPelanggan.'%')
                        ->orWhere('phone', 'like', '%'.$this->keyPelanggan.'%')
                        ->orWhere('address', 'like', '%'.$this->keyPelanggan.'%')
                        ->get();
        }
    }

    public function modalAdd()
    {
        $this->dispatch('modalAdd');
    }

    public function getProducts()
    {
        if ($this->key == '') {
            $this->products = Medicine::where('code', '!=', 'PELUNASAN')->get();
        } else {
            $this->products = Medicine::where('code', 'like', '%'.$this->key.'%')
                        ->orWhere('name', 'like', '%'.$this->key.'%')
                        ->get();
        }
    }

    public function addproducts($id)
    {
        $product = Medicine::find($id);
        try {
            EggTransTemp::create([
                'egg_id'        => $id,
                'qty'           => 1,
                'price'         => $product->sellingprice,
                'total'         => $product->sellingprice,
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

    public function editQty($id)
    {
        $qtyAwal = EggTransTemp::find($id);
        $this->idEditQty = $id;
        $this->qty = $qtyAwal->qty;
        $this->dispatch('modalEditQty');
    }

    public function updateQty()
    {
        $qtyAwal = EggTransTemp::find($this->idEditQty);
        $price = $qtyAwal->price;
        $qtyAwal->update(['qty' => $this->qty, 'total' => $price*$this->qty]);
        $this->reset('qty', 'idEditQty');
        $this->dispatch('closeModal');
    }

    public function getSumTx()
    {
        $data = EggTransTemp::where('status', 'active')->sum('total');
        $this->sumTx = $data ?? 0;
    }

    public function deleteTemp($id)
    {
        $temp = EggTransTemp::find($id);
        $temp->delete();
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
        if ($this->pay == $this->sumTx) {
            try {
                //create trx
                $trx = EggTrx::create([
                    'idtransaksi'       => time(),
                    'user_id'           => Auth::user()->id,
                    'costumer_id'       => $this->idPelanggan,
                    'tipetrx'           => 'pakan',
                    'payment_status'    => 'lunas',
                    'trxtipe'           => 'penjualan',
                    'totalprice'        => $this->sumTx,
                    'disc'              => $this->disc,
                    'created_at'        => $this->tanggal.' '.date('H:i:s'),
                ]);

                //update status temp
                EggTransTemp::where('status', 'active')
                    ->update([
                        'trx_id'        => $trx->idtransaksi,
                        'status'        => 'inactive',
                        'created_at'        => $this->tanggal.' '.date('H:i:s'),
                    ]);

                
                //Update Stock & create mutasi
                $temp = EggTransTemp::where('trx_id', $trx->idtransaksi)->get();
                foreach ($temp as $item) {

                    //load produk
                    $produk = Medicine::findOrFail($item->egg_id);
                    $stockAwal = $produk->stock;
                    $stockAkhir = $stockAwal-$item->qty;

                    //create mutasi
                    EggMutasi::create([
                        'egg_id'        => $item->egg_id,
                        'supplier_id'   => Auth::user()->id,
                        'qty'           => $item->qty,
                        'stockawal'     => $produk->stock,
                        'atockakhir'    => $stockAkhir,
                        'date'          => date('Y-m-d'),
                        'user_id'       => Auth::user()->id,
                    ]);

                    //update stock
                    $produk->update([
                        'stock'     => $stockAkhir,
                    ]);
                }

                //update hutang plasma
                $hutang = HutangPlasma::where('user_id', $this->idPelanggan)->first();
                $hutangAwal = $hutang->hutang;
                $hutangAkhir = $hutangAwal+$this->sumTx-$this->disc;

                HutangPlasma::where('user_id', $this->idPelanggan)->update([
                    'hutang' => $hutangAkhir
                ]);
                $this->custHutang = $hutangAkhir;

                return redirect(url('hutang/'.$this->idPelanggan.'/detail'))->with('success','Transaksi tersimpan kedatabase!');

            } catch (Exception $e) {
                $this->dispatch('alert', [
                    'title'     => 'Oops',
                    'message'   => 'Gagal Proses Gagal, Periksa Mutasi anda',
                    'icon'      => 'error',
                    'error'     => $e->getMessage(),
                ]);
            }
        } else {
            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Masukan jumlah transaksi dengan benar',
                'icon'      => 'error',
            ]);
        }
    }
}