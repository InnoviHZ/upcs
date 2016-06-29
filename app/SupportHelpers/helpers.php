<?php

function expandRole($id){
    $role = \Illuminate\Support\Facades\DB::table('roles')->where('id', $id)->first();
    return $role->role_name;
}

function expandUserName($id){
    $userName = \Illuminate\Support\Facades\DB::table('users')->where('id', $id)->first();
    return $userName->firstname . ' ' . $userName->lastname;
}

function dropdownRole($name, $selected = null, $attributes = []){
    $options = [];
    $roles = \Illuminate\Support\Facades\DB::table('roles')->get();
    if(count($roles) > 0){
        foreach ($roles as $role) {
            $options[$role->id] = $role->role_name;
        }
    }
    return Form::select($name, $options, $selected, $attributes);
}