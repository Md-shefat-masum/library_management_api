<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ForgetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'exists:users'],
            'password' => ['required'],
        ]);

        if ($validator->fails()) {

            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);

        } else {
            $req_data = request()->only('email', 'password');
            if (Auth::attempt($req_data)) {
                $user = User::where('id', Auth::user()->id)->with('user_role')->first();
                $data['access_token'] = $user->createToken('accessToken')->accessToken;
                $data['user'] = $user;
                return response()->json($data, 200);
            } else {
                $data['message'] = 'user not exists!!';
                $data['data']['email'] = ['email or password incorrect'];
                $data['data']['password'] = ['email or password incorrect'];

                return response()->json($data, 401);
            }
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'min:4'],
            'email' => ['required', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        } else {
            $data = $request->only(['name', 'email', 'password']);
            $data['role_serial'] = 4;
            $data['password'] = Hash::make($request->password);
            $user = User::create($data);

            Auth::login($user);
            $user = User::where('id', Auth::user()->id)->with('user_role')->first();
            $data['access_token'] = $user->createToken('accessToken')->accessToken;
            $data['user'] = $user;
            return response()->json($data, 200);
        }
    }

    public function logout()
    {
        Auth::user()->token()->revoke();
        return response()->json([
            'message' => 'logout',
        ], 200);
    }

    public function update_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'min:4'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        }

        $data = $request->only(['name', 'password']);
        $data['role_serial'] = 4;
        $data['password'] = Hash::make($request->password);
        $user = User::find(Auth::user()->id)->fill($data)->save();

        $data['user'] = User::where('id', Auth::user()->id)->with('user_role')->first();
        return response()->json($data, 200);
    }

    public function update_profile_pic(Request $request)
    {
        if($request->hasFile('image')){
            $path = Storage::put('uploads', $request->file('image'));
            $user = User::find(Auth::user()->id);
            $user->image = $path;
            $user->save();
            $data['user'] = User::where('id', Auth::user()->id)->with('user_role')->first();
            return response()->json($data, 200);
        }
    }

    public function forget(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required','exists:users'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        }
        $user = User::where('email',$request->email)->first();
        $user->forget_token = Hash::make(uniqid(50));
        $user->save();

        return Mail::to('mshefat924@gmail.com')->send(new ForgetPassword($user->forget_token));
    }

    public function forget_token(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'forget_token' => ['required','exists:users'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'data' => $validator->errors(),
            ], 422);
        }

        $temp_pass = Hash::make(uniqid(10));
        $user = User::where('forget_token',$request->forget_token)->first();
        $user->forget_token = null;
        $user->password = Hash::make($temp_pass);
        $user->save();

        return Mail::to('mshefat924@gmail.com')->send(new ForgetPassword(" your password is:  ".$temp_pass));
    }

    public function user_list_for_select2()
    {
        $user = User::where('role_serial',4)->select('id','name')->orderBy('name','ASC')->get();
        return response()->json($user,200);
    }
}
