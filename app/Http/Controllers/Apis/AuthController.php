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
            // return $this->sendSingleFieldError(__(app()->getLocale().'.invalid_credentials'),201,200);
        }else{

            $result = $user;

            $result['token'] = $user->createToken('auth' , ['auth_user'])->plainTextToken;

            // return $this->sendResponse($result,__(app()->getLocale().'.login_success'),200,200);
            return $this->sendResponse($result,'Login Successful.',201,200);
        }



        // if ( $user->status == 0) {
        //     // return $this->sendSingleFieldError('account deactivated, contact admin at contolio@contolio.com', 201,200);
        //     return $this->sendSingleFieldError(__(app()->getLocale().'.account_deactivated'), 201,200);

        // }
        // $user->tokens()->delete();
        // $result = $user;
        // $otp = mt_rand(1000,9999);
        // PropertyManager::where('email', $request->email )->update(['email_otp' => $otp ]);
        // Mail::to($request->email)->send(new \App\Mail\SendOtp($otp));
        // $result['country_name'] = CountryCurrencyModel::where('id' , $user->country_id )->first()->value('country');
        // $result['role_name'] = (RolesModel::where('id' , $user->role_id )->exists())?
        // RolesModel::where('id' , $user->role_id )->first()->value('role_title'):'';
        // $result['token'] = $user->createToken('pm' , ['property_manager'])->plainTextToken;
        // $result['company_name'] = PropertyManagerCompany::where('id' , $user->pm_company_id )->first()->value('name');
        // return $this->sendResponse([],__(app()->getLocale().'.otp_sent_to_email'),200,200);

    }
}
