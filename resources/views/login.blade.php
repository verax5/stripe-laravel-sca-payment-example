<form method="post" action="login">
    Email: <input name="email"> <br>
    Password: <input name="password">
    {{ csrf_field() }}
    <button type="submit">Login</button>
</form>