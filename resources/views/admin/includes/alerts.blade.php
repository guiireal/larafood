@if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-warning">
        <p>{{ $error }}</p>
    </div>
    @endforeach
@endif

@if (session('message'))
    <div class="alert alert-info">
        <p>{{ session('message') }}</p>
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning">
        <p>{{ session('warning') }}</p>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        <p>{{ session('error') }}</p>
    </div>
@endif

