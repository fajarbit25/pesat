<?php

namespace App\Livewire\Hutang;

use App\Models\EggTrx;
use App\Models\HutangPlasma;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    private $items;
    public $edit;
    public $delete;
    public $key = "";
    public $idBayar;
    public $totalHutang;
    public $pay;

    public function render()
    {
        $this->getHutang();
        return view('livewire.hutang.index', [
            'items'     => $this->items,
        ]);
    }

    public function getHutang()
    {
        if ($this->key == "") {
            $this->items = HutangPlasma::join('users', 'users.id', '=', 'hutang_plasmas.user_id')
                ->select('users.id', 'name', 'phone', 'address', 'hutang')
                ->orderBy('hutang_plasmas.updated_at', 'DESC')
                ->paginate(10);
        } else {
            $this->items = HutangPlasma::join('users', 'users.id', '=', 'hutang_plasmas.user_id')
                ->where('users.name', 'like', '%'.$this->key.'%')
                ->orWhere('users.address', 'like', '%'.$this->key.'%')
                ->select('users.id', 'name', 'phone', 'address', 'hutang')
                ->orderBy('hutang_plasmas.updated_at', 'DESC')
                ->paginate(10);
        }
        
    }

    public function bayarHutang($id)
    {
        $this->idBayar = $id;
        $this->totalHutang = HutangPlasma::where('user_id', $this->idBayar)->sum('hutang');
        $this->dispatch('modalBayar');
    }

    public function prosesBayar()
    {
        $pays = $this->pay*-1;
        if ($this->totalHutang == $pays) {

            try {

                //update trxTemp
                EggTrx::where('costumer_id', $this->idBayar)->where('trxtipe', 'pembelian')
                        ->update(['payment_status' => 'lunas']);
                
                //update hutang plasma
                HutangPlasma::where('user_id', $this->idBayar)
                        ->update(['hutang' => 0]);

                $this->dispatch('closeModal');

                $this->reset('idBayar', 'pay');

                $this->dispatch('alert', [
                    'title'     => 'Success',
                    'message'   => 'Proses selesai',
                    'icon'      => 'success',
                ]);

            } catch (Exception $e) {
                $this->dispatch('alert', [
                    'title'     => 'Oops',
                    'message'   => 'Terjadi kesalahan',
                    'icon'      => 'error',
                    'error'     => $e->getMessage(),
                ]);
            }

        } else {
            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Jumlah tidak sesuai',
                'icon'      => 'error',
            ]);
        }
    }
}


