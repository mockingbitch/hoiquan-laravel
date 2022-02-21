<a href="{{route('client.login')}}">Login</a>
@if(isset($client))
    <h1>{{$client->name}}</h1>
    <a href="{{route('client.logout')}}">Logout</a>
@endif

<a href="{{route('post.create')}}">Create post</a>
@if(isset($posts))
    @foreach($posts as $post)
        <h1>Title: {{$post->title}}</h1>
        <h2>Nguoi viet: {{$post->client}}</h2>
        <h3>Noi dung: {{$post->content}}</h3>
        <a href="{{route('cheer',['post'=>$post->id])}}">
            @if($post->cheers)
                unlike
            @else
                like
            @endif
        </a>
        <a href="{{route('comment.create',['post'=>$post->id])}}">comment</a>
        @foreach($comments as $comment)
                @if($comment->post == $post->id)
                    <p>---</p>
                    <h2 style="color: green">{{$comment->client}}</h2>
                    <h3 style="color: green">{{$comment->content}}</h3>
                    <h4 style="color: green">{{$comment->created_at}}</h4>
                    @if(isset($client))
                        @if($comment->client == $client->id)
                            <a href="{{route('comment.update',['id'=>$comment->id])}}">Edit</a>
                            <a href="{{route('comment.delete',['id'=>$comment->id])}}">Delete</a>
                        @endif
                    @endif
                    <p>---</p>
                @endif
        @endforeach
        <h5>{{$post->created_at}}</h5>
        <hr/>
    @endforeach
@endif
