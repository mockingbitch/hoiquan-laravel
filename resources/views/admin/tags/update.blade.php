<form method="post">
    @csrf
    <input name="name" type="text" class="form-input" value="{{$tag->name}}"/>
    <input name="description" type="text" class="form-input" value="{{$tag->description}}" />
    <input type="submit" name="login" value="login" />
</form>
