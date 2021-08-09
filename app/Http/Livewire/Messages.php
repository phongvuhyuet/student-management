<?php

namespace App\Http\Livewire;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Messages extends Component
{
    public $message;
    public $allmessages;
    public $sender;
    public function render()
    {
        $users;
        if (Auth::user()->role_id == 1) {
            $first = true;
            $users = User::where('role_id', 2)->whereIn('id', Auth::user()->consult->first()->member->where('role_id', 2)->pluck('id'));
            foreach (Auth::user()->consult as $class) {
                if ($first) {
                    $first = false;
                    continue;
                }
                $users->orWhereIn('id', $class->member->where('role_id', 2)->pluck('id'));
            }
            $users = $users->get();
        } else {
            $users = Auth::user()->class->consultant;
            $users = collect([$users]);
        }
        $sender = (isset($this->sender)) ? $this->sender : $users->first();
        $this->allmessages;
        return view('livewire.messages', compact('users', 'sender'));
    }
    public function mountdata()
    {
        if (isset($this->sender->id)) {
            $this->allmessages = Message::where('user_id', auth()->id())->where('receiver_id', $this->sender->id)->orWhere('user_id', $this->sender->id)->where('receiver_id', auth()->id())->orderBy('id', 'desc')->get();

            $not_seen = Message::where('user_id', $this->sender->id)->where('receiver_id', auth()->id());
            $not_seen->update(['is_seen' => true]);
        }

    }
    public function resetForm()
    {
        $this->message = '';
    }

    public function SendMessage()
    {
        $data = new Message;
        $data->message = $this->message;
        $data->user_id = auth()->id();
        $data->receiver_id = $this->sender->id;
        $data->save();

        $this->resetForm();

    }
    public function getUser($userId)
    {
        $user = User::find($userId);
        $this->sender = $user;
        $this->allmessages = Message::where('user_id', auth()->id())->where('receiver_id', $userId)->orWhere('user_id', $userId)->where('receiver_id', auth()->id())->orderBy('id', 'desc')->get();
    }

}
