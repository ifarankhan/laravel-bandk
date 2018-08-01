<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class PassportController extends Controller
{
    public $sucessStatus = 200;

    /*
     * login api
     *
     * @return \Illuminate\Http\Response
     */

    public function login() {

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(
                [
                    'status' => $this->sucessStatus,
                    'token' => $success['token'],
                    'roles' => ($user->roles) ? $user->roles : [],
                    'modules' => ($user->modules) ? $user->modules: [],
                ],
                $this->sucessStatus
            );
        }
        else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    /*
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()],401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;

        return response()->json(
            [
                'status' => $this->sucessStatus,
                'token' => $success['token']
            ],
            $this->sucessStatus
        );
    }

    /*
     * details api
     *
     * @return \Illumiante\Http\Response
     */
    public function getClaimFormData() {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->sucessStatus);
    }

}