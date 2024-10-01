<?php

namespace App\Livewire\Hutang;

use App\Models\EggTransTemp;
use App\Models\EggTrx;
use App\Models\Hutang;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Debt extends Component
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
        return view('livewire.hutang.debt', [
            'items'     => $this->items,
        ]);
    }

    public function getHutang()
    {
        if ($this->key == "") {
            $this->items = Hutang::join('users', 'users.id', '=', 'hutangs.supplier')
                    ->where('hutangs.status', 'pending')
                    ->select(
                        'users.id',
                        'users.name',
                        'users.phone',
                        'users.address',
                        DB::raw('SUM(hutangs.jumlah) as total_jumlah'),
                        DB::raw('MAX(hutangs.tanggal) as last_tanggal'),
                        DB::raw('MAX(hutangs.due_date) as last_due_date')
                    )
                    ->groupBy('users.id', 'users.name', 'users.phone', 'users.address')
                    ->orderBy('hutangs.updated_at', 'DESC')
                    ->paginate(10);
        } else {
            $this->items = Hutang::join('users', 'users.id', '=', 'hutangs.supplier')
                    ->where(function($query) {
                        $query->where('users.name', 'like', '%'.$this->key.'%')
                            ->orWhere('users.address', 'like', '%'.$this->key.'%');
                    })
                    ->where('hutangs.status', 'pending')
                    ->select(
                        'users.id',
                        'users.name',
                        'users.phone',
                        'users.address',
                        DB::raw('SUM(hutangs.jumlah) as total_jumlah'),
                        DB::raw('MAX(hutangs.tanggal) as last_tanggal'),
                        DB::raw('MAX(hutangs.due_date) as last_due_date')
                    )
                    ->groupBy('users.id', 'users.name', 'users.phone', 'users.address')
                    ->orderBy('hutangs.updated_at', 'DESC')
                    ->paginate(10);
        }
        
    }

    public function bayarHutang($id)
    {
        $this->idBayar = $id;
        $this->totalHutang = Hutang::where('supplier', $this->idBayar)
                ->where('status' , 'pending')->sum('jumlah');
        $this->dispatch('modalBayar');
    }

    public function prosesBayar()
    {
        if ($this->totalHutang == $this->pay) {

            try {
                $hutang = Hutang::where('supplier', $this->idBayar)
                            ->where('status' , 'pending')->get();
                foreach ($hutang as $htg) {
                    EggTrx::where('idtransaksi', $htg->idtrx)->update([
                        'payment_status'    => 'lunas',
                    ]);
                }

                Hutang::where('supplier', $this->idBayar)
                            ->where('status' , 'pending')
                            ->update([
                                'status'    => 'lunas'
                            ]);
                

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

