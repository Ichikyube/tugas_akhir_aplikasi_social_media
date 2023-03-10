<?php

namespace App\Http\Livewire\Post;

use Livewire\Component;

class ShowByGenre extends Component
{
    public function index() {
        $categories = Category::orderBy('id', 'desc')->paginate(10);
        return view('category.index')->withCategories($categories);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:categories|max:255'
        ]);
        $category = new Category;
        $category->name = strtolower($request->name);
        $category->user_id = Auth::user()->id;
        $category->save();

        Session::flash('success', 'Category was added succesfully');
        return redirect('/category');
    }

    public function showAll($name) {
        $category = Category::all()->where('name', '=', $name)->first();
        if ($category != null) {
            $posts = Post::all()->where('category_id', '=', $category->id)->sortByDesc('id');
            return view('category.showAll')->withPosts($posts);
        }
        return redirect('/post');
    }

    public function render()
    {
        return view('livewire.post.show-by-genre');
    }
}
