<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use File;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos=\App\Todo::all();
        return view('todo/index',compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('todo/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasfile('filename'))
            {
                $file = $request->file('filename');
                $name=time().$file->getClientOriginalName();
                $file->move(public_path().'/images/', $name);
            }
            $todo= new \App\Todo;
            $todo->name=$request->get('name');
            $todo->email=$request->get('email');
            $todo->number=$request->get('number');
            $date=date_create($request->get('date'));
            $format = date_format($date,"Y-m-d");
            $todo->date = strtotime($format);
            $todo->office=$request->get('office');
            $todo->filename=$name;
            $todo->save();
            
            return redirect('todos')->with('success', 'Information has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = \App\Todo::find($id);
        return view('todo/edit',compact('todo','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $todo= \App\Todo::find($id);
       if($request->hasfile('filename'))
             {
                File::delete(public_path().'/images/'.$todo->filename);
                $file = $request->file('filename');
                $name=time().$file->getClientOriginalName();
                $file->move(public_path().'/images/', $name);
                $todo->filename=$name;
             }
            
            $todo->name=$request->get('name');
            $todo->email=$request->get('email');
            $todo->number=$request->get('number');
            $date=date_create($request->get('date'));
            $format = date_format($date,"Y-m-d");
            $todo->date = strtotime($format);
            $todo->office=$request->get('office');
            $todo->save();
            
            return redirect('todos')->with('success', 'Information has been added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = \App\Todo::find($id);
        File::delete(public_path().'/images/'.$todo->filename);
        $todo->delete();
        return redirect('todos')->with('success','Information has been  deleted');
    }
}
