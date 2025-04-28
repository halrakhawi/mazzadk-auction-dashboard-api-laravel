<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Controllers\BaseController as BaseController;

use App\Product;
use App\category;
use App\vedioRequest;

use Validator;
use DB;
use URL;

class ProductWebController extends BaseController

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */
    public function index()

    {
        //$filename='baby.jpg';
       
       //$products = Product::all();
       //$product['picture']=URL::asset('/uploads/images/'.$filename);
       //$products = DB::table('products')->select('name','detail','picture')
       //->get();
       
       
       $products = DB::table('products')->join('categories','products.cat_id','categories.id')
       ->select('products.id','products.productname','products.productdetail','products.picture','categories.cat_name')
       ->get();

       return view('admin.product.index', compact('products'));

    }


    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function create()
    {
        //$products=Product::with('category')->get();
       // $product=['productname'=>$request->productname,'productdetail'=>$request->productdetail,'picture'=>$request->picture,'cat_id'=>$request->cat_id];
       $products = DB::table('products')->join('categories','products.cat_id','categories.id')
       ->select('products.id','products.productname','products.productdetail','products.picture','products.price','categories.cat_name')
       ->get();
       $categories=DB::table('categories')->select('categories.*')->get();
       $users=DB::table('users')->select('users.*')->get();
        return view('admin.product.create', compact('products','categories','users'));
    }

    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {
        //$product= Product::find($id);
        $product = DB::table('products')->join('categories','products.cat_id','categories.id')
       ->select('products.id','products.productname','products.productdetail','products.picture','categories.cat_name')
       ->where('products.id',$id)
       ->first();

        if (is_null($product)) {

            return $this->sendError('Product not found.');

        }


        return view('admin.product.show', compact('product'));

    }


    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */
    public function edit($id)
    {
        $product = product::findOrFail($id);
        $categories=DB::table('categories')->select('categories.*')->get();
        $users=DB::table('users')->select('users.*')->get();
        return view('admin.product.edit', compact('product','categories','users'));
    }
    public function update(Request $request, Product $product)

    {
        //$this->uploadTest($request);
        $input=['productname'=>$request->productname,'productdetail'=>$request->productdetail,'picture'=>$request->picture,'cat_id'=>$request->cat_id];

       // $input = $this->store($request);


        $validator = Validator::make($input, [

            'productname' => 'required',

           'productdetail' => 'required',


        ]);


        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());       

        }


        $product->productname = $input['productname'];

        $product->productdetail = $input['productdetail'];

        $product->remainingtime = $input['remainingtime'];

        $product->price = $input['price'];

        $product->cat_id = $input['cat_id'];

        if($request->hasFile('picture')) {

        $fileext=$request->file('picture')->getClientOriginalExtension();
        //$filename=$request->file('picture')->getClientOriginalName();
        $filename=time().'.'.$fileext;
        $path = $request->file('picture')->move(public_path('/uploads/images/'), $filename);
       $url=URL::asset('/uploads/images/'.$filename);//url('\uploads\images'.$filename);
       $product->picture=$url;
        }
        $product->save();


        return redirect('admin/product')->with('flash_message', 'product updated!');

    }


    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy(Product $product)

    {

        $product->delete();


        return redirect('admin/product')->with('flash_message', 'product deleted!');

    }

    public function store(Request $request) {
        
        $product=new Product();
        $product->productname=$request->input('productname');
        $product->productdetail=$request->input('productdetail');
        $product->cat_id=$request->input('cat_id');
        $product->price=$request->input('price');
        $product->user_id=$request->input('user_id');
        $product->remainingtime=$request->input('remainingtime');
       // $product->category()->cat_name=input('cat_name');
        if(!$request->hasFile('picture')) {
            $product->picture=URL::asset('/uploads/images/Default.png');
            $product->save();
            $p_id=$product->id;
            $video_request=new vedioRequest();
            $video_request->product_id=$p_id;
            $video_request->details=$request->details;
            $video_request->user_id=$request->user_id;
            $video_request->done=$request->done;
            $video_request->url=$request->url;
            $video_request->save();
            $array=['productname'=>$product->productname,'productdetail'=>$product->productdetail,'details'=>$video_request->details,'cat_id'=>$product->cat_id];
            return redirect('admin/product')->with('flash_message', 'product added!');
        }else{
        $file = $request->file('picture');
        if(!$file->isValid()) {
            return response()->json(['invalid_file_upload'], 400);
        }
        $fileext=$request->file('picture')->getClientOriginalExtension();
        //$filename=$request->file('picture')->getClientOriginalName();
        $filename=time().'.'.$fileext;
        $path = $request->file('picture')->move(public_path('/uploads/images/'), $filename);
       $url=URL::asset('/uploads/images/'.$filename);//url('\uploads\images'.$filename);
       $product->picture=$url;
       $product->save();
       //dd($path);
       $array=['productname'=>$product->productname,'productdetail'=>$product->productdetail,'picture'=>$product->picture,'cat_id'=>$product->cat_id];
       return redirect('admin/product')->with('flash_message', 'product added!');

     }}
     
    public function category(){
        return $this->belongsTo('App\Product');
    }

    public function auction(){
        return $this->hasOne('App\auction');
    }

    public function vedioRequest(){
        return $this->belongsTo('App\vedioRequest');
    }

}