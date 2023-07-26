<?php

namespace App\Http\Controllers;

use App\Role;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    use DeleteModelTrait;
    private $user;
    private $role;
    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function index(){
        $users = $this->user->paginate(10);
        return view('admin.users.index',compact('users'));
    }
    public function create(){
        $roles = $this->role->all();
        return view('admin.users.add', compact('roles'));
    }
    public function store(Request $request){
//               $roleIds = $request->role_id;    viết hàm thuần
//        foreach ($roleIds as $roleItem){
//            \DB::table('role_user')->insert([
//                'user_id' => $users->id,
//                'role_id' => $roleItem
//            ]);
//        }
        try{
            DB::beginTransaction();
            $users = $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->Password)
            ]);

            $roleIds = $request->role_id;
            $users->roles()->attach($roleIds);
            DB::commit();
            return redirect()->route('users.index');
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error('Message :'.$exception->getMessage() . '---line:' .$exception->getLine());
        }
    }
    public function edit($id){
        $roles = $this->role->all();
        $users = $this->user->find($id);
        $roleUser = $users->roles;
        return view('admin.users.edit', compact('roles','users','roleUser'));
    }
    public function update($id, Request $request){
        try{
            DB::beginTransaction();
            $this->user->find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->Password)
            ]);
            $users = $this->user->find($id);
            $users->roles()->sync($request->role_id);
            DB::commit();
            return redirect()->route('users.index');
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error('Message :'.$exception->getMessage() . '---line:' .$exception->getLine());
        }
    }
    public function delete($id){
        return $this->deleteModelTrait($id, $this->user);

    }
}
