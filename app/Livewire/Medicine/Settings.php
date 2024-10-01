<?php

namespace App\Livewire\Medicine;

use App\Models\MedicCat;
use App\Models\MedicPackaging;
use App\Models\MedicUnit;
use Exception;
use Livewire\Component;

class Settings extends Component
{
    protected $listeners = [
        'deletingCat'       => 'destroyCat',
        'deletingUnit'      => 'destroyUnit',
        'deletingPack'      => 'destroyPack',
    ];
    public $idEditCat;
    public $idDeleteCat;
    public $dataCat;
    public $dataUnit;
    public $dataPack;

    public $code;
    public $cat;

    public $idEditUnit;
    public $idDeleUnit;
    public $unit;

    public $idEditPack;
    public $idDeletePack;
    public $pack;

    public function mount()
    {
        $this->getCat();
        $this->getUnit();
        $this->getPack();
    }

    public function render()
    {
        return view('livewire.medicine.settings');
    }

    public function getCat()
    {
        $data = MedicCat::all();
        $this->dataCat = $data;
    }

    public function getUnit()
    {
        $data = MedicUnit::all();
        $this->dataUnit = $data;
    }

    public function getPack()
    {
        $data = MedicPackaging::all();
        $this->dataPack = $data;
    }

    public function modalAddCat()
    {
        $this->dispatch('modalAddCat');
    }

