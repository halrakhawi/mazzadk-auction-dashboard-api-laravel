<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseController as BaseController;


use App\Bid;

use Validator;

use DB;


class BidWebController extends BaseController
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
      return view('admin.bid.index', compact('bids'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $bid=['product_id'=>$request->product_id,'user_id'=>$request->user_id,'bidprice'=>$request->bidprice,'currentprice'=>$request->currentprice,'biddingtime'=>$request->biddingtime];
        $users=DB::table('users')->select('users.*')->get();

        return view('admin.bid.create', compact('bid','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = ['product_id'=>$request->product_id,'user_id'=>$request->user_id,'bidprice'=>$request->bidprice,'currentprice'=>$request->currentprice,'biddingtime'=>$request->biddingtime];

        $bid = bid::create($input);
 
 
        return redirect('admin/bid')->with('flash_message', 'bid added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$bid = bid::find($id);
        $bid=DB::table('bids')->join('users','bids.user_id','users.id')
        ->select('bids.*','users.username')
        ->where('bids.bidid',$id)
        ->first();

        if (is_null($bid)) {

            return $this->sendError('bid not found.');

        }


        return view('admin.bid.show', compact('bid'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bid = bid::findOrFail($id);
        $users=DB::table('users')->select('users.*')->get();

        return view('admin.bid.edit', compact('bid','users'));
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
        $input = $request->all();


        $bid->bidprice = $input['bidprice'];

        $bid->currentprice = $input['currentprice'];

        $bid->biddingtime = $input['biddingtime'];

        $bid->save();


        return redirect('admin/bid')->with('flash_message', 'bid updated!');

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

        return redirect('admin/bid')->with('flash_message', 'bid deleted!');
    }

   

    public function user(){
        return $this->belongsTo('App\User');
    }


}
