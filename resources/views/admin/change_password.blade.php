@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Change Password</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    {!! Form::open(['route' => 'post.change_password', 'method' => 'post']) !!}
                    <div class="form-group">
                        <label for="newpwd">New Password</label>
                        <input type="password" class="form-control" id="newpwd" placeholder="New Password" name="password">
                        @if($errors->first('password'))
                            <p class="help-block"><span class="text-danger">{{ $errors->first('password') }}</span></p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="renewpwd">Confirm New  Password</label>
                        <input type="password" class="form-control" id="renewpwd" placeholder="Confirm New Password" name="password_confirmation">
                        @if($errors->first('password_confirmation'))
                            <p class="help-block"><span class="text-danger">{{ $errors->first('password_confirmation') }}</span></p>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Change Password">
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
