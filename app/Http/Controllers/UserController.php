<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{

    public function edit(Request $request){
        $data = array();
        $data += ['contractTypes' => Role::all()];

        if ($request->get('id') == null) {
            $data += ['type' => 'new'];
            $data += ['user' => [
                'id' => 0,
                'name'=> null,
                'password'=> null,
                'rol' => null,             
            ]];
            $data += ['enterprise' => $request->enterprise];
        }else{
            $data += ['type' => 'edit'];
            $user = User::find($request->id);
            $data += ['user' => $user];
            $data['user']->password = decrypt($user->password);
        }
        return Inertia::render('User/Edit',$data);
    }    
    
    public function post(Request $request){
        if($request->type == 'new'){
            $user = new User();
        }
        $user->name = $request->name;
        $user->email = $request->name.'@artra.co.cu';
        $user->password = bcrypt($request->password);
        $user->save();
        
        $user->roles()->attach(3);
        if($request->role == '2') $user->roles()->attach(2);
        
        return redirect(route('home'));
    }

    public function list(){
        return Inertia::render('User/List',['Users' => User::with('roles')->select('id','name')->orderBy('name','asc')->get()]);
    }
}
