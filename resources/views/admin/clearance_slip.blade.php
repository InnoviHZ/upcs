@extends('layouts.layout')

@section('content')
<div class="container">
    @include('_partials.alert_notification')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Clearance Slip</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <p class="pull-left"><a href="{{ route('get.new_pin_slip') }}" class="btn btn-info"><span class="glyphicon glyphicon-th"></span> Issue New PIN Slip</a></p>
                    <p class="pull-right"><a href="javascript::void();" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span> Print PIN Slip</a></p>
                    <table class="table table-bordered">
                        <tbody>
                        @if(isset($clearanceSlip) && count($clearanceSlip) > 0)
                            <tr>
                                <td>Name</td>
                                <td><strong>{{ $clearanceSlip->full_name }}</strong></td>
                            </tr>
                            <tr>
                                <td>Registration Number</td>
                                <td><strong>{{ $clearanceSlip->registration_number }}</strong></td>
                            </tr>
                            <tr>
                                <td>PIN Number</td>
                                <td><strong>{{ $clearanceSlip->pin_number }}</strong></td>
                            </tr>
                            <tr>
                                <td>Serial Number</td>
                                <td><strong>{{ $clearanceSlip->serial_number }}</strong></td>
                            </tr>
                            <tr>
                                <td>Teller Number</td>
                                <td><strong>{{ $clearanceSlip->teller_number }}</strong></td>
                            </tr>
                            <tr>
                                <td>Phone Number</td>
                                <td><strong>{{ $clearanceSlip->phone }}</strong></td>
                            </tr>
                            <tr>
                                <td>Issued By</td>
                                <td><strong>{{ expandUserName($clearanceSlip->user_id) }}</strong></td>
                            </tr>
                            <tr>
                                <td>Issue Date</td>
                                <td><strong>{{ $clearanceSlip->created_at->format('d/m/Y') }}</strong></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
