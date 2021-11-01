<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Validator;

class UserController extends Controller
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */

    public function register(Request $request){
        $validates = Validator::make($request -> all(),[

            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',

        ]);

        if($validates -> fails()){
            return response()->json($validates->errors(), 202);
        }

        $inputData = $request -> all();
        $inputData['password'] = bcrypt($inputData['password']);
        $user = User::create($inputData);

        $success = [];
        $success['token'] = $user->createToken('MyAPI-application') -> accessToken;
        $success['name'] = $user -> name;

        return response()->json($success, 200);

    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request){
        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])){
            $user = Auth::user();

            $success =[];
            $success['token'] = $user->createToken('MyAPI-application') -> accessToken;
            $success['name'] = $user -> name;

            return response()->json($success, 200);
        } else{
            return response()->json(['error'=>'Unauthorized Access'],401);
        }
    }

    public function show($id){
        $user = Auth::user() -> find($id);

        if(is_null($user)){
            return response() -> json([
                'success' => false,
                'message' => 'User not found!'
            ], 400);
        }

        return response() -> json([
            'success' => true,
            'data' => $user -> toArray()
        ], 400);
    }

    public function update(Request $request, $id){
        $user = Auth::user() -> find($id);

        if(is_null($user)){
            return response() -> json([
                'success' => false,
                'message' => 'User not found!'
            ], 400);
        }
        
        $newInput = $request -> all();
        $updatedUser = $user -> fill($newInput) -> save();

        if($updatedUser){
            return response() -> json([
                'success' => true,
                'message' => 'User has successfully updated!'
            ], 400);
        } else{
            return response() -> json([
                'success' => false,
                'message' => 'User can not be updated!'
            ], 400);
        }
    }
}
