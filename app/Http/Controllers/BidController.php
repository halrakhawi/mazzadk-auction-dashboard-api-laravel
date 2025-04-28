<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseController as BaseController;


use App\Bid;
use App\auction;
use Carbon;
use Validator;

use DB;


class BidController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bids=DB::table('bids')->join('users','bids.user_id','users.id')
        ->select('bids.*','users.username')
       ->get();
      // $bids=bid::all();
       return $this->sendResponse($bids->toArray(), 'bids retrieved successfully.');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // $input = $request->all();   DB::table('orders')->max('price');
        $bid=new bid();
        $bid->product_id = $request->input('product_id');

        $bid->user_id = auth('api')->id();

        $bid->bidprice = $request->input('bidprice');

         $maxbid=DB::table('bids')->join('products','products.id','bids.product_id')
         ->where('products.id',$bid->product_id)
         ->max('bidprice');
         if($bid->bidprice>$maxbid)
          $maxbid=$bid->bidprice;
        $bid->currentprice =$maxbid;

        
        $bid->biddingtime = $request->input('biddingtime');

        

        $bid->save();
 
 
         return $this->sendResponse($bid->toArray(), 'auction created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bid = bid::find($id);


        if (is_null($bid)) {

            return $this->sendError('bid not found.');

        }


        return $this->sendResponse($bid->toArray(), 'bid retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $bid=new bid();
        $bid->product_id = $request->input('product_id');

        $bid->user_id = auth('api')->id();

        $bid->bidprice = $request->input('bidprice');

         $maxbid=DB::table('bids')->join('products','products.id','bids.product_id')
         ->where('products.id',$bid->product_id)
         ->max('bidprice');

        $bid->currentprice =$maxbid;

        $bid->biddingtime = $request->input('biddingtime');

        $bid->save();
 


        return $this->sendResponse($bid->toArray(), 'bid updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bid->delete();

        return $this->sendResponse($bid->toArray(), 'bid deleted successfully.');
    }


    public function winnerbid($id){
        $etime=DB::table('products')->join('bids','products.id','bids.product_id')
        ->select('products.remainingtime')
        ->where('products.id',$id)
       ->first();
      $dteStart = \DateTime::createFromFormat ( "Y-m-d H:i:s", $etime->remainingtime );
      $start = Carbon\Carbon::instance($dteStart);
       $dteEnd = Carbon\Carbon::now(); 
       $diff= $dteEnd->diffInDays($start);
       if($start<=$dteEnd)
      //if($diff>0)
      {
        $maxbid=DB::table('bids')->join('products','products.id','bids.product_id')
        ->where('products.id',$id)
        ->max('bidprice');

          $userid=DB::table('bids')->join('products','products.id','bids.product_id')
        ->select('bids.user_id')
        ->where('products.id',$id)
       ->first();
       //return  $maxbid;
       return $this->sendResponse([$maxbid,$userid, $start,$dteEnd,$diff], 'etime successfully.');

      }
       else
       return 'error';
       return $this->sendResponse($maxbid, 'error.');
    }

   public function mybiddings()
   {
    $user_id=auth('api')->id();
    $bids=DB::table('bids')
    ->join('users','users.id','bids.user_id')
    ->join('products','products.id','=','bids.product_id')
    ->where('users.id','=',$user_id)
    ->select('bids.*','users.username','products.productname','products.picture','products.price')
   ->get();
   return $this->sendResponse($bids, 'Mybiddings retrieved successfully.');
   }
    public function user(){
        return $this->belongsTo('App\User');
    }


}
