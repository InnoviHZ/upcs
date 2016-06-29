@extends('layouts.layout')

@section('content')
<div class="container">
    @include('_partials.alert_notification')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">New PIN Slip</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    {!! Form::open(['route' => 'post.new_pin_slip', 'method' => 'post']) !!}
                    <div class="form-group">
                        <label for="registration_number">Registration Number</label>
                        <input type="text" class="form-control" id="registration_number" name="registration_number" value="{{ old('registration_number') }}">
                        @if($errors->first('registration_number'))
                            <p class="help-block"><span class="text-danger">{{ $errors->first('registration_number') }}</span></p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="fullname">Full Name</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" value="{{ old('fullname') }}">
                        @if($errors->first('fullname'))
                            <p class="help-block"><span class="text-danger">{{ $errors->first('fullname') }}</span></p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="teller_number">Teller Number</label>
                        <input type="text" class="form-control" id="teller_number" name="teller_number" value="{{ old('teller_number') }}">
                        @if($errors->first('teller_number'))
                            <p class="help-block"><span class="text-danger">{{ $errors->first('teller_number') }}</span></p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                        @if($errors->first('phone'))
                            <p class="help-block"><span class="text-danger">{{ $errors->first('phone') }}</span></p>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Issue PIN Slip">
                        <a href="{{ route('get.clearance') }}" class="btn btn-danger">Cancel</a>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
