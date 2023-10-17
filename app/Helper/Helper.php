<?php
use Auth as Auth;
use App\Models\Role;

if (!function_exists('userInfo')) {
    function userInfo()
    {
        try {
            $user = Auth::user();
            $role = Role::where('user_id', $user->id)->first();
            return $role;
        } catch (\Throwable $th) {
        }
    }
}

