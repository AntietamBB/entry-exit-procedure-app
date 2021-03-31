<?php

namespace App\Http\Controllers;

use App\Models\Abilities;
use App\Models\EntryForm;
use App\Models\ExitForm;
use Illuminate\Http\Request;
use Bouncer;

use App\Models\Roles;
use App\Models\User;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Roles::get();
 
        return view('admin.category.index', ['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $validated = $request->validate([
            'name' => 'required',
            'category_form' => 'required'
        ]);
        $type = ($request->category_form == 1) ? 'entry_' : 'exit_';
        $name = $type.str_replace(' ', '_', strtolower($request->name));
        $category = Bouncer::role()->firstOrCreate([
            'name' => $name,
            'title' => $request->name,
            
        ]);
        Roles::where('name',$name)->update(['form_type' => $request->category_form]);
        return redirect()->intended('category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Roles::find($id);
        return view('admin.category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Roles::where('id',$id)->update(['title' => $request->name]);
        return redirect()->intended('category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ability_ids = Bouncer::role()::find($id);
        if(!empty($ability_ids)){
            Abilities::whereIn('id',$ability_ids)->delete();
            EntryForm::whereIn('ability_id',$ability_ids)->delete();
            ExitForm::whereIn('ability_id',$ability_ids)->delete();
        }
        Roles::destroy($id);
        return redirect()->intended('category');
    }
}
