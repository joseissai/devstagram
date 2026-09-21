<?php

use Livewire\Component;

new class extends Component
{
    public $post;
    public $isLiked;
    public $cantidadLikes;

    // función de ciclo de vida de LiveWire
    // Es como un constructor en PHP
    public function mount($post)
    {
        $this->isLiked = $post->checkLike(auth()->user());
        $this->cantidadLikes = $post->likes->count();
    }

    public function like()
    {
        if($this->post->checkLike(auth()->user()))
        {
            $this->post->likes()->where('post_id', $this->post->id)->delete();            
            $this->isLiked = false;
            $this->cantidadLikes--;
        }else {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLiked = true;
            $this->cantidadLikes++;
        }        

    }


};
?>

<div>
    <div class="flex gap-2 items-center">
        <button class="cursor-pointer"
            Wire:click="like"
        >
            <div class="my-4">
                <svg 
                    xmlns="http://www.w3.org/2000/svg" 
                    fill="{{ $isLiked ? "red" : "white" }}" 
                    viewBox="0 0 24 24" 
                    stroke-width="1.5" 
                    stroke="currentColor" 
                    class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>            
            </div>
        </button>
        <p class="font-bold">{{ $cantidadLikes }} <span class="font-normal">Likes</span></p>
    </div>
</div>