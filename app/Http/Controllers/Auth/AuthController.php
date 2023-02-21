<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request){

        try {

            $validator = Validator::make($request->all(),[
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|max:255|confirmed'
            ]);

            if ($validator->fails()){
                return response()->json($validator->errors(), Response::HTTP_UNAUTHORIZED);
            }
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->last_activity = date('Y-m-d H:i:s');
            $user->rol = $request->rol;
            $user->save();

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
               'user' => $user,
               'token' => $token,
               'token_type' => 'Bearer'
            ], Response::HTTP_OK);

        }catch (Exception $e){
            return response()->json(
              [
                  'error' => true,
                  'errorMenssage' =>$e->getMessage()
              ]
            );
        }
    }

    public function login(Request $request){


        if (!Auth::attempt($request->only('email', 'password'))){
            return response()->json(['message' => 'No autorizado'], Response::HTTP_UNAUTHORIZED);
        }

        $user = User::where('email', $request->email)->first();

        $user->update(['last_activity' => date('Y-m-d H:i:s')]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer'
        ]);
    }
}
