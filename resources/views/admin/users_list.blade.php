@extends('layouts.layout')

@section('content')
<div class="container">
    @include('_partials.alert_notification')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Users List</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <p class="pull-right"><a href="{{ route('get.new_user') }}" class="btn btn-info"><span class="glyphicon glyphicon-user"></span> New User</a></p>
                    <table class="table table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($adminUsers) && count($adminUsers) > 0)
                        @foreach($adminUsers as $admin)
                            <tr>
                                <td>{{ $admin->username }}</td>
                                <td>{{ $admin->firstname }}</td>
                                <td>{{ $admin->lastname }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ expandRole($admin->role_id) }}</td>
                                <td>
                                    @if($authUser->role_id == 2)
                                    <a href="{{ route('get.edit_user',[$admin->id]) }}" title="Edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>&nbsp;
                                    @endif
                                    @if($authUser->role_id == 2 && $admin->id != $authUser->id)
                                    <a href="{{ route('get.delete_user',[$admin->id]) }}" class="text-danger" title="Delete"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6">No Users have been added, Click <a href="{{ route('get.new_user') }}">here</a> to add a <strong>New User</strong></td>
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
