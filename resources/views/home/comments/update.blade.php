<form method="post">
    @csrf
    <input type="text" name="content" placeholder="content">
    <input type="file" name="image">
    <input type="submit" value="Comment">
</form>
