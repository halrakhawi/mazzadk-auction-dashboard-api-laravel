<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Address;
use \Auth;
use App\Billable;
//use Request;

class UsersController extends Controller
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
            $users = User::where('username', 'LIKE', "%$keyword%")->orWhere('email', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $users = User::latest()->paginate($perPage);
        }
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user=['userusername'=>$request->username,'password'=>bcrypt($request->password),'email'=>$request->email];
        return view('admin.users.create', compact('user'));
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
                'username' => 'required',
                'email' => 'required|string|max:255|email|unique:users',
                'password' => 'required'
            ]
        );

        $data = $request->except('password');
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        return redirect('admin/users')->with('flash_message', 'User added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
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
                'username' => 'required',
                'email' => 'required|string|max:255|email|unique:users,email,' . $id,
                'password' => 'required'
            ]
        );

        $data = $request->except('password');
        $data['password'] = bcrypt($request->password);
        $user = User::findOrFail($id);
        $user->update($data);
        return redirect('admin/users')->with('flash_message', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('admin/users')->with('flash_message', 'User deleted!');
    }

    public function auction(){
        return $this->hasMany('App\auction');
     }

     public function bid(){
        return $this->hasMany('App\Bid');
     }


    
}
