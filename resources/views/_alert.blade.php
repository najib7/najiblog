@if(session('success'))

<div class="alert alert-success w-50 m-auto" role="alert">
    <button class="close" data-dismiss="alert" aria-hidden="true">x</button>
    {{ session('success') }}
</div>

@endif

@if(session('delete-err-cat'))

<div class="alert alert-danger w-50 m-auto" role="alert">
    <button class="close" data-dismiss="alert" aria-hidden="true">x</button>
    {{ session('delete-err-cat') }}
</div>

@endif
