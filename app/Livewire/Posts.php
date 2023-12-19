<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Posts extends Component
{  
    use WithPagination;
    use WithFileUploads;
    public $posts, $title, $description, $post_id, $image,$search;
    public $updateMode = false;
    public function render()
    {
        $this->posts = Post::latest()->get();        ;
        return view('livewire.posts');
    }

    private function resetInputFields(){
        $this->title = '';
        $this->description = '';
        $this->image = '';
    }

    public function store()
    {
        $validatedData = $this->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);   
        $newImage = $this->image->store('public/posts');
        Post::create([
            'title'=> $this->title,
            'description'=> $this->description,
            'image'=>$newImage,
        ]);
    
        session()->flash('message', 'Post Created Successfully.');
    
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->post_id = $id;
        $this->title = $post->title;
        $this->description = $post->description;
        $this->image = $post->image;
        $this->updateMode = true;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $validatedDate = $this->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
  
        $post = Post::find($this->post_id);
        $newImage = $this->image->store('public/posts');
        $post->update([
            'title' => $this->title,
            'description' => $this->description,
            'image' => $newImage,
        ]);
  
        $this->updateMode = false;
  
        session()->flash('message', 'Post Updated Successfully.');
        $this->resetInputFields();
    }
    public function delete($id)
    {
        Post::find($id)->delete();
        session()->flash('message', 'Post Deleted Successfully.');
        return redirect()->back();
    }
}