    public function addCat()
    {
        $this->validate([
            'code'      => 'required|string|max:3',
            'cat'       => 'required',
        ]);

        try {
            $data = [
                'code'      => $this->code,
                'category'  => $this->cat,
            ];
            MedicCat::create($data);

            $this->dispatch('closeModal');
            $this->reset('code', 'cat');
            $this->getCat();
            $this->dispatch('alert', [
                'title'     => 'Success',
                'message'   => 'Category ditambahkan!',
                'icon'      => 'success'
            ]);
        } catch (Exception $e) {
            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Category gagal ditambahkan!',
                'icon'      => 'error',
                'error'     => $e
            ]);
        }
    }

    public function editCat($id)
    {
        $this->idEditCat = $id;
        $data = MedicCat::findOrFail($this->idEditCat);

        $this->cat = $data->category;
        $this->code = $data->code;

        $this->dispatch('modalAddCat');
    }

    public function updateCat()
    {
        $this->validate([
            'code'      => 'required|string|max:3',
            'cat'       => 'required',
        ]);

        try {
            $cats = MedicCat::findOrFail($this->idEditCat);
            $cats->update([
                'code'      => $this->code,
                'category'  => $this->cat,
            ]);
            $this->dispatch('closeModal');
            $this->reset('code', 'cat', 'idEditCat');
            $this->getCat();
            $this->dispatch('alert', [
                'title'     => 'Success',
                'message'   => 'Category diedit!',
                'icon'      => 'success'
            ]);
        } catch (Exception $e) {
            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Category gagal diperbaharui!',
                'icon'      => 'error',
                'error'     => $e
            ]);
        }
    }

    public function deleteCat($id)
    {
        $this->idDeleteCat = $id;
        $this->dispatch('confirmDeleteCat');
    }

    public function destroyCat()
    {
        try {
            $cats = MedicCat::findOrFail($this->idDeleteCat);
            $cats->delete();
            $this->getCat();
            $this->dispatch('alert', [
                'title'     => 'Success',
                'message'   => 'Category berhasil dihapus!',
                'icon'      => 'success'
            ]);
        } catch (Exception $e) {
            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Category gagal dihapus!',
                'icon'      => 'error',
                'error'     => $e
            ]);
        }
    }

    public function modalUnit()
    {
        $this->dispatch('modalUnit');
    }

    public function addUnit()
    {
        $this->validate(['unit' => 'required']);
        try {
            MedicUnit::create(['unit' => $this->unit]);
            $this->dispatch('closeModal');
            $this->getUnit();
            $this->reset('unit');
            $this->dispatch('alert', [
                'title'     => 'Success',
                'message'   => 'Satuan ditambahkan!',
                'icon'      => 'success'
            ]);
        } catch (Exception $e) {
            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Satuan gagal ditambahkan!',
                'icon'      => 'error',
                'error'     => $e
            ]);
        }
    }

    public function editUnit($id)
    {
        $this->reset('unit', 'idEditUnit');
        $this->idEditUnit = $id;
        $unit = MedicUnit::findOrFail($this->idEditUnit);
        $this->unit = $unit->unit;

        $this->dispatch('modalUnit');
    }

    public function updateUnit()
    {
        $this->validate(['unit' => 'required']);
        try {
            $unit = MedicUnit::findOrFail($this->idEditUnit);
            $unit->update([
                'unit'  => $this->unit,
            ]);
            $this->dispatch('closeModal');
            $this->getUnit();
            $this->reset('unit', 'idEditUnit');
            $this->dispatch('alert', [
                'title'     => 'Success',
                'message'   => 'Satuan diedit!',
                'icon'      => 'success'
            ]);
        } catch (Exception $e) {
            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Satuan gagal diedit!',
                'icon'      => 'error',
                'error'     => $e
            ]);
        }
    }

    public function deleteUnit($id)
    {
        $this->idDeleUnit = $id;
        $this->dispatch('confirmDeleteUnit');
    }

    public function destroyUnit()
    {
        try {
            $units = MedicUnit::findOrFail($this->idDeleUnit);
            $units->delete();
            $this->reset('idDeleUnit');
            $this->getUnit();
            $this->dispatch('alert', [
                'title'     => 'Success',
                'message'   => 'Satuan dihapus!',
                'icon'      => 'warning',
            ]);
        } catch (Exception $e) {
            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Satuan gagal dihapus!',
                'icon'      => 'error',
            ]);
        }
    }

    public function modalCreatePack()
    {
        $this->dispatch('modalPack');
    }

    public function addPack()
    {
        $this->validate(['pack' => 'required']);
        try {
            MedicPackaging::create(['packaging' => $this->pack]);
            $this->reset('pack');
            $this->dispatch('closeModal');
            $this->getPack();
            $this->dispatch('alert', [
                'title'     => 'Success', 
                'message'   => 'Kemasan ditambahkan',
                'icon'      => 'success'
            ]);
        } catch (Exception $e) {
            $this->dispatch('alert', [
                'title'     => 'Oops', 
                'message'   => 'Kemasan gagal ditambahkan',
                'icon'      => 'error',
                'error'     => $e,
            ]);
        }
    }

    public function editPack($id)
    {
        $this->idEditPack = $id;
        $packs = MedicPackaging::findOrFail($this->idEditPack);
        $this->pack = $packs->packaging;

        $this->dispatch('modalPack');
    }

    public function updatePack()
    {
        $this->validate(['pack' => 'required']);
        try {
            $packs = MedicPackaging::findOrFail($this->idEditPack);
            $packs->update(['packaging' => $this->pack]);
            $this->dispatch('closeModal');
            $this->reset('idEditPack', 'pack');
            $this->getPack();
            $this->dispatch('alert', [
                'title'     => 'Success', 
                'message'   => 'Kemasan diperbaharui',
                'icon'      => 'success'
            ]);
        } catch (Exception $e) {
            $this->dispatch('alert', [
                'title'     => 'Oops', 
                'message'   => 'Kemasan gagal diperbaharui!',
                'icon'      => 'error',
                'error'     => $e,
            ]);
        }
    }

    public function deletePack($id)
    {
        $this->idDeletePack = $id;
        $this->dispatch('confirmDeletePack');
    }

    public function destroyPack()
    {
        try {
            $packs = MedicPackaging::findOrFail($this->idDeletePack);
            $packs->delete();
            $this->getPack();
            $this->dispatch('alert', [
                'title'     => 'Success', 
                'message'   => 'Kemasan berhasil dihapus',
                'icon'      => 'warning'
            ]);
        } catch (Exception $e) {
            $this->dispatch('alert', [
                'title'     => 'Oops', 
                'message'   => 'Kemasan gagal dihapus!',
                'icon'      => 'error',
                'error'     => $e,
            ]);
        }
    }
}
