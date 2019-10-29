@if(session('success'))

<div class="alert alert-success" role="alert">
    <button class="close" data-dismiss="alert" aria-hidden="true">x</button>
    {{ session('success') }}
</div>

@endif
