<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $user = DB::table('users')
        //             ->select('users.id','users.fullname','users.email','users.role_id','roles.name')
        //             ->join('roles', 'users.role_id', '=', 'roles.id')
        //             ->get();
        // return $user;
        return Users::with('role')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'fullname' => 'required|string',
            'email' => 'required|string|email:rfc,dns|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
            'role_id' => 'required|integer'
        ]);

        $user = Users::create([
            'fullname' => $fields['fullname'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'role_id' => $fields['role_id']
        ]);

        $response = [
            'user' => $user->load('role')
        ];

        return response($response, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $user = DB::table('users')
        //             ->select('users.*', 'roles.name')
        //             ->where('users.id','=',$id)
        //             ->join('roles', 'users.role_id', '=', 'roles.id')
        //             ->first();
        return Users::with('role')->where('users.id','=',$id)
                        ->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Users::find($id);

        $fields = $request->validate([
            'fullname' => 'required|string',
            'email' => 'required|string|email:rfc,dns|unique:users,email,'.$user->id,
            'role_id' => 'required|integer'
        ]);
        $user->update($request->all());
        $user->load('role');
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Users::destroy($id);
    }

    public function current(){
        return auth()->user()->load('role');
        
    }
}
