<?php

namespace App\Livewire;


use App\Models\post;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class PostComponent extends Component
{  
    
    use WithPagination;
    	
    public $postId;

    #[Rule('required|min:3')]
    public $title;

    #[Rule('required|min:3')]
    public $body;

    public $isOpen = 0; 

    public function create()
    {   
        $this->reset('title','body','postId');
        $this->openModal();
    }

    public function store()
    {
        $this->validate();
        post::create([
            'title' => $this->title,
            'body' => $this->body,
        ]);
        session()->flash('success', 'Post created successfully.');
        
        $this->reset('title','body');
        $this->closeModal();
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->postId = $id;
        $this->title = $post->title;
        $this->body = $post->body;
 
        $this->openModal();
    }
    public function update()
    {
        if ($this->postId) {
            $post = Post::findOrFail($this->postId);
            $post->update([
                'title' => $this->title,
                'body' => $this->body,
            ]);
            session()->flash('success', 'Post updated successfully.');
            $this->closeModal();
            $this->reset('title', 'body', 'postId');
        }

    }
    public function delete($id)
  {
      Post::find($id)->delete();
      session()->flash('success', 'Post deleted successfully.');
      $this->reset('title','body');
  }
    public function render()
    {
        // return view('livewire.post-component');
        return view('livewire.post-component',[
        //   'posts' => Post::all()
          'posts' => Post::paginate(5),
      ]);
        
    }

    public function openModal()
    {
        $this->isOpen = true;
        	
        $this->resetValidation();
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }
}
