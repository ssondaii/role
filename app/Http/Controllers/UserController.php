<?php

namespace App\Http\Controllers; 

use App\User;
use App\Role;
use App\DetaiUser;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get()->load('roles');
        return $users;
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
        $data = $request->input('user');
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt('123456');
        $user->address = 'Ha Noi';
        $user->age = '20';
        $user->gender = 'Male';
        $user->img = '/image/user.png';
        $user->score = 0;
        $role  = Role::where('name', $data['role'])->first();

        $user->save();

        $user->roles()->attach($role);
        return response('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id)->load('roles');
        return $user;
        // return view('detailedUser');
        // return response([
        //     'result' => 'call show() function'
        // ], 200);
        // return Redirect::to('Admin_detailedUser')->with('user',1);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {   


        // $user = User::find($id);
        // $user->address = $request->input('address');
        // $user->age = $request->input('age');
        // $user->gender = $request->input('gender');

        // $user->save();

        // return response([
        //     'result' => $request->input('address')
        // ], 200);
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

        $data = $request->input('userEdit');
        $typeEdit = $request->input('typeEdit');

        if($typeEdit==1){
            $user = User::find($data['id']);
            $user->name = $data['name'];
            $user->email = $data['email'];

            $newRole  = Role::where('name', $data['newRole'])->first();
            $oldRole  = Role::where('name', $data['oldRole'])->first();

            $user->save();

            $user->roles()->attach($newRole);
            $user->roles()->detach($oldRole['id']);
            return response([
                'result' => 'typeEdit==1 success'
            ], 200);
        }
        else if($typeEdit==2){

            $user = User::find($id);
            $user->address = $data['address'];
            $user->age = $data['age'];
            $user->gender = $data['gender'];

            $user->save();

            return response([
                'result' => 'typeEdit==2 sucess'
            ], 200);
        }

        

        // $user = User::find($id);
        // $user->name = $request->input('name');
        // $user->email = $request->input('email');
        // $oldRole  = Role::where('name', $request->input['oldRole'])->first();
        // $newRole  = Role::where('name', $data['role'])->first();

        // return response($oldRole->name);
        // return response($newRole->name);
        // $user->save();

        // //$user->roles()->detach($oldRole);
        // $user->roles()->attach($newRole);
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->input('userDelete');

        $user = User::find($id);

        $role  = Role::where('name', $data['role'])->first();
        $user->roles()->detach($role['id']);

        $user->delete();
        return response([
            'result' => 'success'
        ], 200);
    }
}
