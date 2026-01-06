<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理ユーザー登録画面</title>
</head>
<body>
    <h1>管理ユーザー登録画面</h1>

    <form action="{{ route('admin.users.store') }}" method="post">
        @csrf

        <label for="name">名前: </label>
        <input type="text" name="name" value="{{ old('name') }}"><br>

        <label for="email">メールアドレス: </label>
        <input type="text" name="email" value="{{ old('email') }}"><br>

        <label for="email">パスワード: </label>
        <input type="text" name="password"><br>

        <button type="submit">登録</button>
    </form>
</body>
</html>