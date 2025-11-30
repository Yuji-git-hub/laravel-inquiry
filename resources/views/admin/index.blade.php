<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせ一覧</title>
</head>
<body>
    <h1>お問い合わせ一覧画面</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>名前</th>
            <th>メールアドレス</th>
            <th>タイプ</th>
            <th>お問い合わせ内容</th>
            <th>作成日時</th>
        </tr>
        @foreach($inquiries as $inquiry)
        <tr>
            <td>
                <a href="{{ route('admin.show', $inquiry->id) }}">{{ $inquiry->id }}</a>
            </td>
            <td>{{ $inquiry->name }}</td>
            <td>{{ $inquiry->email }}</td>
            <td>{{ $inquiry->type->label() }}</td>
            <td>{{ $inquiry->content }}</td>
            <td>{{ $inquiry->created_at }}</td>
        </tr>
        @endforeach
    </table>

    {{ $inquiries->links('pagination::simple-default') }}
</body>
</html>