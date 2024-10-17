<?php

namespace App\Livewire\Transaksi;

use App\Models\EggTransTemp;
use App\Models\EggTrx;
use App\Models\Hutang;
use App\Models\Medicine;
use Livewire\Component;
use Livewire\WithPagination;

class Inbound extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    protected $listeners = ['editing' => 'editTransaksi'];
    private $items;
    public $dataTrx;
    public $idtransaksi;

    public function render()
    {
        $this->getItems();
        return view('livewire.transaksi.inbound', [
            'items'=> $this->items
        ]);
    }

    public function getItems()
    {
        $this->items = EggTrx::join('users', 'users.id', '=', 'egg_trxes.costumer_id')
                    ->where('tipetrx', '!=', 'egg')->where('trxtipe', 'pembelian')
                    ->select('egg_trxes.*', 'users.name')
                    ->orderBy('egg_trxes.created_at', 'DESC')->paginate(10);
    }
    
    public function modalDetail($id)
    {
        $this->dataTrx = EggTransTemp::join('medicines', 'medicines.id', '=', 'egg_trans_temps.egg_id')
                                ->where('egg_trans_temps.trx_id', $id)
                                ->select('trx_id', 'medicines.name', 'medicines.code', 'qty', 'egg_trans_temps.price', 'total')
                                ->get();
        $this->dispatch('modalDetail');
    }

    public function confirmEdit($id)
    {
        $this->idtransaksi = $id;
        $this->dispatch('confirmEdit');
    }

    public function editTransaksi()
    {

        try {
            //delete temp actiiv
            EggTransTemp::where('status', 'active')->delete();

            //update temp
            EggTransTemp::where('trx_id', $this->idtransaksi)->update([
                'status'    => 'active',
            ]);

            //delete trx
            EggTrx::where('idtransaksi', $this->idtransaksi)->delete();

            //updateStock
            $temp = EggTransTemp::where('trx_id', $this->idtransaksi)->get();
            
            foreach ($temp as $item) {
                $medicine = Medicine::findOrFail($item->egg_id);
                $stock = $medicine->stock-$item->qty;
                $medicine->update([
                    'stock'     => $stock,
                ]);

                //update idtrx
                $eggtemp = EggTransTemp::findOrFail($item->id);
                $eggtemp->update([
                    'trx_id'    => null,
                ]);
            }

            //delete hutang
            Hutang::where('idtrx', $this->idtransaksi)->delete();

            return redirect('inbound/transaksi');

        } catch (\Exception $e) {
            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Terjadi Kesalahan',
                'icon'      => 'error',
                'error'     => $e->getMessage(),
            ]);
        }

        
    }
}
