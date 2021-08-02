<?php

namespace App\Http\Controllers\Api\User;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    //
    public function register(RegisterRequest $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if($user){
            $user->ownedTeams()->save(Team::forceCreate([
                'user_id' => $user->id,
                'name' => explode(' ', $user->name, 2)[0]."'s Team",
                'personal_team' => true,
            ]));
        }
        return response()->json(['status' => 'success'],201);

    }
    
    public function login(LoginRequest $request){
        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return response()->json([
                'status'=>'failed',
                'message'=>'Unauthorized'
            ],401);
        }
        else{
            $token = $request->user()->createToken($request->device)->plainTextToken;
            return response()->json([
                'user'=>$request->user(),
                'token'=>$token,
                'status'=>'success',
                'message'=>'Auth success'
            ]);
        }
    }
}
