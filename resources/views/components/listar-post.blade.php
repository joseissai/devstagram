<div>    
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 p-2">
        @if ($posts->count())
            @foreach($posts as $post)
                <div>
                    <a href="{{route('posts.show', ['post' => $post, 'user' => $post->user]  )}}">
                        <img src="{{ asset('uploads') . '/' .  $post->imagen}}" alt="Imagen del post {{$post->titulo}}">
                    </a>
                </div>
            @endforeach
        @else
            <p class="text-center ">No hay posts, sigue a alguién para poder mostrar sus posts</p>
        @endif
    </div>         
</div>