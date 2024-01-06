<html>
<head>
    <title>トップページ</title>
    </head>
    <body>
    <h1>トップページ</h1>
    <ul>
        <li>出品者（Administrator）ログインユーザー: {{ Auth::guard('admins')->check() }}</li>
        <li>マイページ（members） ログインユーザー: {{ Auth::guard('members')->check() }}</li>
    </ul>
</body>
</html>