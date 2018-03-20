<li>
  <p>
    <a href="{{ route('posts.index', $post->topic) . "#post{$post->id}" }}" 
       class="link-underline">
      {{ $post->content }} 
    </a>

    <strong>Posted {{ $post->created_at->diffForHumans() }} by
      <a href="{{ route('profiles.show', $post->user->id) }}">
        {{ $post->user->name }}
      </a>
    </strong>

    under the 
    
    <strong>
      Topic
      <a href="{{ route('posts.index', $post->topic->id) }}">
        {{$post->topic->title}}
      </a>  
    </strong> 
    
  </p>
</li>
