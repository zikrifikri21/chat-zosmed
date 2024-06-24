<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Message;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Validate;

class Chat extends Component
{
    public User $user;

    #[Validate('required')]
    public $message = '';

    public function render()
    {
        return view('livewire.chat', [
            'messages' => Message::where(function (Builder $query) {
                $query->where('from_user_id', auth()->id())
                    ->where('to_user_id', $this->user->id);
            })->orWhere(function (Builder $query) {
                $query->where('from_user_id', $this->user->id)
                    ->where('to_user_id', auth()->id());
            })->get(),

            // ->orWhere('from_user_id', $this->user->id)
            // ->orWhere('to_user_id', auth()->id())
            // ->where('to_user_id', $this->user->id)->get(),
        ]);
    }

    public function sendMessage()
    {
        Message::create([
            'from_user_id' => auth()->id(),
            'to_user_id' => $this->user->id,
            'message' => $this->message
        ]);

        $this->reset('message');
    }
}
