<?php

namespace App\Http\Livewire;

use App\Models\Position;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserUpdate extends Component
{
    public $userId;
    public $email;
    public $name;
    public $password;
    public $password_confirmation;
    public $position_id;

    protected $listeners = [
        'dataUser' => 'showUser'
    ];

    public function render()
    {
        return view('livewire.user-update',[
            'positions' => Position::all()
        ]);
    }

    public function showUser($user)
    {
        $this->userId = $user['id'];
        $this->name = $user['name'];
        $this->email = $user['email'];
        $this->position_id = $user['position_id'];
    }

    public function update()
    {
        $rules = [
            'name' => 'required|string|max:255|min:3',
            'position_id' => 'required|integer',
            'email' => 'required|string|email|max:255|unique:users,email,'.$this->userId
        ];

        if ($this->password !== null) {
            $rules['password'] = 'string|max:99|min:3|confirmed';
            $rules['password_confirmation'] = 'string|max:99|min:3';
        }

        $this->validate($rules);

        if ($this->userId){
            $user = User::where('id', $this->userId)->first();
            $xId = $user->id;
            $userId = Auth::id();
            if($userId != $xId){
                $userData = [
                    'name' => $this->name,
                    'email' => $this->email,
                    'position_id' => $this->position_id
                ];
                if ($this->password !== null) {
                    $userData['password'] = Hash::make($this->password);
                }
    
                $user->update($userData);
                $this->dispatchBrowserEvent('success', ['message'=>'Pengguna berhasil diubah !']);
            }else{
                $this->dispatchBrowserEvent('warning', ['message'=>'Terjadi kesalahan !']);
            }

            $this->name = NULL;
            $this->email = NULL;
            $this->position_id = NULL;
            $this->password = NULL;

            $this->emit('userUpdateStatusFalse');
        }
        $this->emit('UserUpdated');
    }

    public function cancel(){
        $this->name = NULL;
        $this->email = NULL;
        $this->password = NULL;
        $this->password_confirmation = NULL;
        $this->position_id = NULL;
        
        $this->emit('userUpdateStatusFalse');
    }
}
