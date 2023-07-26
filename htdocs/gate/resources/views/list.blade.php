<h1>bai viet</h1>
@foreach($post as $post)
    <p>
        <a href="{{route('post.show', ['id'=> $post->id])}}">{{$post->title}}</a>
    </p>

@endforeach