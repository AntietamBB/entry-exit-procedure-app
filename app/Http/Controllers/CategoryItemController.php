<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Bouncer;

use App\Models\Roles;
use App\Models\Permissions;
use App\Models\Abilities;
use App\Models\EntryForm;
use App\Models\ExitForm;

class CategoryItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category_id)
    {
        $category = Roles::where("id", "=", $category_id)->first();

        $permissions = Permissions::where("entity_id", "=", $category_id)->select(['ability_id'])->get();
        
        $items = Abilities::whereIN('id', $permissions)->get();

        return view('admin.item.index', ['items'=>$items, 'category'=>$category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($category_id)
    {
        $category = Roles::where("id", "=", $category_id)->first();
        
        return view('admin.item.create', ['category'=>$category]);
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
        ]);

        $category = Roles::where("id", "=", $request->category_id)->first();

        // $item = Bouncer::ability()->firstOrCreate([
        //     'name' => str_replace(' ', '_', strtolower($request->name)),
        //     'title' => $request->name,
        // ]);
        $role = $category->name;
        $ability = str_replace(' ', '_', strtolower($request->name));

        Bouncer::allow($role)->to($ability);
        
        return redirect()->intended('category/'.$request->category_id.'/item');
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
    public function edit($category_id,$item_id)
    {   
        $item = Abilities::find($item_id);
        return view('admin.item.edit', ['item' => $item ,'category_id' => $category_id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category_id,$item_id)
    {
        Abilities::where('id',$item_id)->update(['title' => $request->name]);
        return redirect()->intended('category/'.$category_id.'/item');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($category_id,$item_id)
    {
        Abilities::destroy($item_id);
        EntryForm::where('ability_id',$item_id)->delete();
        ExitForm::where('ability_id',$item_id)->delete();
        return redirect()->intended('category/'.$category_id.'/item');
    }
}
