@foreach ($applies as $apply)
    <p>{{ $apply->toStatusString() }}</p>
@endforeach