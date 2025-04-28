<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;

use App\auction;
use App\vedioRequest;
use URL;
use Validator;

use DB;

class VRController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$VR=vedioRequest::all();
        $VR=DB::table('vediorequest')
        ->join('users','vediorequest.user_id','users.id')
        ->join('products','vediorequest.product_id','products.id')
        ->select('vediorequest.*','users.username','products.productname')->get();
        return view('admin.vedio.index', compact('VR'));

        // return $this->sendResponse($VR->toArray(), 'vedioRequest retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        
        $VR = vedioRequest::create($input);
        return redirect('admin/vedio')->with('flash_message', 'vedio added!');


        //return $this->sendResponse($VR->toArray(), 'vedioRequest created successfully.');
    }
    public function create(Request $request)
    {
        $VR=['user_id'=>auth('api')->id(),'product_id'=>$request->product_id,'details'=>$request->details,'done'=>$request->done,'url'=>$request->url];
        $users=DB::table('users')->select('users.*')->get();
        $products=DB::table('products')->select('products.*')->get();
        return view('admin.vedio.create', compact('VR','users','products'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // $VR = vedioRequest::find($id);
        $VR=DB::table('vediorequest')
        ->join('users','vediorequest.user_id','users.id')
        ->join('products','vediorequest.product_id','products.id')
        ->select('vediorequest.*','users.username','products.productname')
        ->where('vediorequest.id',$id)->first();

        if (is_null($VR)) {

            return $this->sendError('vedioRequest not found.');

        }

        return view('admin.vedio.show', compact('VR'));

       // return $this->sendResponse($VR->toArray(), 'vedioRequest retrieved successfully.');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $VR = vedioRequest::findOrFail($id);
        $users=DB::table('users')->select('users.*')->get();
        $products=DB::table('products')->select('products.*')->get();
        return view('admin.vedio.edit', compact('VR','users','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $VR=vedioRequest::find($id);
        $input=['id'=>$request->id,'user_id'=>auth('api')->id(),'product_id'=>$request->product_id,'details'=>$request->details,'done'=>$request->done,'url'=>$request->url];

        $VR->user_id=auth('api')->id();
        $VR->product_id=$input['product_id'];
        $VR->details=$input['details'];
        $VR->done=$input['done'];
        if($request->hasFile('url')) {

            $fileext=$request->file('url')->getClientOriginalExtension();
            $filename=time().'.'.$fileext;
            $path = $request->file('url')->move(public_path('/uploads/vedios/'), $filename);
           $url=URL::asset('/uploads/vedios/'.$filename);
            $VR->url=$url;
      }
         
      $VR->save();
     // dd($id);
       // $VR->save($input);
        return redirect('admin/vedio')->with('flash_message', 'vedio updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $VR = vedioRequest::findOrFail($id);
        $VR->delete();


        return redirect('admin/vedio')->with('flash_message', 'vedio deleted!');
       // return $this->sendResponse($VR->toArray(), 'vedioRequest deleted successfully.');
    }

    public function product()
    {
        return $this->hasOne('App\Product');
    }
}
