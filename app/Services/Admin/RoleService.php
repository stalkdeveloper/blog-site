<?php

namespace App\Services\Admin;

use App\Services\Service;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\User;
use Auth;

class RoleService extends Service
{
    public function userRoleUAll(){
        try {
            $role = Role::with('users')->orderBy('id', 'desc')->paginate(10, ['*'], 'role');
            return $role;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function userRoleStore($request){
        try {
            $data = new Role();
            $data->admin_user_id = Auth::user()->id;
            $data->user_id       = $request['user'];
            $data->can_create    = $request['can_create'];
            $data->can_read      = $request['can_read'];
            $data->can_update    = $request['can_update'];
            $data->can_delete    = $request['can_delete'];
            $data->module        = $request['module'] ?? null;

            if($data->save()){
                $user = User::where('id', $request['user'])->update(['usertype' => $request['usertype']]);
                return true;
            }else{
                return false;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function userRoleView($id){
        try {
            $data = Role::with('users')->where('id', $id)->first();
            return $data;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function userRoleUpdate($request){
        try {
            $data = [
                'admin_user_id' => Auth::user()->id,
                'user_id'       => $request['user'],
                'can_create'    => $request['can_create'],
                'can_read'      => $request['can_read'],
                'can_update'    => $request['can_update'],
                'can_delete'    => $request['can_delete'],
                'module'        => null,
            ];
            
            $update = Role::where('id', $request['id'])->update($data);
            if($update){
                $user = User::where('id', $request['user'])->update(['usertype' => $request['usertype']]);
                return true;
            }else{
                return false;
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage() . " " . $e->getFile() . " " . $e->getLine());
        }
    }

    public function userRoleDelete($id){
        try {
            $data = Role::where('id', $id)->first();
            $user = User::where('id', $data->user_id)->update(['usertype' => 'user']);

            if($data->delete()){
                return true;
            }else{
                return false;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}