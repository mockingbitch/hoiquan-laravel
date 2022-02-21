<h1>update</h1>
<form method="post">
    @csrf
    <input name="title" type="text" value="{{$post->title}}">
    <input name="tag" type="number" value="{{$post->tag}}">
    <input name="content" type="text" value="{{$post->content}}">
    <input type="submit" value="submit">
</form>
