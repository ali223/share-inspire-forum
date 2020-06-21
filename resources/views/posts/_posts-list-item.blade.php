<li>
  <p>
    <a href="{{ route('posts.index', $post->topic) . "#post{$post->id}" }}" 
       class="link-underline text-custom">
      {{ $post->content }} 
    </a>

    <strong>
      Posted {{ $post->created_at->diffForHumans() }} by
      <a href="{{ route('profiles.show', $post->user->id) }}" class="text-custom">
        {{ $post->user->name }}
      </a>
    </strong>

    under the 
    
    <strong>
      Topic
      <a href="{{ route('posts.index', $post->topic->id) }}" class="text-custom">
        {{$post->topic->title}}
      </a>  
    </strong>
  </p>
</li>
