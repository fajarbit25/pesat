<?php

namespace App\Livewire\Transaksi;

use App\Models\ExpenseRecord;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Expense extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['deleting' => 'destroy'];
    public $tanggal;
    public $monthYear;
    public $month;
    public $year;
    public $tipe;
    public $noted;
    public $userid;
    public $amount;
    public $delete;

    private $items;
    public $tipeFilter;

    protected $rules = [
        'tanggal'       => 'required',
        'tipe'          => 'required',
        'noted'         => 'required',
        'amount'        => 'required|integer',
    ];

    public function mount()
    {
        $this->tanggal = now()->format('Y-m-d'); // Format tanggal saat ini
        $this->monthYear = now()->format('Y-m'); // Default value for monthYear

        // Memisahkan tahun dan bulan jika monthYear sudah di-set
        list($this->year, $this->month) = explode('-', $this->monthYear);
    }

    public function render()
    {
        $this->getItems();
        return view('livewire.transaksi.expense', [
            'items'     => $this->items,
        ]);
    }

    public function getItems()
    {
        $query = $this->buildQuery();

        $this->items = $query->paginate(10);
    }

    protected function buildQuery()
    {
        // Memisahkan tahun dan bulan jika monthYear sudah di-set
        list($this->year, $this->month) = explode('-', $this->monthYear);

        $query = ExpenseRecord::join('users', 'users.id', '=', 'expense_records.user_id')
                            ->whereYear('date', $this->year)
                            ->whereMonth('date', $this->month)
                            ->select('expense_records.*', 'users.name')
                            ->orderBy('date', 'DESC');

        if (!empty($this->tipeFilter)) {
            $query->where('tipe', $this->tipeFilter);
        }

        return $query;
    }

    public function modalAdd()
    {
        $this->dispatch('modalAdd');
    }

    public function saveRecord()
    {
        $this->validate();

        try {
            $data = [
                'date'      => $this->tanggal,
                'tipe'      => $this->tipe,
                'noted'     => $this->noted,
                'user_id'   => Auth::user()->id,
                'amount'    => $this->amount,
            ];
            ExpenseRecord::create($data);
            $this->dispatch('closeModal');
            $this->reset('tipe', 'noted', 'userid', 'amount');
            $this->dispatch('alert', [
                'title'     => 'Success',
                'message'   => 'Catatan berhasil ditambahkan',
                'icon'      => 'success'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Gagal menyimpan data',
                'icon'      => 'error',
                'error'     => $e->getMessage(),
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
            $expense = ExpenseRecord::find($this->delete);
            $expense->delete();
            $this->reset('delete');

            $this->dispatch('alert', [
                'title'     => 'Deleted',
                'message'   => 'Data berhasil dihapus!',
                'icon'      => 'warning'
            ]);

        } catch (\Exception $e) {
            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Gagal menyimpan data',
                'icon'      => 'error',
                'error'     => $e->getMessage(),
            ]);
        }
    }
}
