<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
#use phpseclib3\Crypt\Hash;
use Illuminate\Support\Facades\Hash;

class Auth extends Controller
{
    public function register(Request $request)
    {
        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
            return response()->json(['message' => 'Email already exists. Status updated.', 'user' => $existingUser], 409);

        }

        // If the email does not exist, proceed with validation
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
        ]);

        // If the validation passes, create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash the password
        ]);

        // Return the created user along with a success message
        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }




    public function login(Request $request){

        $request->validate([
            'email'=> 'required|email',
            'password'=>'required',
        ]);
        $user=User::where("email",$request->email)->first();
        if (!empty($user)){
            if (Hash::check($request->password,$user->password)){

                $token = $user->createToken("mytoken")->accessToken;
                return response()->json(
                    [
                        "token"=> $token,
                    ],200
                );
            }else{
                return response()->json(
                    [
                        "status"=>false,
                        "message"=>"this user is invalid Pass",
                    ],404
                );
            }
        }else{
            return response()->json(
                [
                    "status"=>false,
                    "message"=>"this user is invaalid",
                ],404
            );
        }
    }

    public function profile(){
        $userdate=auth()->user();
        return response()->json([
            "message"=>"user is ",
            "data"=>$userdate,
        ],200);

    }

    public function logout()
    {
        $token = auth()->user()->token();

        $token->revoke();

        return response()->json([
            "status" => true,

            "message" => "User Logged out successfully"
        ]);
    }
    public function user()
    {
        return 'Hello Fahde Im working well';
    }
}
