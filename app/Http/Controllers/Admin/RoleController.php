<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\RoleService;
use App\Validators\Admin\RoleValidator;
use App\Models\User;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->middleware('auth');
        $this->RoleService = $roleService;
    }

    public function allUserRole(Request $request){
        try {
            $data = userInfo(); 
            if($data->can_read == '1' || \Auth::user()->usertype == 'admin'){
                $roles = $this->RoleService->userRoleUAll();
                return view('admin.role.index')->with(compact('roles'));
            }else{
                return view('admin.error.permission-denied');
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function createUserRole(Request $request){
        try {
            $data = userInfo(); 
            if($data->can_create == '1' || \Auth::user()->usertype == 'admin'){
                $user = User::orderBy('id', 'desc')->get();
                return view('admin.role.create', compact('user'));
            }else{
                return view('admin.error.permission-denied');
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function storeUserRole(Request $request){
        try {
            $input = $request->all();
            
            $roleValidator = new RoleValidator('add');

            if (!$roleValidator->with($input)->passes()) {
                $errors = $roleValidator->getErrors();
                foreach ($errors as $error) {
                    toastr()->error($error);
                }
                return back()->withErrors($roleValidator->getValidator())->withInput();
            }

            $data = $this->RoleService->userRoleData($input['user']);
            if($data){
                toastr()->error('Sorry, this user already created their role!!');
                return back();
            }

            $store = $this->RoleService->userRoleStore($input);

            if($store){
                toastr()->success('Successfully, Role User created!');
                return redirect('/all-user-role');
            }else{
                toastr()->error('Sorry, unable to create!');
                return back();
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function viewUserRole($id){
        try {
            $data = userInfo(); 
            if($data->can_update == '1' || \Auth::user()->usertype == 'admin'){
                $data = $this->RoleService->userRoleView($id);
                return view('admin.role.edit', compact('data'));
            }else{
                return view('admin.error.permission-denied');
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function updateUserRole(Request $request){
        try {
            $input = $request->all();
            
            $roleValidator = new RoleValidator('update');

            if (!$roleValidator->with($input)->passes()) {
                $errors = $roleValidator->getErrors();
                foreach ($errors as $error) {
                    toastr()->error($error);
                }
                return back()->withErrors($roleValidator->getValidator())->withInput();
            }

            $store = $this->RoleService->userRoleUpdate($input);

            if($store){
                toastr()->success('Successfully, Role User updated!');
                return redirect('/all-user-role');
            }else{
                toastr()->error('Sorry, unable to update!');
                return back();
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function deleteUserRole($id){
        try {
            $data = userInfo(); 
            if($data->can_delete == '1' || \Auth::user()->usertype == 'admin'){

                $delete = $this->RoleService->userRoleDelete($id);
                if($delete){
                    toastr()->success('Successfully,  Role User deleted!');
                    return redirect('/all-user-role');
                }else{
                    toastr()->error('Sorry, unable to delete!');
                    return back();
                }
            }else{
                return view('admin.error.permission-denied');
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    

}
