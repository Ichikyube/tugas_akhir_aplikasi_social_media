<?php

namespace App\Http\Livewire\Button;

use Livewire\Component;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class Likes extends Component
{
    public function index() {
        $likes = Like::all()->where('user_id', '=', Auth::user()->id)->where('post_id', '=', $this->post_id)->first();
        if ($likes == null) {
            $like = new Like;
            $like->user_id = Auth::user()->id;
            $like->post_id = $this->post_id;
            $like->like = $this->isLike;
            $like->save();
        }
        else {
            $likes->like = $this->isLike;
            $likes->save();
        }
        return [
            'post_id' => $this->post_id
        ];
    }
    public function render()
    {
        return view('livewire.button.like');
    }
}
