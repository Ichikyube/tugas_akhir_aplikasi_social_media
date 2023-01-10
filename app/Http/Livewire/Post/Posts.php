<?php

namespace App\Http\Livewire\Posts;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Image;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Genre;
use App\Models\Post;

class Posts extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $title;
    public $body;
    public $image;
    public $postId = null;
    public $newImage;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $posts = Post::latest()->orderBy('created_at', 'seriesId')->get();
        $genre = $id;
        return view('post.index')->with($posts)->with($genre);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255|unique:posts',
            'image' => 'image',
            'body' => 'required|max:255'
        ]);
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category;
        $post->user_id = Auth::user()->id;
        $post->save();

        $image_name = $this->image->getClientOriginalName();
        $this->image->storeAs('public/photos/', $image_name);
        $post =new Post();
        $post->user_id = auth()->user()->id;
        $post->title = $this->title;
        $post->slug = Str::slug($this->title);
        $post->body = $this->body;
        $post->image = $image_name;
        $post->save();
        $this->reset();
        if (isset($request->tags)) {
            $post->friends()->sync($request->tags, false);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('/images/' . $filename);
            $image->resize(800, 600)->save($location);
            $post->image = $filename;
        }
        Posts::create([
            'title' => Str::title($this->Titulli),
            'body' => $this->Teksti,
            'photo' => $this->Foto->store('post_images', 'public', $this->Foto->hashName()),
            // 'category' => json_encode($this->category),
            'user_id' => auth()->user()->id,
            'slug' => Str::slug($this->Titulli, '-'),
        ]);
        //  resize and compress image
        $imgName = $this->Foto->store('post_images', 'public', $this->Foto->hashName());
        $this->resizeAndCompress($imgName, 450, null, 'storage/');

        Session::flash('flash.banner', 'Post created Successfully');
        return redirect('/post');
    }
/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('post.show')->with($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if (Auth::user()->id != $post->user_id) {
            abort(404);
        }
        if ($post == null) {
            abort(404);
        }
        $genre = Genre::all();
        return view('post.edit')->with($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if (Auth::user()->id != $post->user_id) {
            abort(404);
        }
        if ($post == null) {
            abort(404);
        }
        $this->validate($request, [
            'title' => "required|max:255|unique:posts,title,$id",
            'image' => 'image',
            'body' => 'required|max:255'
        ]);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category;
        $post->user_id = Auth::user()->id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('/images/' . $filename);
            Image::make($image)->resize(800, 600)->save($location);
            if ($post->image != null) {
                Storage::delete($post->image);
            }
            $post->image = $filename;
        }
        $post->save();
        if (isset($request->tags)) {
            $post->friends()->sync($request->tags);
        }

        Session::flash('success', 'Post was successfully added');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if (Auth::user()->id != $post->user_id) {
            abort(404);
        }
        if ($post == null) {
            abort(404);
        }
        if ($post->image != null) {
            Storage::delete($post->image);
        }
        $post->delete();
        Session::flash('success', 'Post was succesfully deleted');
        return redirect()->back();
    }

    public function showEditPostModal($id)
    {
        $this->reset();
        $this->showModalForm = true;
        $this->postId = $id;
        $this->loadEditForm();
    }

    public function loadEditForm()
    {
        $post = Post::findOrFail($this->postId);
        $this->title = $post->title;
        $this->body = $post->body;
        $this->newImage = $post->image;
    }
    public function updatePost()
    {
        $this->validate([
          'title' =>'required',
          'body'  => 'required',
          'image' => 'image|max:1024|nullable'
      ]);
        if ($this->image) {
            Storage::delete('public/photos/', $this->newImage);
            $this->newImage = $this->image->getClientOriginalName();
            $this->image->storeAs('public/photos/', $this->newImage);
        }

        Post::find($this->postId)->update([
             'title' => $this->title,
             'body'  => $this->body,
             'image' => $this->newImage
        ]);
        $this->reset();
        session()->flash('flash.banner', 'Post Updated Successfully');
    }

    public function deletePost($id)
    {
        $post = Post::find($id);
        Storage::delete('public/photos/', $post->image);
        $post->delete();
        session()->flash('flash.banner', 'Post Deleted Successfully');
    }
    public function render()
    {
        return view('livewire.post.post');
    }
}
