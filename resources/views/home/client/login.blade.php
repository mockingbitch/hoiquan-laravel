<form method="post">
    @csrf
    <input name="email" type="text" class="form-input" placeholder="username"/>
    <input name="password" type="password" class="form-input" placeholder="pass" />
    <input type="submit" name="login" value="login" />
</form>
