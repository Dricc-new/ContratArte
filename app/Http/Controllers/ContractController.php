<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContractEditRequest;
use App\Models\Contract;
use App\Models\Enterprise;
use App\Models\Type;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ContractController extends Controller
{   
    public function edit(Request $request){
        $data = array();
        $data += ['contractTypes' => Type::all()];

        if ($request->get('id') == null) {
            $data += ['type' => 'new'];
            $data += ['contract' => [
                'id' => 0,
                'number' => null,
                'type_id ' => null,
                'start_date' => null,
                'end_date  ' => null,                
            ]];
            $data += ['enterprise' => $request->enterprise];
        }else{
            $data += ['type' => 'edit'];
            $contract = Contract::find($request->id);
            $data += ['contract' => $contract];
            $data += ['enterprise' => $contract->enterprise->id];
        }
        return Inertia::render('Contract/Edit',$data);
    }

    public function post(ContractEditRequest $request){
        $contract = null;
        if($request->type == 'new'){
            $enterprise = Enterprise::find($request->enterprise_id);
            if($enterprise->contracts->find($request->type_id))
                return 'error';
            $contract = new Contract();
            $contract->enterprise_id = $request->enterprise_id;
            $contract->number = $request->number;
            $contract->type_id = $request->type_id;
            $contract->start_date = $request->start_date;
            $contract->end_date = $request->end_date;

            $filename =$this->newFilename();
            $contract->filename = $filename;
            $contract->save();
            
            $request->pdf->storeAs('/contract',$filename.'.pdf','public');
            $request->datasheet->storeAs('/datasheet',$filename.'.pdf','public');
        }else{
            $contract = Contract::find($request->id);
            $contract->enterprise_id = $request->enterprise_id;
            $contract->number = $request->number;
            $contract->type_id = $request->type_id;
            $contract->start_date = $request->start_date;
            $contract->end_date = $request->end_date;
            $contract->save();
            if($request->hasFile('pdf')){
                $request->pdf->storeAs('/contract',$contract->filename.'.pdf','public');
            }            
            if($request->hasFile('datasheet')){
                $request->datasheet->storeAs('/contract',$contract->filename.'.pdf','public');
            }
        }
        return redirect(route('contract.info',['id' => $contract->id]));
    }

    public function info(Request $request){
        if($request->id)
            return Inertia::render('Contract/Info',['contract' => Contract::with('enterprise')->with('type')->find($request->id)]);
        return redirect(route('contract.list'));
    }
    
    public function search(Request $request){
        $data = null;
        $orderCol =  'number';
        $orderBy =  'asc';

        if($request->get('orderBy')){
            $orderCol = $request->orderCol;
            $orderBy = $request->orderBy;
        }
        
        if($request->get('search')){
            $data = Contract::where('number','like',"%{$request->search}%")
            ->orWhereRelation('enterprise','name','like',"%{$request->search}%")
            ->orWhereRelation('type','name','like',"%{$request->search}%")
            ->with('enterprise')->with('type');
            if($orderCol == 'enterprise')
                $data = $data->join('enterprises', 'contracts.enterprise_id', '=', 'enterprises.id')->orderBy('enterprises.name',$orderBy);
            else if($orderCol == 'type')
                $data = $data->join('types', 'contracts.type_id', '=', 'types.id')->orderBy('types.name',$orderBy);
            else
                $data = $data->orderBy($orderCol, $orderBy);
            $data = $data->paginate(10)->withQueryString();
        }else{
            if($orderCol == 'enterprise')
                $data = Contract::select('*')->join('enterprises', 'contracts.enterprise_id', '=', 'enterprises.id')->orderBy('enterprises.name',$orderBy);
            else if($orderCol == 'type')
                $data = Contract::select('*')->join('types', 'contracts.type_id', '=', 'types.id')->orderBy('types.name',$orderBy);
            else
                $data = Contract::orderBy($orderCol, $orderBy);
            $data = $data->with('enterprise')->with('type')->paginate(10);
        } 
        return Inertia::render('Contract/List',['Contracts' => $data,'search'=>$request->search, 'orderCol' => $orderCol, 'orderBy' => $orderBy]);        
    }

    protected function newFilename(){
        $filename ='';
        do {
            $filename = Uuid::uuid4()->getHex();
        } while (Contract::query()->where('filename', $filename)->first() != null);
        return $filename;
    }
}
