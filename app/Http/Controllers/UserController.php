<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role->role == 'Admin')
        {
            $allUsers = User::all();
            $allUsersDetails = UserResource::collection($allUsers);

            // $test = User::where("role_id", "=", 2);
            // dd($test);

            $users = User::where("role_id", "=", 2)->get();
            $usersDetails = UserResource::collection($users);
            
            $data = [
                "allUsers" => $allUsersDetails,
                "users" => $usersDetails
            ];
            // return UserResource::collection($users);
            
            return $data;

        } abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::create($request->all());

        // $user->assignRole($user['role']);

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()){
            $user = User::findOrFail($id);
    
            return $user;
        }
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
        $user = User::findOrFail($id);

        $user->update($request->all());

        return tap($user)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->role->role == 'Admin')
        {
            User::findOrFail($id)->delete();

            return response(null, 204);
        } abort(403);
    }
}
