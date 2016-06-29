@extends('layouts.layout')

@section('content')
<div class="container">
    @include('_partials.alert_notification')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Clearance List</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <p class="pull-right">
                        <a href="{{ route('get.export_csv') }}" class="btn btn-primary"><span class="glyphicon glyphicon-cloud-download"></span> Export CSV</a>
                        <a href="{{ route('get.new_pin_slip') }}" class="btn btn-info"><span class="glyphicon glyphicon-th"></span> Issue New PIN Slip</a>
                    </p>
                    <table class="table table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th>Serial #</th>
                            <th>Name</th>
                            <th>Registration #</th>
                            <th>Teller #</th>
                            <th>PIN</th>
                            <th>Phone</th>
                            <th>Issued By</th>
                            <th>Issue Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($clearanceList) && count($clearanceList) > 0)
                        @foreach($clearanceList as $clearance)
                            <tr>
                                <td>{{ $clearance->serial_number }}</td>
                                <td>{{ $clearance->full_name }}</td>
                                <td>{{ $clearance->registration_number }}</td>
                                <td>{{ $clearance->teller_number }}</td>
                                <td>{{ $clearance->pin_number }}</td>
                                <td>{{ $clearance->phone }}</td>
                                <td>{{ expandUserName($clearance->user_id) }}</td>
                                @if($authUser->role_id == 2)
                                    <td>{{ $clearance->created_at->format('d/m/Y \a\t H:i A') }}</td>
                                @else
                                    <td>{{ $clearance->created_at->format('d/m/Y') }}</td>
                                @endif
                                <td>
                                    <a href="{{ route('get.clearance_slip',[$clearance->id]) }}" class="text-info" title="View Slip"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></a>&nbsp;
                                    @if($authUser->role_id == 2)
                                    <a href="{{ route('get.delete_pin_slip',[$clearance->id]) }}" class="text-danger" title="Delete"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="9">You have not issued any PIN slip, Click <a href="{{ route('get.new_pin_slip') }}">here</a> to Issue a <strong>New PIN Slip</strong></td>
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
