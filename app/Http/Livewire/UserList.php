<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Psy\Readline\Hoa\Console;

use function Termwind\render;

class UserList extends Component
{
    use WithPagination;

    public $name;
    public $email;
    public $alamat;
    public $avatar;
    public $status;
    public $telepon;

    public $positionName;
    public $positionRole;

    public $userUpdateStatus = false;
    public $perPage = 10;
    public $search = '';
    protected $paginationTheme = 'bootstrap';

    public $userId;

    protected $listeners = [
        'UserUpdated' => 'render',
        'UserStore' => 'render'
    ];

    public function render()
    {
        return view('livewire.user-list',[
            'users' => User::orderBy('users.id', 'desc')
                ->join('positions', 'users.position_id', '=', 'positions.id')
                ->where(function ($query) {
                    $query->where('users.name', 'like', '%' . $this->search . '%')
                    ->orWhere('users.email', 'like', '%' . $this->search . '%')
                    ->orWhere('positions.name', 'like', '%' . $this->search . '%');
                })
                ->select('users.*', 'positions.name as position_name')
                ->paginate($this->perPage)->onEachSide(1)
            ]);
    }

    public function getUser($id)
    {
        $this->emit('userUpdateStatus');
        $user = User::find($id);
        $this->emit('getUser', $user);
    }

    public function deleteConfirm($id)
    {
        $this->userId = $id;
    }

    public function destroy()
    {
        $user = User::where('id', $this->userId)->first();
        $xId = $user->id;
        $userId = Auth::id();
        if($userId != $xId){
            $this->dispatchBrowserEvent('success', ['message'=>'Pengguna berhasil dihapus !']);
            $user->delete();
        }else{
            $this->dispatchBrowserEvent('warning', ['message'=>'Maaf, Pengguna tidak dapat dihapus !']);
        }
        $this->emit('UserStore');
    }

    public function detail($id)
    {
        $user = User::with('position')->find($id);

        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->avatar = $user->avatar;
        $this->status = $user->status;
        $this->alamat = $user->adress;
        $this->telepon = $user->telepon;

        $this->positionName = $user->position->name;
        $this->positionRole = $user->position->role_as;
    }

    public function cancel()
    {
        $this->removeMe();
    }

    public function removeMe()
    {
        $this->userId = NULL;
        $this->name = NULL;
        $this->email = NULL;
        $this->avatar = NULL;
        $this->status = NULL;
        $this->alamat = NULL;
        $this->telepon = NULL;
        $this->positionName = NULL;
        $this->positionRole = NULL;
    }

    public function update()
    {
        $user = User::where('id', $this->userId)->first();
        if ($user->id !== 1  && $user->id !== auth()->user()->id){
            if($user->status == 1){
                $user->update([
                    'status' => 0,
                ]);

                $this->dispatchBrowserEvent('success', ['message'=>'User berhasil dinonaktifkan !']);
            }else{
                
                $user->update([
                    'status' => 1,
                ]);
                $this->dispatchBrowserEvent('success', ['message'=>'User berhasil diaktifkan !']);
            }
            
        }else{
            $this->dispatchBrowserEvent('success', ['message'=>'Tindakan tidak dapat dilanjutkan !']);
            
        }
        
        $this->removeMe();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingperPage()
    {
        $this->resetPage();
    }
}
