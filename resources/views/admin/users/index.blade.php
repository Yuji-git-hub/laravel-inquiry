<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>管理ユーザー一覧</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>名前</th>
            <th>メールアドレス</th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td>
                <a href="{{ route('admin.users.show', $user->id) }}">{{ $user->id }}</a>
            </td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <a href="{{ route('admin.users.edit', $user->id) }}">編集</a>
            </td>
            <td>
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">削除</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    @if (session('success'))
    <div>
        {{ session('success') }}
    </div>
    @endif
</body>
</html>