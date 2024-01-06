<html>
<head>
    <title>マイページログイン</title>
    </head>
    <body>
    <h1>マイページログイン</h1>

    @error('login')
    <p>{{ $message }}</p>
    @enderror

    <form method="POST" action="/login">
        @csrf
        <label>メールアドレス</label>
        <input type="text" name="email"><br>
        <label>パスワード</label>
        <input type="password" name="password"><br>
        <button type="submit">ログイン</button>
    </form>

</body>
</html>