<h1>お問い合わせ内容</h1>

<p><strong>名前: </strong> {{ $inquiry->name }}</p>
<p><strong>メール: </strong> {{ $inquiry->email }}</p>
<p><strong>種類: </strong>{{ $inquiry->type }}</p>
<p><strong>本文: </strong>{{ $inquiry->content }}</p>
<p><strong>送信日時: </strong>{{ $inquiry->created_at }}</p>
