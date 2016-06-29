@if(session('notification_message'))
    <div class="alert alert-{{ session('notification_type') }} alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>{{ ucfirst(session('notification_type')) }}!</strong> {{ session('notification_message') }}
    </div>
@endif
