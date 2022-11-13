<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;
use Auth;
use Hash;

class UserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin', ['only' => ['index','store','create','edit','update','delete']]);  
    }

    
    public function index(Request $request)
    {
        $users=User::getAll($request->search);

        $data['user']=$users;

        return view('user.index',$data);
    }


    public function create()
    {   
        $data['roles']=Role::all();
        return view('user.create',$data);
    }


    public function store(Request $request)
    {
            $request->validate([
                'name' => 'required','string','max:255',
                'email' => ['required','string','email','max:100','unique:users,email'],
                'role' => 'required','string','max:255',
                'password' => [
                    'required',
                    'min:6',
                    'confirmed'
                ],
                'password_confirmation' => 'required'
               

            ]);
        
            $data = $request->all();
            $data['password']=Hash::make($request->password);
            $data['created_by']=Auth::id();
            $data['updated_by']=Auth::id();
            $data['updated_at']=Carbon::now();
            

            $user=User::create($data);

            if($user)
            {
                $user->syncRoles([]);
                $user->assignRole($request->role);
                
                return   redirect()->route('user.index')->with(['message' => 'Great! User Created Successfully', 'type' => 'success']);

            }

            return redirect()->route('user.index')->with(['message' => 'Oops! Something Went Wrong', 'type' => 'alert']);
    
    }


    public function edit(Request $request,$id)
    {
        
        $user=User::find($id);

        if(isset($user) && !empty($user)):

            $data['userdata']=$user;
            $data['roles']=Role::all();
            return view('user.edit',$data);

        endif;

        return back()->with(['message' => 'Oops! No User Found', 'type' => 'alert']);


    }

    public function update(Request $request,$id)
    {

         $request->validate([
                'name' => 'required','string','max:255',
                'email' => ['required','string','email','max:100','unique:users,email,'.$id.',id'],
                'role' => 'required','string','max:255'
               

        ]);

        $user=User::find($id);

        if(isset($user) && !empty($user)):


            if(isset($request->password) && !empty($request->password)):
                $user->password=Hash::make($request->password);
            endif;

            $user->name=$request->name;
            $user->email=$request->email;
            $user->save();

            $user->syncRoles([]);
            $user->assignRole($request->role);

            return back()->with(['message' => 'Great! User Updated Successfully', 'type' => 'success']);

        endif;

        return back()->with(['message' => 'Oops! No User Found', 'type' => 'alert']);
    }

    public function delete()
    {
       $user=User::find($id);

        if(isset($user) && !empty($user)):

            $user->isactive=0;    
            $user->save();

            return back()->with(['message' => 'Great! User Deactivated Successfully', 'type' => 'success']);

        endif;

        return back()->with(['message' => 'Oops! No User Found', 'type' => 'alert']);
    }
}
