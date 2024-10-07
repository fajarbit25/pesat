<?php

namespace App\Livewire\Transaksi;

use App\Models\EggMutasi;
use App\Models\EggTransTemp;
use App\Models\EggTrx;
use App\Models\Hutang;
use App\Models\Medicine;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Transaksi extends Component
{
    public $products;
    public $pay;
    public $disc;
    public $sumTx;
    public $qty;
    private $items;
    public $key;
    public $idEditQty;
    public $status;
    public $dataSupplier;
    public $supplier;

    public function mount()
    {
        $this->getSupplier();
    }

    public function render()
    {
        $this->getItems();
        $this->getProducts();
        $this->getSumTx();
        $this->updateddisc();
        return view('livewire.transaksi.transaksi', [
            'items' => $this->items,
        ]);
    }

    public function getItems()
    {
        $this->items = EggTransTemp::join('medicines', 'medicines.id', '=', 'egg_trans_temps.egg_id')
                        ->where('status', 'active')
                        ->select('egg_trans_temps.id', 'name', 'qty', 'egg_trans_temps.price', 'total', 'code')
                        ->get();
    }

    public function getSupplier()
    {
        $this->dataSupplier = User::where('level', '4')->select('id', 'name')->get();
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
                'price'         => $product->price,
                'total'         => $product->price,
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
        $this->validate([
            'status'    => 'required',
            'pay'       => 'required'
        ]);
        if ($this->pay == $this->sumTx) {
            try {
                //create trx
                $trx = EggTrx::create([
                    'idtransaksi'       => time(),
                    'user_id'           => Auth::user()->id,
                    'costumer_id'       => Auth::user()->id,
                    'tipetrx'           => 'pakan',
                    'payment_status'    => $this->status,
                    'trxtipe'           => 'pembelian',
                    'totalprice'        => $this->sumTx,
                    'disc'              => $this->disc
                ]);

                //update status temp
                EggTransTemp::where('status', 'active')
                    ->update([
                        'trx_id'        => $trx->idtransaksi,
                        'status'        => 'inactive',
                    ]);

                
                //Update Stock & create mutasi
                $temp = EggTransTemp::where('trx_id', $trx->idtransaksi)->get();
                foreach ($temp as $item) {

                    //load produk
                    $produk = Medicine::findOrFail($item->egg_id);
                    $stockAwal = $produk->stock;
                    $stockAkhir = $stockAwal+$item->qty;

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

                if ($this->status == 'pending') {
                    $tanggal = date('Y-m-d');
                    Hutang::create([
                        'tanggal'       => $tanggal,
                        'due_date'      => Carbon::parse($tanggal)->addDays(30),
                        'supplier'      => $this->supplier,
                        'user_id'       => Auth::user()->id,
                        'idtrx'         => $trx->idtransaksi,
                        'status'        => $this->status,
                        'jumlah'        => $this->sumTx,
                    ]);
                }

                return redirect()->route('inbound')->with('success','Transaksi tersimpan kedatabase!');

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
