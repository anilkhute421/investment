<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Apis\ApisResponseController;
use Illuminate\Http\Request;
use App\Http\Requests\ApiRequests\AuthRequest;
use App\Models\User;
use Hash;

class AuthController extends ApisResponseController
{
    public function login(Request $request){
        $validator = validator($request->all(), AuthRequest::login_rules());
        if($validator->fails()){
            return $this->sendSingleFieldError($validator->errors()->first(), 201 ,200);
        }

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return $this->sendSingleFieldError('Invalid credentials entered.',201,200);
        }else{

            $result = $user;

            $result['token'] = $user->createToken('auth' , ['auth_user'])->plainTextToken;

            return $this->sendResponse($result,'Login Successful.',201,200);
        }

    }
}
