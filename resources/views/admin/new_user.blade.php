@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">New User</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    {!! Form::open(['route' => 'post.new_user', 'method' => 'post']) !!}
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}">
                        @if($errors->first('username'))
                            <p class="help-block"><span class="text-danger">{{ $errors->first('username') }}</span></p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @if($errors->first('password'))
                            <p class="help-block"><span class="text-danger">{{ $errors->first('password') }}</span></p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname') }}">
                        @if($errors->first('firstname'))
                            <p class="help-block"><span class="text-danger">{{ $errors->first('firstname') }}</span></p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname') }}">
                        @if($errors->first('lastname'))
                            <p class="help-block"><span class="text-danger">{{ $errors->first('lastname') }}</span></p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                        @if($errors->first('email'))
                            <p class="help-block"><span class="text-danger">{{ $errors->first('email') }}</span></p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="role_id">Role</label>
                        {{ dropdownRole('role_id', old('role_id'), ['class' => 'form-control', 'id' => 'role_id']) }}
                        @if($errors->first('role_id'))
                            <p class="help-block"><span class="text-danger">{{ $errors->first('role_id') }}</span></p>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Add New User">
                        <a href="{{ route('get.users') }}" class="btn btn-danger">Cancel</a>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
