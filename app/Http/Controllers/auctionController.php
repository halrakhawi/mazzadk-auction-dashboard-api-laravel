<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseController as BaseController;

use App\auction;

use Validator;

use DB;

class auctionController extends BaseController
{
    //
    public function index()

    {
        
       
       $auctions = DB::table('auctions')
       ->join('products','auctions.product_id','=','products.id')
       ->join('users','auctions.user_id','=','users.id')
       ->select('auctions.startingtime','auctions.endtime','auctions.price','users.username','products.productname','products.productdetail','products.picture')
       ->get();
       //$auctions = auction::all();
        return $this->sendResponse($auctions->toArray(), 'auctions retrieved successfully.');

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)

    {

        $input = $request->all();

       
       $auction = auction::create($input);


        return $this->sendResponse($auction->toArray(), 'auction created successfully.');

    }

    public function show($id)

    {

       // $auction = auction::find($id);
       $auction = DB::table('auctions')
       ->join('products','auctions.product_id','=','products.id')
       ->join('users','auctions.user_id','=','users.id')
       ->select('auctions.auctionid','auctions.startingtime','auctions.endtime','auctions.price','users.username','products.productname','products.productdetail','products.picture')
       ->where('auctions.auctionid','=',$id)
       ->get();

        if (is_null($auction)) {

            return $this->sendError('auction not found.');

        }


        return $this->sendResponse($auction->toArray(), 'auction retrieved successfully.');

    }

    public function update(Request $request, Product $product)

    {

        $input = $request->all();


        $auction->startingtime = $input['startingtime'];

        $auction->endtime = $input['endtime'];

        $auction->price = $input['price'];

        $auction->save();


        return $this->sendResponse($auction->toArray(), 'auction updated successfully.');

    }

    public function destroy(auction $auction)

    {

        $auction->delete();


        return $this->sendResponse($auction->toArray(), 'auction deleted successfully.');

    }

    

    public function product(){
        return $this->belongsTo('App\Product');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function bid(){
        return $this->hasMany('App\Bid');
     }

}
