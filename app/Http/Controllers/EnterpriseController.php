<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnterpriseEditRequest;
use App\Models\Type;
use App\Models\Enterprise;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EnterpriseController extends Controller
{
    
    public function edit(Request $request){
        $data = array();

        if ($request->get('id') == null) {
            $data += ['type' => 'new'];
            $data += ['enterprise' => [
                'id' => 0,
                'reeup' => null,
                'name' => null,
                'email' => null,
            ]];
        }else{
            $data += ['type' => 'edit'];
            $data += ['enterprise' => Enterprise::find($request->id)];
        }
        return Inertia::render('Enterprise/Edit',$data);
    }

    public function info(Request $request){
        if($request->id)
            return Inertia::render('Enterprise/Info',['enterprise' => Enterprise::with('contracts')->find($request->id),'types' => Type::all()]);
        return redirect(route('enterprise.list'));
    }

    public function post(EnterpriseEditRequest $request){
        if($request->type == 'new'){
            $enterprise = new Enterprise();
        }
        else
            $enterprise = Enterprise::find($request->id);
        
        $enterprise->reeup = $request->reeup;
        $enterprise->name = $request->name;
        $enterprise->email = $request->email;
        $enterprise->save();
        return redirect(route('enterprise.info',['id' => $enterprise->id]));
    }
    
    public function search(Request $request){
        
        $data = null;
        $orderCol =  'reeup';
        $orderBy =  'asc';

        if($request->get('orderBy')){
            $orderCol = $request->orderCol;
            $orderBy = $request->orderBy;
        }
        if($request->get('search')){
            $data = Enterprise::where('reeup','like',"%{$request->search}%")->orWhere('name','like',"%{$request->search}%")->orWhere('email','like',"%{$request->search}%");
            $data = $data->orderBy($orderCol, $orderBy);
            $data = $data->paginate(10)->withQueryString();
        }else{
            $data = Enterprise::orderBy($orderCol, $orderBy);
            $data = $data->paginate(10);
        } 
        return Inertia::render('Enterprise/List',['Enterprises' => $data,'search'=>$request->search, 'orderCol' => $orderCol, 'orderBy' => $orderBy]);
        
    }
}
