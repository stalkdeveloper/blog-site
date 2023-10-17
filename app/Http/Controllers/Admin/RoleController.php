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
            $roles = $this->RoleService->userRoleUAll();
            return view('admin.role.index')->with(compact('roles'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function createUserRole(Request $request){
        try {
            $user = User::orderBy('id', 'desc')->get();

            return view('admin.role.create', compact('user'));
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

            $data = $this->RoleService->userRoleView($input['user']);
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
            $data = $this->RoleService->userRoleView($id);
            return view('admin.role.edit', compact('data'));
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
            $delete = $this->RoleService->userRoleDelete($id);
            if($delete){
                toastr()->success('Successfully,  Role User deleted!');
                return redirect('/all-user-role');
            }else{
                toastr()->error('Sorry, unable to delete!');
                return back();
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    

}
