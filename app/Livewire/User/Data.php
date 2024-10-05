<?php

namespace App\Livewire\User;

use App\Models\HutangPlasma;
use App\Models\User;
use App\Models\UserLevel;
use Exception;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['deleting' => 'destroyUser'];
    private $items;
    public $dataLevel;
    public $name;
    public $level;
    public $phone;
    public $email;
    public $password = 'admin1234';
    public $edit;
    public $delete;
    public $isActive;
    public $norek;
    public $address;
    public $key = "";

    protected $rules = [
        'name'      => 'required|min:3|string',
        'level'     => 'required',
        'phone'     => 'required|max:15|min:10|unique:users,phone',
        'email'     => 'required|email|unique:users,email',
        'password'  => 'required|min:6',
    ];

    public function  mount()
    {
        $this->getLevel();
    }

    public function render()
    {
        $this->getDataUser();
        return view('livewire.user.data', [
            'items'     => $this->items,
        ]);
    }

    public function getDataUser()
    {
        if ($this->key == "") {
            $this->items = User::join('user_levels', 'user_levels.id', '=', 'users.level')
                    ->select('users.id', 'name', 'email', 'user_levels.level', 'user_levels.divisi', 
                    'img', 'phone', 'tag_active', 'users.created_at', 'norek', 'address')
                    ->paginate(10);
        } else {
            $this->items = User::join('user_levels', 'user_levels.id', '=', 'users.level')
                    ->where('users.name', 'like', '%'.$this->key.'%')
                    ->orWhere('users.phone', 'like', '%'.$this->key.'%')
                    ->orWhere('users.address', 'like', '%'.$this->key.'%')
                    ->select('users.id', 'name', 'email', 'user_levels.level', 'user_levels.divisi', 
                    'img', 'phone', 'tag_active', 'users.created_at', 'norek', 'address')
                    ->paginate(10);
        }
        
    }

    public function modalCreate()
    {
        $this->reset('name', 'phone', 'level', 'email', 'password', 'edit');
        $this->dispatch('modalCreate');
    }

    public function getLevel()
    {
        $data = UserLevel::all();
        $this->dataLevel = $data;
    }

    public function addKaryawan()
    {
        $this->validate();
        try {
            $user = User::create([
                    'name'      => $this->name,
                    'email'     => $this->email,
                    'password'  => Hash::make($this->password),
                    'level'     => $this->level,
                    'img'       => 'user.png',
                    'phone'     => $this->phone,
                    'tag_active'=> $this->isActive,  
                    'norek'     => $this->norek,
                    'address'   => $this->address,  
                ]);

            if ($this->level >= '3') {
                $this->addHutang($user->id);
            }
            
            $this->reset('name', 'phone', 'level', 'email', 'password', 'norek', 'address');
            $this->dispatch('closeModal');
            $this->dispatch('alert', [
                'title'     => 'Success',
                'message'   => 'Data berhasil disimpan!',
                'icon'      => 'success'
            ]);
        } catch (Exception $e) {
            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Data gagal disimpan!',
                'icon'      => 'warning'
            ]);
        }
    }

    public function addHutang($id)
    {
        HutangPlasma::create([
            'user_id'   => $id,
            'hutang'    => 0,
        ]);
    }

    public function editUser($id)
    {
        $this->edit = $id;
        $user = User::findOrFail($this->edit);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->level = $user->level;
        $this->phone = $user->phone;
        $this->isActive = $user->tag_active;
        $this->norek = $user->norek;
        $this->address = $user->address;

        $this->dispatch('modalCreate');
    }

    public function editKaryawan()
    {

        try {
            $user = User::findOrFail($this->edit);
            $user->update([
                'name'      => $this->name,
                'email'     => $this->email,
                'level'     => $this->level,
                'phone'     => $this->phone,
                'tag_active'=> $this->isActive,
                'norek'     => $this->norek,
                'address'   => $this->address,  
            ]);
            $this->reset('name', 'phone', 'level', 'email', 'password', 'edit', 'norek', 'address');
            $this->dispatch('closeModal');
            $this->dispatch('alert', [
                'title'     => 'Success',
                'message'   => 'Data Karyawan telah diedit!',
                'icon'      => 'success'
            ]);
        } catch (Exception $e){
            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Data Karyawan gagal diedit!',
                'icon'      => 'warning'
            ]);
        }
    }

    public function deleteUser($id)
    {
        $this->delete = $id;
        $this->dispatch('confirmDelete');
    }

    public function destroyUser()
    {
        try {

            $user = User::findOrFail($this->delete);
            $user->delete();
            $this->dispatch('alert', [
                'title'     => 'Deleted',
                'message'   => 'Data Karyawan telah dihapus!',
                'icon'      => 'success'
            ]);
            $this->reset('delete');

        } catch (Exception $e) {

            $this->dispatch('alert', [
                'title'     => 'Oops',
                'message'   => 'Gagal menghapus data karyawan!',
                'icon'      => 'warning'
            ]);

        }
    }
}
