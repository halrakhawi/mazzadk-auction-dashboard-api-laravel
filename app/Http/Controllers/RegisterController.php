<?php


namespace App\Http\Controllers;


use Request as HttpRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;

use App\User;
use App\Address;
use App\Favorite;
use DB;
use Illuminate\Support\Facades\Auth;
//use Auth;
use Validator;


class RegisterController extends BaseController

{

    /**

     * Register api

     *

     * @return \Illuminate\Http\Response

     */

    public function register(Request $request)

    {

        $validator = Validator::make($request->all(), [

            'username' => 'required',

            'email' => 'required|email',

            'password' => 'required',

            'c_password' => 'required|same:password',

        ]);


        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());       

        }


        $input = $request->all();

        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        $success['token'] =  $user->createToken('MyApp')->accessToken;

        $success['username'] =  $user->username;


        return $this->sendResponse($success, 'User register successfully.');

    }

    public function address(){
        $address=new Address();

        $user_id =auth('api')->id();
        
        $address->address = HttpRequest::input('address');

        $address->house_no = HttpRequest::input('house_no');

        $address->road_no = HttpRequest::input('road_no');
        $address->user_id=$user_id;

        $address->save();


        return $this->sendResponse($address->toArray(), 'Address updated successfully.');

    }
    public function getaddress(){
        $address = Address::all();
        return $this->sendResponse($address->toArray(), 'Addresses retrieved successfully.');
    }
    public function profile(){
        $user_id=auth('api')->id();
        $profile=DB::table('addresses')->join('users','users.id','=','addresses.user_id')
        ->where('users.id','=',$user_id)
        ->select('users.username','users.email','addresses.address','addresses.house_no','addresses.road_no')
        ->get();
        
        return $this->sendResponse($profile->toArray(), 'Addresses retrieved successfully.');

    }

    public function addTofav(Request $request)
    {
        $fav=new Favorite();
        $user_id =auth('api')->id();
        $fav->user_id=$user_id;
        $fav->product_id=$request->product_id;

        $fav->save();

        return $this->sendResponse($fav->toArray(), 'Favorite Added successfully.');

    }
public function getFav()
{
    $user_id=auth('api')->id();
    $fav=DB::table('favorites')->join('users','users.id','=','favorites.user_id')
    ->where('users.id','=',$user_id)
    ->join('products','products.id','=','favorites.product_id')
    ->select('products.productname','products.picture','products.price')
    ->get();

    return $this->sendResponse($fav->toArray(), 'Favorite retrieved successfully.');
}

}