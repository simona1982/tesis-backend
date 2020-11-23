<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name', 'asc')->get();
        return response(['data' => $users], 200);
    }

    public function login(Request $request) 
    {
        //Email
        $email = $request->email;
        $password = $request->password;

        //Verifico si existe 
        if(!is_null($email) && !is_null($password)) {
         
            $user = DB::table('users')->where([
                    ['email', '=', $email],
                    ['password', '=', $password],
                ])->get();

        
            if($user->isEmpty()){
                throw new \Exception('bad credentials');
                //return response()->json(["message", "Authentication Required!"], 500);
            }

            return $user;

		}

    }

    public function registerUser(Request $request)
    {
        //Email
        $email = $request->email;

        if(!is_null($email) && !empty($email)) {

            $user = DB::table('users')->where([
                ['email', '=', $email],
            ])->get();

			if(!$user->isEmpty()) {
				throw new Exception("user with " + $email + " is already exist.");
			}
        }
        

        $newUser = DB::table('users')->insert(
            [
                'email' => $request->email, 
                'name' => $request->name, 
                'perfil' => $request->perfil, 
                'password' => $request->password
            ]
        );
        
		return $newUser;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $user = DB::table('users')->find($id);

        if(!$user) {
            throw new Exception("user does not exist.");
        }

        $affected = DB::table('users')
              ->where('id', $id)
              ->update([
                'email' => $request->email, 
                'name' => $request->name, 
                'perfil' => $request->perfil, 
            ]);
        
        return $affected;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = DB::table('users')->find($id);

        if(!$user) {
            throw new Exception("user does not exist.");
        }

        return DB::table('users')->delete($id);

        return $user;
    }
}
