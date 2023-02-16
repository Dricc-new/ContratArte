<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('User/Edit',['type'=>'new']);
    }

    public function edit($id){
        return Inertia::render('User/Edit',['type'=>'edit']);
    }    
    
    public function post(Request $request){
        return redirect(route('home'));
    }

    public function list(){
        return Inertia::render('User/List',['Users' => User::with('roles')->select('id','name')->orderBy('name','asc')->get()]);
    }
}
