<h1>create</h1>
<form method="post">
    @csrf
    <input name="title" type="text" placeholder="title">
    <input name="tag" type="number" placeholder="tag">
    <input name="content" type="text" placeholder="content">
    <input type="submit" value="submit">
</form>
