<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\auction;
use DB;

class auctionWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $auction = DB::table('auctions')
       ->join('products','auctions.product_id','=','products.id')
       ->join('users','auctions.user_id','=','users.id')
       ->select('auctions.auctionid','auctions.startingtime','auctions.endtime','auctions.price','users.username','products.productname','products.productdetail','products.picture')
       ->get();
       // $keyword = $request->get('search');
        //$perPage = 15;
       // if (!empty($keyword)) {
           // $auction = $auction::where('id', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
       // } else {
           // $auction = $auction::latest()->paginate($perPage);
       // }
        return view('admin.auction.index', compact('auction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $auction=['startingtime'=>$request->startingtime,'endtime'=>$request->endtime,'price'=>$request->price,'user_id'=>$request->user_id,'product_id'=>$request->product_id];
        $users=DB::table('users')->select('users.*')->get();
        $products=DB::table('products')->select('products.*')->get();

        return view('admin.auction.create', compact('auction','users','products'));
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
                'startingtime' => 'required',
                'endtime' => 'required',
                'price' => 'required',


            ]
        );

        $auction = auction::create(['startingtime'=>$request->startingtime,'endtime'=>$request->endtime,'price'=>$request->price,'user_id'=>$request->user_id,'product_id'=>$request->product_id]);
        return redirect('admin/auction')->with('flash_message', 'auction added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // $auction = auction::findOrFail($id);
       $auction = DB::table('auctions')
       ->join('products','auctions.product_id','=','products.id')
       ->join('users','auctions.user_id','=','users.id')
       ->where('auctions.auctionid',$id)
       ->select('auctions.auctionid','auctions.startingtime','auctions.endtime','auctions.price','users.username','products.productname','products.productdetail','products.picture')
       ->first();
        return view('admin.auction.show', compact('auction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $auction = auction::findOrFail($id);
        $users=DB::table('users')->select('users.*')->get();
        $products=DB::table('products')->select('products.*')->get();
        return view('admin.auction.edit', compact('auction','users','products'));
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
                'startingtime' => 'required',
                'endtime' => 'required',
                'price' => 'required',

            ]
        );
        $auction = auction::findOrFail($id);
        $data['startingtime']=$request->startingtime;
        $data['endtime']=$request->endtime;
        $data['price']=$request->price;
        $auction->update($data);
        return redirect('admin/auction')->with('flash_message', 'auction updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        auction::destroy($id);
        return redirect('admin/auction')->with('flash_message', 'auction deleted!');
    }
}
