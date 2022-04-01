<form action="{{ route('admin.shop.update', $shop->id) }}" method="post">
    @csrf
    @include('kano.show_error_all')
    <h6>TEL</h6>
    <input type="text" name="tel" value="">
    <h6>稼働終了日</h6>
    <input type="text" name="" value="">
    <button>送信</button>
</form>