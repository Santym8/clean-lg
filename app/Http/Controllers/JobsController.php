<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $job=Job::all();
        return view('job.index',['jobs'=>$job]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('job.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
           
        ]);

        $job=new Job;
        $job->name=$request->name;
       // $job->status=$request->status;
        $job->save();
        return redirect()->route('job.index')->with('success', 'Trabajo Creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $job=Job::find($id);
        return view('job.edit',['job'=>$job]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required',
           
        ]);
        $job=Job::find($id);
        $job->name=$request->name;
        $job->status=$request->status;
        $job->save();
       // $job->update($request->all());
        return redirect()->route('job.index')->with('success', 'Trabajo Actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $job=Job::find($id);
        $job->delete();
        return redirect()->route('job.index')->with('success', 'Trabajo Eliminado con éxito.');
    }
}
