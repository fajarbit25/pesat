<?php

namespace App\Livewire\Egg;

use App\Models\Egg;
use App\Models\EggMutasi;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['deleting' => 'destroyEgg'];
    public $edit;
    public $deletes;
    private $items;
    public $name;
    public $stock;
    public $buyprice;
    public $sellprice;

    //update stok;
    public $stockAwal;
    public $newStock;

    protected $rules = [
        'name'      => 'required|min:3',
        'stock'     => 'required|integer',
        'buyprice'  => 'required|integer',
        'sellprice' => 'required|integer',
    ];
    public function render()
    {
        $this->getEgg();
        return view('livewire.egg.index', [
            'items'     => $this->items,
        ]);
    }

    public function getEgg()
    {
        $data = Egg::paginate(10);
        $this->items = $data;
    }

    public function modalCreate()
    {
        $this->reset('name', 'stock', 'buyprice', 'sellprice', 'edit');
        $this->dispatch('modalCreate');
    }

    public function addEgg()
    {
        $this->validate();
        $egg = Egg::count();
        $code = 'EGG'.$egg+100;
        try {
            Egg::create([
                'code'      => $code,
                'name'      => strtoupper($this->name),
                'stock'     => $this->stock,
                'buyprice'  => $this->buyprice,
                'sellprice' => $this->sellprice,
            ]);
            $this->dispatch('closeModal');
            $this->reset('name', 'stock', 'buyprice', 'sellprice');
            $this->dispatch('alert', [
                'title'     => 'Success',
                'message'   => 'Telur berhasil disimpan!',
                'icon'      => 'success',
            ]);
        } catch (Exception $e) {
            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Telur gagal disimpan!',
                'icon'      => 'error',
                'error'     => $e,
            ]);
        }
    }

    public function edits($id)
    {
        $this->edit = $id;
        $this->dispatch('modalCreate');

        $egg = Egg::findOrFail($this->edit);
        $this->name = $egg->name ?? '';
        $this->buyprice = $egg->buyprice ?? '';
        $this->sellprice = $egg->sellprice ?? '';
    }

    public function editEgg()
    {
        $data = [
            'name'      => $this->name,
            'buyprice'  => $this->buyprice,
            'sellprice' => $this->sellprice,
        ];

        try {
            $eggs = Egg::findOrFail($this->edit);
            $eggs->update($data);
            $this->dispatch('closeModal');
            $this->reset('name', 'buyprice', 'sellprice', 'edit');
            $this->dispatch('alert', [
                'title'     => 'Success',
                'message'   => 'Telur berhasil diedit!',
                'icon'      => 'success',
            ]);
        } catch (Exception $e) {
            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Telur gagal diedit!',
                'icon'      => 'error',
                'error'     => $e,
            ]);
        }
    }

    public function delete($id)
    {
        $this->deletes = $id;
        $this->dispatch('confirmDelete');
    }

    public function destroyEgg()
    {
        try {
            $egg = Egg::findOrFail($this->deletes);
            $egg->delete();
            $this->reset('deletes');
            $this->dispatch('alert', [
                'title'     => 'Success',
                'message'   => 'Telur berhasil diedit!',
                'icon'      => 'success',
            ]);
        } catch (Exception $e) {
            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Telur gagal diedit!',
                'icon'      => 'error',
                'error'     => $e,
            ]);
        }
    }

    public function editStock($id, $sa)
    {
        $this->edit = $id;
        $this->stockAwal = $sa;
        $this->dispatch('editStock');
    }

    public function updateStock()
    {
        $this->validate([
            'newStock'      => 'required',
        ]);

        try {
            //Create Mutasi
            EggMutasi::create([
                'egg_id'        => $this->edit,
                'supplier_id'   => 0,
                'qty'           => $this->newStock,
                'stockawal'     => $this->stockAwal,
                'atockakhir'    => $this->newStock,
                'date'          => date('Y-m-d'),
                'user_id'       => Auth::user()->id,
            ]);

            //Update stock
            $telur = Egg::findOrFail($this->edit);
            $telur->update([
                'stock'     => $this->newStock,
            ]);

            $this->dispatch('closeModal');

            $this->reset('edit', 'stockAwal', 'newStock');

            $this->dispatch('alert', [
                'title'     => 'Success',
                'message'   => 'Stock Telur berhasil diedit!',
                'icon'      => 'success',
            ]);

        } catch (Exception $e) {
            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Stock Telur gagal diedit!',
                'icon'      => 'error',
                'error'     => $e->getMessage(),
            ]);
        }

        


    }
}
