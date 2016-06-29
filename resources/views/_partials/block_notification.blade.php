@if(session('notification_message'))
<div class="alert alert-{{ session('notification_type') }} help-block">
    <p>{{ session('notification_message') }}</p>
</div>
@endif