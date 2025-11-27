<h1>お問い合わせ画面</h1>

<form action="{{ route('inquiries.store') }}" method="POST">
    @csrf

    <label>名前</label>
    <input type="text" name="name" value="{{ old('name') }}"><br>

    <label>メールアドレス</label>
    <input type="text" name="email" value="{{ old('email') }}"><br>

    <label?>種別</label>
    <select name="type">
        <option value="estimate">見積もり</option>
        <option value="recruit">採用</option>
        <option value="other">その他</option>
    </select><br>

    <label>お問い合わせ内容</label>
    <textarea name="content"></textarea><br>

    <button type="submit">送信</button>
</form>