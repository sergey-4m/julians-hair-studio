<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class PassportController extends Controller
{
	public $successStatus = 200;

	public function login()
	{
		if (Auth::attempt(['username' => request('username'), 'password' => request('password')])) {
			$user = Auth::user();

            $success['token'] =  $user->createToken('JuliansHairStudio')->accessToken;
            return response()->json([
            	'data' => $success,
            ], $this->successStatus);
		} else {
			return response()->json([
				'error' => 'Unauthorised',
			], 401);
		}
	}

	public function register(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
		]);

		if ($validator->fails()) {
			return response()->json([
				'error' => $validator->errors(),
			], 401);
		}

		$input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('JuliansHairStudio')->accessToken;
        $success['username'] =  $user->username;

        return response()->json([
        	'success'=>$success,
        ], $this->successStatus);
	}

	public function getDetails()
	{
		$user = Auth::user();
		return response()->json([
			'data' => $user,
		], $this->successStatus);
	}
}