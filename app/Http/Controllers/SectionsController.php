<?php

namespace App\Http\Controllers;

use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Reques;


class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = sections::all();
        
        return view('sections.sections',compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $b_exist = sections::where('section_name','=',$input['section_name'])->exists();

        if($b_exist)
        {
            session()->flash('Error','خطا اسم القسم مسجل مسبقا');
            return redirect('/sections');
        }
        else{

            sections::create([
                'section_name' => $request->section_name,
                'description' => $request->section_description,
                'created_by' => (Auth::user()->name),
            ]);
            session()->flash('Add','تم التسجيل بنجاح');
            return redirect('/sections');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
     $id = $request->id;

    //  $this->validate($request, [
    //      'section_name' => 'required| unique:sections,section_name,'.$id,
    //      'describtion' => 'required',
    //  ]);

     $sections = sections::find($id);
     $sections->update([
        'section_name' => $request->section_name,
        'description' => $request->description,
     ]);

     session()->flash('Edit','تم التعديل بنجاح');
            return redirect('/sections');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        $id = $request->id;
        //return $id ;
        $sections = sections::find($id)->delete();
        
        session()->flash('Delete','تم الحذف بنجاح');
        return redirect('/sections');
    }
}
