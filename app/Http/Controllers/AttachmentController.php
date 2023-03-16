<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\AttachmentType;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->get('id')){
            return Inertia::render('Attachment/Edit',['id' => $request->id, 'types' => AttachmentType::where('id','>','2')->get()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $filename =$this->newFilename();
        $attachment = new Attachment;
        $attachment->attachmenttype_id = $request->attachmenttype_id;
        $attachment->contract_id = $request->contract_id;
        $attachment->filename = $filename;
        $attachment->save();     
        $attachType1 = AttachmentType::find($request->attachmenttype_id);
        $request->attachment->storeAs('/'.$attachType1->folder,$filename.'.pdf','public');
        return redirect(route('contract.info',['id' => $request->contract_id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function show(Attachment $attachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function edit(Attachment $attachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attachment $attachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attachment $attachment)
    {
        //
    }

    protected function newFilename(){
        $filename ='';
        do {
            $filename = Uuid::uuid4()->getHex();
        } while (Attachment::query()->where('filename', $filename)->first() != null);
        return $filename;
    }
}
