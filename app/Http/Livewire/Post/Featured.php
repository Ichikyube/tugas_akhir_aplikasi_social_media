<?php

namespace App\Http\Livewire\Post;

use Livewire\Component;
use App\Models\Post;

class Featured extends Component
{
    public Post $post;
    public string $name;
    public bool $featured;

    public function mount()
    {
        $this->featured = $this->post->getAttribute('featured');
    }

    public function updating($name, $value)
    {
        $this->post->setAttribute($name, $value)->save();
    }

    public function render()
    {
        return view('livewire.post.featured');
    }
}
