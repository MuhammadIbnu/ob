@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span
            aria-hidden="true">×</span> </button>
        <p>{{ $message }}</p>
    </div>
@endif
