<form action="{{ route('admin.product.import') }}" method="post" enctype="multipart/form-data">
    @csrf
    @include('kano.show_error_all')
    <input type="file" name="csv">
    <button>取り込む</button>
</form>