<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController as BaseController;

use App\category;

class categorycontroller extends BaseController
{
    //
    public function index()

    {
    $category=category::all();
    return $this->sendResponse($category->toArray(), 'Categories retrieved successfully.');
    }

    public function store(Request $request)

    {

        $input = $request->all();


        $validator = Validator::make($input, [

            'cat_name' => 'required',

        ]);


        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());       

        }


        $category = category::create($input);


        return $this->sendResponse($category->toArray(), 'category created successfully.');

    }


    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        $category = category::find($id);


        if (is_null($category)) {

            return $this->sendError('category not found.');

        }


        return $this->sendResponse($category->toArray(), 'category retrieved successfully.');

    }


    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, category $category)

    {

        $input = $request->all();


        $validator = Validator::make($input, [

            'cat_name' => 'required',

        ]);


        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());       

        }


        $category->name = $input['cat_name'];

        $category->save();


        return $this->sendResponse($category->toArray(), 'category updated successfully.');

    }


    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy(category $category)

    {

        $category->delete();


        return $this->sendResponse($category->toArray(), 'category deleted successfully.');

    }

    public function product(){
       return $this->hasMany('App\category');
    }

}
