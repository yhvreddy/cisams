<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Enums\AccountStatus;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UserManagement\CreateUserRequest;
use App\Http\Requests\UserManagement\UpdateUserRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Traits\HandlesCustomExceptions;
use Illuminate\Support\Facades\Hash;


class UserManagementController extends Controller
{
    use HandlesCustomExceptions;

    protected User $users;
    protected Role $role;

    public function __construct(
        User $_users,
        Role $_role
    ){
        $this->users = $_users;
        $this->role = $_role;
    }

    public function index(Request $request){
        $users = $this->users->with('roles')->get();
        return view('pages.user-management.index', compact('users'));
    }

    public function create(Request $request){
        $status = AccountStatus::values();
        $roles = Role::all();
        return view('pages.user-management.create', compact('status', 'roles'));
    }

    public function store(CreateUserRequest $request){
        DB::beginTransaction();
        try {
            $role = $this->role->find($request->role_id);
            if(!$role){
                DB::rollBack();
                return redirect()->route('user-management.create')->with('failed', 'Invalid request to create user.');
            }

            $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'username'  => $request->username,
                'mobile'    => $request->mobile ?? null,
                'password'  => Hash::make($request->password),
                'status'    => $request->status,
                'role_id'   => $role->id
            ]);
            if($user){
                $user->assignRole($role);
                DB::commit();
                return redirect()->route('user-management.index')->with('success', 'User created successfully');
            }

            DB::rollBack();
            return redirect()->route('user-management.create')->with('failed', 'User not created.');

        } catch (Exception $e) {
            DB::rollBack();
            return $this->handleException($e, 'user-management.create');
        }
    }

    public function edit(User $user){
        $status = AccountStatus::values();
        $roles = Role::all();
        return view('pages.user-management.edit', compact('status', 'roles', 'user'));
    }

    public function update(User $user, UpdateUserRequest $request){
        DB::beginTransaction();
        try {
            $role = $this->role->find($request->role_id);
            if(!$role){
                DB::rollBack();
                return redirect()->route('user-management.create')->with('failed', 'Invalid request to update user.');
            }

            $user->name         =   $request->name;
            $user->email        =   $request->email;
            // $user->username     =   $request->username;
            $user->mobile       =   $request->mobile ?? null;
            if(!empty($request->password)){
                $user->password = Hash::make($request->password);
            }
            $user->status   = $request->status;
            $user->role_id  = $role->id;
            if($user->save()){
                $user->assignRole($role);
                DB::commit();
                return redirect()->route('user-management.index')->with('success', 'User updated successfully');
            }

            DB::rollBack();
            return redirect()->route('user-management.create')->with('failed', 'User not created.');

        } catch (Exception $e) {
            DB::rollBack();
            return $this->handleException($e, 'user-management.index');
        }
    }

    public function delete(User $user){
        DB::beginTransaction();
        try{
            if($user->delete()){
                DB::commit();
                return redirect()->route('user-management.index')->with('success', 'User deleted successfully');
            }

            DB::rollBack();
            return redirect()->route('user-management.index')->with('failed', 'User not deleted.');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->handleException($e, 'user-management.index');
        }
    }

}
