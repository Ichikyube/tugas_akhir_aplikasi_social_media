<?php

namespace App\Http\Livewire\Post;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Comment;
use App\Models\Post;

class Comments extends Component
{
    public function index(Request $request) {
        $this->validate($request, [
            'post_id' => 'exists:posts,id|numeric',
            'comment' => 'required|max:255'
        ]);
        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $request->post_id;
        $comment->save();

        session()->flash('success', 'Your comment was succesffuly added');
        return redirect()->back();
    }
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function create()
    {
        return view('post');
    }

    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->body = $request->get('comment_body');
        $comment->user()->associate($request->user());
        $post = Post::find($request->get('post_id'));
        $post->comments()->save($comment);

        return back();
    }

    public function replyStore(Request $request)
    {
        $reply = new Comment();
        $reply->body = $request->get('comment_body');
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');
        $post = Post::find($request->get('post_id'));

        $post->comments()->save($reply);

        return back();
    }

    public function render()
    {
        return view('livewire.post.comment');
    }
}
