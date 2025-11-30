<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせ詳細画面</title>
</head>
<body>
    <h1>お問い合わせ詳細画面</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>名前</th>
            <th>メールアドレス</th>
            <th>タイプ</th>
            <th>お問い合わせ内容</th>
            <th>作成日時</th>
        </tr>
        <tr>
            <td>{{ $inquiry->id }}</td>
            <td>{{ $inquiry->name }}</td>
            <td>{{ $inquiry->email }}</td>
            <td>{{ $inquiry->type->label() }}</td>
            <td>{{ $inquiry->content }}</td>
            <td>{{ $inquiry->created_at }}</td>
        </tr>
    </table>
    <a href="{{ route('admin.index') }}">一覧に戻る</a>
</body>
</html>