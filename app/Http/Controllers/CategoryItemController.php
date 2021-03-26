<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Bouncer;

use App\Models\Roles;
use App\Models\Permissions;
use App\Models\Abilities;

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
        // $validated = $request->validate([
        //     'title' => 'required|unique',
        // ]);

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
    public function edit($id)
    {
        return view('admin.item.edit', []);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
