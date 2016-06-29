<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\NewUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\PinSlipRequest;
use App\User;
use App\Clearance;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(Request $request)
    {
        $viewData = [
            'currentView' => 'dashboard',
            'authUser' => $request->user()
        ];
        return view('dashboard')->with($viewData);
    }

    public function getChangePassword(Request $request)
    {
        $viewData = [
            'currentView' => 'change_password',
            'authUser' => $request->user()
        ];
        return view('admin.change_password')->with($viewData);
    }

    public function getNewUser(Request $request)
    {
        // Guard Abuse
        if($request->user()->role_id != 2){ return redirect()->back(); }

        $viewData = [
            'currentView' => 'users',
            'authUser' => $request->user()
        ];
        return view('admin.new_user')->with($viewData);
    }

    public function getEditUser($id, Request $request, User $user)
    {
        // Guard Abuse
        if($request->user()->role_id != 2){ return redirect()->back(); }

        $viewData = [
            'currentView' => 'users',
            'authUser' => $request->user(),
            'adminUser' => $user->adminUserDetail($id)
        ];
        return view('admin.edit_user')->with($viewData);
    }

    public function getDeleteUser($id, User $user)
    {
        // Guard Abuse
        if($request->user()->role_id != 2){ return redirect()->back(); }

        if($user->deleteAdminUser($id)){
            return redirect()->back()->with([
                'notification_type' => 'success',
                'notification_message' => 'User deleted Successfully!'
            ]);
        }
        return back()->back()->with([
            'notification_type' => 'danger',
            'notification_message' => 'An error occurred while deleting the User, try again!'
        ]);
    }

    public function getNewPinSlip(Request $request)
    {
        $viewData = [
            'currentView' => 'clearance',
            'authUser' => $request->user()
        ];
        return view('admin.new_pin_slip')->with($viewData);
    }

    public function getDeletePinSlip($id, Clearance $clearance)
    {
        // Guard Abuse
        if($request->user()->role_id != 2){ return redirect()->back(); }

        if($clearance->deletePinSlip($id)){
            return redirect()->back()->with([
                'notification_type' => 'success',
                'notification_message' => 'PIN Slip deleted Successfully!'
            ]);
        }
        return back()->back()->with([
            'notification_type' => 'danger',
            'notification_message' => 'An error occurred while deleting the PIN Slip, try again!'
        ]);

    }

    public function getUsersList(Request $request, User $user)
    {
        // Guard Abuse
        if($request->user()->role_id != 2){ return redirect()->back(); }

        $viewData = [
            'currentView' => 'users',
            'authUser' => $request->user(),
            'adminUsers' => $user->adminUsersList()
        ];
        return view('admin.users_list')->with($viewData);
    }

    public function getClearanceList(Request $request, Clearance $clearance)
    {
        $viewData = [
            'currentView' => 'clearance',
            'authUser' => $request->user(),
            'clearanceList' => $clearance->clearanceList()
        ];
        return view('admin.clearance_list')->with($viewData);
    }

    public function getClearancePinSlip($id, Request $request, Clearance $clearance)
    {
        $viewData = [
            'currentView' => 'clearance',
            'authUser' => $request->user(),
            'clearanceSlip' => $clearance->clearanceSlipDetail($id)
        ];
        return view('admin.clearance_slip')->with($viewData);
    }

    public function postChangePassword(ChangePasswordRequest $request, User $user)
    {
        if($user->changeAdminPassword($request->all())){
            return redirect()->route('users')->with([
                'notification_type' => 'success',
                'notification_message' => 'Password Changed Successfully!'
            ]);
        }
        return redirect()->route('dashboard')->with([
            'notification_type' => 'danger',
            'notification_message' => 'Password Change failed, try again!'
        ]);
    }

    public function getExportCsv(Clearance $clearance)
    {
        // Export CSV data
        return $clearance->exportCSV();
    }

    public function postNewUser(NewUserRequest $request, User $user)
    {
        // Guard Abuse
        if($request->user()->role_id != 2){ return redirect()->back(); }

        if($user->newAdminUser($request->all())){
            return redirect()->route('get.users')->with([
                'notification_type' => 'success',
                'notification_message' => 'New User created Successfully!'
            ]);
        }
        return redirect()->route('get.users')->with([
            'notification_type' => 'danger',
            'notification_message' => 'An error occurred while creating the User, try again!'
        ]);
    }

    public function postEditUser(EditUserRequest $request, User $user)
    {
        // Guard Abuse
        if($request->user()->role_id != 2){ return redirect()->back(); }

        if($user->editAdminUser($request->all())){
            return redirect()->route('get.users')->with([
                'notification_type' => 'success',
                'notification_message' => 'User updated Successfully!'
            ]);
        }
        return redirect()->route('get.users')->with([
            'notification_type' => 'danger',
            'notification_message' => 'An error occurred while updating the User, try again!'
        ]);
    }

    public function postNewPinSlip(PinSlipRequest $request, Clearance $clearance)
    {
        $pinSlipId = $clearance->newPinSlip($request->all(), $request->user());
        if($pinSlipId){
            return redirect()->route('get.clearance_slip',[$pinSlipId]);
        }
        return back()->with([
            'notification_type' => 'danger',
            'notification_message' => 'An error occurred while Issuing the PIN Slip, try again!'
        ])->withInput();

    }

}
