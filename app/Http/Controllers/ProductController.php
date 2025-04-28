<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Controllers\BaseController as BaseController;

use App\Product;
use App\vedioRequest;

use Validator;
use DB;
use URL;

class ProductController extends BaseController

{
    /*

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
       
       
       $products = DB::table('products')->join('categories','categories.id','products.cat_id')
       ->select('products.productname','products.productdetail','products.picture','products.price','products.remainingtime','products.user_id','products.veiws','categories.cat_name')
       ->get();
        
        return $this->sendResponse($products->toArray(), 'Products retrieved successfully.');

    }


    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store1(Request $request)

    {
        
       // $this->uploadTest($request);
        $input = $this->store($request);


        /*$validator = Validator::make($input, [

            'name' => 'required',

            'detail' => 'required',

            

        ]);


        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());       

        }
*/

        //$product = Product::create($input);


        return $this->sendResponse($input, 'Product created successfully.');

    }


    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {
        $product= Product::find($id);
        $product->veiws +=1;
        $product->save();
        if (is_null($product)) {

            return $this->sendError('Product not found.');

        }


        return $this->sendResponse($product->toArray(), 'Product retrieved successfully.');

    }


    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, Product $product)

    {
        //$this->uploadTest($request);

        $input = $this->store($request);


        $validator = Validator::make($input, [

            'productname' => 'required',

           'productdetail' => 'required',


        ]);


        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());       

        }


        $product->productname = $input['productname'];

        $product->productdetail = $input['productdetail'];

        $product->picture = $input['picture'];

        $product->vedio = $input['vedio'];

        $product->price = $input['price'];

        $product->save();


        return $this->sendResponse($product->toArray(), 'Product updated successfully.');

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


        return $this->sendResponse($product->toArray(), 'Product deleted successfully.');

    }

    public function store(Request $request) {
        
        $product=new Product();
        $product->productname=$request->input('productname');
        $product->productdetail=$request->input('productdetail');
        $product->cat_id=$request->input('cat_id');
        //$product->user_id=$request->input('user_id');
        $product->user_id=auth('api')->id();
        //$user_id =auth('api')->id();
        $product->price=$request->input('price');
        $product->remainingtime=$request->input('remainingtime');
        if(!$request->hasFile('picture')) {
            $product->picture=URL::asset('/uploads/images/Default.png');
            $product->save();
            $p_id=$product->id;
            $video_request=new vedioRequest();
            $video_request->product_id=$p_id;
            $video_request->details=$request->details;
            $video_request->user_id=auth('api')->id();
            $video_request->save();
            $array=['productname'=>$product->productname,'productdetail'=>$product->productdetail,'details'=>$video_request->details,'cat_id'=>$product->cat_id];
            return response()->json(['done'], 200);
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
       return response()->json(['done'], 200);

     }}

     public function feature()
     {
        $products = DB::table('products')
        ->orderBy('veiws', 'desc')
        ->get();
         
         return $this->sendResponse($products->toArray(), 'Featured Products retrieved successfully.');
     }
     
     public function best()
     {
        $products = DB::table('bids')->join('products','products.id','bids.product_id')
        ->select('products.*','bids.bidprice')
        ->orderBy('bidprice', 'desc')
        ->get();
         
         return $this->sendResponse($products->toArray(), 'Featured Products retrieved successfully.');
     }

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