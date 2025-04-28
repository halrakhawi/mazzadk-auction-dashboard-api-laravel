<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;

class CategoryWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;
        if (!empty($keyword)) {
            $cats = category::where('cat_name', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
        } else {
            $cats = category::latest()->paginate($perPage);
        }
        return view('admin.category.index', compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $cat=['cat_name'=>$request->cat_name];
        return view('admin.category.create', compact('cat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'cat_name' => 'required'
            ]
        );

        $cat = category::create(['cat_name'=>$request->cat_name]);
        return redirect('admin/category')->with('flash_message', 'category added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cat = category::findOrFail($id);
        return view('admin.category.show', compact('cat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = category::findOrFail($id);
        return view('admin.category.edit', compact('cat'));
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
        $this->validate(
            $request,
            [
                'cat_name' => 'required'
            ]
        );
        $cat = category::findOrFail($id);
        $data['cat_name']=$request->cat_name;
        $cat->update($data);
        return redirect('admin/category')->with('flash_message', 'category updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        category::destroy($id);
        return redirect('admin/category')->with('flash_message', 'category deleted!');
    }
}
