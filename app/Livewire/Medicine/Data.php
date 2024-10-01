<?php

namespace App\Livewire\Medicine;

use App\Models\MedicCat;
use App\Models\Medicine as ModelMedicine;
use App\Models\MedicPackaging;
use App\Models\MedicSupplier;
use App\Models\MedicUnit;
use App\Models\User;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['deleting' => 'destroy'];
    private $items;
    public $edit;
    public $delete;

    public $name;
    public $cat;
    public $unit;
    public $packaging;
    public $stock;
    public $price;
    public $sellprice;
    public $jenis;
    public $supplier;

    public $dataCat;
    public $dataUnit;
    public $dataPack;
    public $dataSupplier;

    public function mount()
    {
        $this->getUtility();
        $this->getSupplier();
    }

    protected $rules = [
        'name'          => 'required|max:255',
        'jenis'         => 'required',
        'cat'           => 'required',
        'unit'          => 'required',
        'packaging'     => 'required',
        'stock'         => 'required',
        'price'         => 'required',
        'sellprice'     => 'required',
    ];

    public function render()
    {
        $this->getMedicine();
        return view('livewire.medicine.data', [
            'items'     => $this->items,
        ]);
    }

    public function getUtility()
    {
        $cat = MedicCat::all();
        $unit = MedicUnit::all();
        $pack = MedicPackaging::all();
        $this->dataCat = $cat;
        $this->dataUnit = $unit;
        $this->dataPack = $pack;
    }

    public function modalCreate()
    {
        $this->reset('name', 'cat', 'unit', 'packaging', 'stock', 'price', 'sellprice', 'edit');
        $this->dispatch('modalCreate');
    }

    public function addMedic()
    {
        $this->validate();
        $medic = ModelMedicine::where('cat', $this->cat)->count();
        $cat = MedicCat::findOrFail($this->cat);
        $catcode = $cat->code;
        $catNumber = $medic+1001;
        $code = $catcode.$catNumber;

        try {
            $data = [
                'code'      => $code,
                'name'      => strtoupper($this->name),
                'jenis'     => $this->jenis,
                'cat'       => $this->cat,
                'unit'      => $this->unit,
                'packaging' => $this->packaging,
                'stock'     => $this->stock,
                'price'     => $this->price,
                'sellingprice' => $this->sellprice ,
                'supplier'  => $this->supplier,
            ];

            ModelMedicine::create($data);

            $this->dispatch('closeModal');
            $this->reset('name', 'cat', 'unit', 'packaging', 'stock', 'price', 'sellprice');
            $this->dispatch('alert', [
                'title'     => 'Success',
                'message'   => 'Data obat berhasil disimpan!',
                'icon'      => 'success'
            ]);
        } catch (Exception $e) {
            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Data obat gagal disimpan!',
                'icon'      => 'warning',
                'error'     => $e,
            ]);
        }
    }

    public function getMedicine()
    {
        $data = ModelMedicine::join('medic_cats', 'medic_cats.id', '=', 'medicines.cat')
                        ->join('medic_packagings', 'medic_packagings.id', '=', 'medicines.packaging')
                        ->join('medic_units', 'medic_units.id', '=', 'medicines.unit')
                        ->join('users', 'users.id', '=', 'medicines.supplier')
                        ->select('medicines.id', 'medicines.name', 'category', 'medic_units.unit', 'sellingprice as price', 'stock', 'medicines.code',
                        'medic_packagings.packaging', 'jenis', 'users.name as suppliername')
                        ->paginate(10);
        $this->items = $data;
    }

    public function getSupplier()
    {
        $this->dataSupplier = User::where('level', '4')->select('name', 'id')->get();
    }

    public function edits($id)
    {
        $this->edit = $id;
        $data = ModelMedicine::findOrFail($this->edit);

        $this->name = $data->name;
        $this->jenis = $data->jenis;
        $this->cat = $data->cat;
        $this->unit = $data->unit;
        $this->packaging = $data->packaging;
        $this->stock = $data->stock;
        $this->price = $data->price;
        $this->sellprice = $data->sellingprice;
        $this->supplier = $data->supplier;

        $this->dispatch('modalCreate');
    }

    public function editMedic()
    {
        $this->validate();
        
        try {
            $medic = ModelMedicine::findOrFail($this->edit);
            $medic->update([
                'name'      => strtoupper($this->name),
                'jenis'     => $this->jenis,
                'cat'       => $this->cat,
                'unit'      => $this->unit,
                'packaging' => $this->packaging,
                'stock'     => $this->stock,
                'price'     => $this->price,
                'sellingprice' => $this->sellprice ,
                'supplier'  => $this->supplier,
            ]);

            $this->dispatch('closeModal');
            $this->reset('name', 'cat', 'unit', 'packaging', 'stock', 'price', 'sellprice', 'edit');
            $this->dispatch('alert', [
                'title'     => 'Success',
                'message'   => 'Data obat berhasil diubah!',
                'icon'      => 'success'
            ]);
        } catch (Exception $e) {
            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Data obat gagal diubah!',
                'icon'      => 'warning',
                'error'     => $e,
            ]);
        }
    }

    public function deletes($id)
    {
        $this->delete = $id;
        $this->dispatch('confirmDelete');
    }

    public function destroy()
    {
        try {
            $medic = ModelMedicine::findOrFail($this->delete);
            $medic->delete();
            $this->reset('delete');
            $this->dispatch('alert', [
                'title'     => 'Success',
                'message'   => 'Data obat berhasil dihapus!',
                'icon'      => 'success'
            ]);
        } catch (Exception $e) {
            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Data obat gagal dihapus!',
                'icon'      => 'warning',
                'error'     => $e,
            ]);
        }
    }

}
