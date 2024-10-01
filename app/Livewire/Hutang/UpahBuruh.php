<?php

namespace App\Livewire\Hutang;

use App\Models\User;
use App\Models\UpahBuruh as ModelUpah;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class UpahBuruh extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['deleting' => 'destroy'];
    private $items;
    public $dataUser;
    public $detail;
    public $idBayar;
    public $delete;

    public $userid;
    public $amount;
    public $ket;

    protected $rules = [
        'userid'        => 'required',
        'amount'        => 'required',
        'ket'           => 'required',
    ];

    public function mount()
    {
        $this->getUser();
    }

    public function render()
    {
        $this->getBuruh();
        return view('livewire.hutang.upah-buruh', [
            'items'     => $this->items,
        ]);
    }

    public function getBuruh()
    {
        $this->items = DB::table('users')
                ->leftJoin('upah_buruhs', 'users.id', '=', 'upah_buruhs.user_id')
                ->where('users.level', '6')->where('upah_buruhs.status', 'pending')
                ->select('users.id', 'users.name', DB::raw('SUM(upah_buruhs.amount) as total_upah'))
                ->groupBy('users.id', 'users.name')
                ->paginate(10);
    }

    public function getUser()
    {
        $this->dataUser = User::where('level', '6')->select('id', 'name')->get();
    }

    public function tambahUpah()
    {
        $this->dispatch('modalTambah');
    }

    public function addUpah()
    {
        $this->validate();
        $data = [
            'user_id'       => $this->userid,
            'status'        => 'pending',
            'amount'        => $this->amount,
            'keterangan'    => $this->ket,
        ];
        
        try {
            ModelUpah::create($data);
            $this->dispatch('closeModal');
            $this->reset('userid', 'amount', 'ket');
            $this->dispatch('alert', [
                'title'     => 'Success',
                'message'   => 'Berhasil menyimpan data',
                'icon'     => 'success',
            ]);
        } catch (Exception $e) {
            $this->dispatch('alert', [
                'title'     => 'Opps',
                'message'   => 'Gagal menyimpan data',
                'icon'     => 'error',
                'error'     => $e->getMessage(),
            ]);
        }
    }

    public function detailJasa($id)
    {
        $this->detail = ModelUpah::where('user_id', $id)->where('status', 'pending')->get();
        $this->dispatch('modalDetail');
    }

    public function bayarJasa($id)
    {
        $this->detail = ModelUpah::where('user_id', $id)->where('status', 'pending')->get();
        $this->userid = $id;
        $this->dispatch('modalBayar');
    }

    public function prosesBayarJasa()
    {
        if ($this->detail->sum('amount') == $this->amount) {

            try {

                ModelUpah::where('user_id', $this->userid)->where('status', 'pending')
                        ->update([
                            'status'    => 'lunas',
                        ]);
                $this->dispatch('closeModal');
                $this->reset('userid', 'amount');
                $this->dispatch('alert', [
                    'title'     => 'Success',
                    'message'   => 'Data berhasi disimpan',
                    'icon'     => 'success',
                ]);

            } catch (Exception $e) {

                $this->dispatch('alert', [
                    'title'     => 'Oops',
                    'message'   => 'Gagal menyimpan data',
                    'icon'      => 'error',
                    'error'     => $e->getMessage(),
                ]);

            }
        } else {
            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Jumlah tidak sesuai',
                'icon'     => 'error',
            ]);
        }
    }

    public function confirmDelete($id)
    {
        $this->delete = $id;
        $this->dispatch('confirmDelete');
    }

    public function destroy()
    {
        try {
            $upah = ModelUpah::findOrFail($this->delete);
            $upah->delete();

            $this->dispatch('closeModal');
            $this->reset('delete');

            $this->dispatch('alert', [
                'title'     => 'Alert',
                'message'   => 'Data berhasi dihapus',
                'icon'     => 'success',
            ]);
            
        } catch (Exception $e) {

            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Data gagal dihapus',
                'icon'     => 'error',
                'error'     => $e->getMessage(),
            ]);

        }
    }
}
