<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Response;
// use Lcobucci\JWT\Validation\Validator;
use Illuminate\Support\Facades\Validator;


class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        // $success['user'] =  $user->toArray();
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['user'] =  $user->toArray();

        return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['id'] =  $user->id;
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            

            return $this->sendResponse($success, 'User login successfully.');
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

    public function logout(Request $request)
    {
        // Validate the token before attempting to log out
        $request->user()->token()->revoke();
         return $this->sendResponse([],'Successfully logged out');
        
    }

    public function forgotPassword(Request $request)
    {
        $credentials = request()->validate(['email' => 'required|email']);

        Password::sendResetLink($credentials);

        return response()->json(["msg" => 'Reset password link sent on your email id.']);
    }


    public function userId(Request $request)
    {
        $input = $request->only('phone');

        $validator = Validator::make($input, [
            'phone' => 'required|exists:users,phone',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('phone' , $request->input('phone'))->first();

        return Response::json(['message' => 'User id' , 'id'=> $user->id]);
    }


    public function resetPassword(Request $request){

        $input = $request->only('id' , 'password' , 'password_confirmation');

        $validator = Validator::make($input , [
            'id' => 'required|exists:users,id',
            'password' => 'required|min:8|string|confirmed',
        ]);

        if($validator->fails()){

            return $this->sendError('Validation error' ,$validator->errors());
        }

        $user = User::find($request->input('id'));

        $user->password = bcrypt($input['password']);

        $user->save();
        return $this->sendResponse([] , 'Password reset successfully');
    }

    
    public function userProfile($user_id)
    {
        // Validate the token before attempting to log out
        $user = User::where('id',$user_id)->first();
        
        return $this->sendResponse($user, 'User Profil');
        
        
    }
}
