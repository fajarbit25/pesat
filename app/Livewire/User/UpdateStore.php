<?php

namespace App\Livewire\User;

use App\Models\Store;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class UpdateStore extends Component
{
    use WithFileUploads;
    public $idstore;
    public $storename;
    public $slogan;
    public $shopaddress;
    public $norek;
    public $img;
    public $photo;

    protected $rules = [
        'storename'     => 'required',
        'slogan'        => 'required',
        'shopaddress'   => 'required',
        'norek'         => 'required',
    ];

    public function mount($id)
    {
        $this->idstore = $id;
        $this->getStore($id);   
    }

    public function render()
    {
        return view('livewire.user.update-store');
    }

    public function getStore($id)
    {
        $data = Store::findOrFail($id);

        $this->storename = $data->storename;
        $this->slogan = $data->slogan;
        $this->shopaddress = $data->shopaddress;
        $this->norek = $data->norek;
        $this->img = $data->logo;
    }

    public function updateToko()
    {
        $this->validate();
        $data = [
            'storename'     => $this->storename,
            'slogan'        => $this->slogan,
            'shopaddress'   => $this->shopaddress,
            'norek'         => $this->norek,
        ];
        Store::findOrFail($this->idstore)->update($data);
        session()->flash('success', 'Store updated successfully!');
    }

    public function updatePhoto()
    {
        $this->validate([
            'photo' => 'required|mimes:jpeg,jpg,png|max:10245' // 10MB Max
        ]);

        // Generate a random file name with the same extension as the original file
        $randomName = Str::random(20) . '.' . $this->photo->getClientOriginalExtension();

        // Store the photo with the random name in the 'photos' directory of the 'public' disk
        $path = $this->photo->storeAs('logo', $randomName, 'public');


        Store::findOrFail($this->idstore)
        ->update(['logo'    => $randomName]);


        // Here, you would typically save the path to your database.
        // For example:
        // Auth::user()->update(['photo' => $path]);

        $this->getStore($this->idstore);
        session()->flash('success', 'Photo updated successfully!');
    }
}
