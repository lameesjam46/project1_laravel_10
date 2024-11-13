<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   public function register(Request $request): JsonResponse
   {
       $request->validate([
           'name'=>['required'],
           'mobile'=>['required','unique:users,mobile'],
           'password'=>['required']
       ]);

       $user=User::query()->create([
           'name'=>$request['name'],
           'mobile'=>$request['mobile'],
           'password'=>$request['password']
       ]);
       $token=$user->createToken("Api Token")->plainTextToken;
       $data=[];
       $data['user']=$user;
       $data['token']=$token;
       return response()->json([
           'status'=>1,
           'data'=>$data,
           'msg'=>"user created successfully"
       ]);
   }

   public function login(Request $request){
       $request->validate([
           'mobile'=>['required','digits:10','exists:users,mobile'],
           'password'=>['required']
       ]);
       if(!Auth::attempt($request->only(['mobile','password']))){
           $mesg='mobile & password dose not match our record';
           return response()->json([
               'data'=>[],
               'status'=>0,
               'msg'=>$mesg
           ]);
       }
       $user=User::query()->where('mobile','=',$request['mobile'])->first();

       $token=$user->createToken("Api Token")->plainTextToken;
       $data=[];
       $data['user']=$user;
       $data['token']=$token;
       return response()->json([
           'status'=>1,
           'data'=>$data,
           'msg'=>"user created successfully"
       ]);
   }

   public function logout(){
       Auth::user()->currentAccessToken()->delete();
       return \response()->json([
           'status'=>1,
           'data'=>[],
           'msg'=>'logged out successfully'
       ]);
   }
}
