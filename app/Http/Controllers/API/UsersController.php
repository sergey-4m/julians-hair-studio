<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use \Exception;

class UsersController extends Controller
{
	public function list()
	{
		$orderField = request('sort', 'id');
		$order = $orderField == 'role' ? 'roles.name' : 'users.'.$orderField;
		$total = \DB::table('users')->count();
		$query = \DB::table('users')
			->select(
				'users.id', 'users.username', 'users.email', 'roles.name AS role', 
				\DB::raw('CONCAT(users.status, " ", IFNULL(users.ip, "")) AS status')
			)
			->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
			->offset(request('offset', 0))
			->limit(request('limit', 20))
			->orderBy($order, request('order', 'asc'));
		$filter = trim(request('search'));
		if ($filter && $filter !== '') {
			$query
				->where('users.username', 'like', $filter.'%')
				->orWhere('users.email', 'like', $filter.'%');
			$total = $query->count();
		}
		$users = $query->get();
		$data = [
			'rows' => $users,
			'total' => $total,
		];
		return response()->json([
			'data' => $data,
		]);
	}

	public function create()
	{
		try {
			$username = request('username');
			$email = request('email');
			if (User::where('username', '=', $username)->count() > 0) {
		    	throw new Exception(sprintf('User with this username "%s" already registered', $username), 1);
		    }
		    if (User::where('email', '=', $email)->count() == 0) {
		    	throw new Exception(sprintf('User with this email "%s" already registered', $email), 1);
		    }
			$user = new User;
	        $user->username = $username;
	        $user->email = $email;
	        $user->password = bcrypt(request('password'));
	        $user->status = request('status', 'open');
	        if ($user->status == 'open') {
	        	$user->ip = null;
	        } else {
	        	$user->ip = request('ip');
	        }
	        $user->save();
	        $user = User::find($user->id);
	        $user->assignRole('staff');
	        $user->save();
	        return response()->json([
				'user' => $user,
			]);
	    } catch(Exception $e) {
			return response()->json([
				'error' => $e->getMessage(),
			]);
		}
	}

	public function update($id)
	{
		try {
			$username = request('username');
			$email = request('email');
			if (User::where('username', '=', $username)->count() > 0) {
		    	throw new Exception(sprintf('User with this username "%s" already registered', $username), 1);
		    }
		    if (User::where('email', '=', $email)->count() == 0) {
		    	throw new Exception(sprintf('User with this email "%s" already registered', $email), 1);
		    }
			$user = User::find($id);
			$user->username = $username;
	        $user->email = $email;
	        $user->password = bcrypt(request('password'));
	        $user->status = request('status', 'open');
	        if ($user->status == 'open') {
	        	$user->ip = null;
	        } else {
	        	$user->ip = request('ip');
	        }
	        $user->save();
	        return response()->json([
				'user' => $user,
			]);
		} catch(Exception $e) {
			return response()->json([
				'error' => $e->getMessage(),
			]);
		}
	}

	public function loadUser($id)
	{
		try {
			$user = User::find($id);
			return response()->json([
				'user' => $user,
			]);
		} catch(Exception $e) {
			return response()->json([
				'error' => $e->getMessage(),
			]);
		}
	}

	public function stylists()
	{
		$orderField = request('sort', 'id');
		$order = $orderField == 'role' ? 'roles.name' : 'users.'.$orderField;
		$total = \DB::table('stylists')->count();
		$users = \DB::table('stylists')
			->select(
				'stylists.first_name', 'stylists.last_name', 'stylists.email', 'stylists.phone', 'stylists.mobile'
			)
			->offset(request('offset', 0))
			->limit(request('limit', 20))
			->orderBy($order, request('order', 'asc'))
			->where('roles.name', '=', 'stylist')
			->get();
		$data = [
			'rows' => $users,
			'total' => $total,
		];
		return response()->json([
			'data' => $data,
		]);
	}

	public function delete($id)
	{
		try {
			$currentUser = \Auth::user();
			if ($currentUser->id != intval($id)) {
				$user = User::find($id);
				$user->delete();
			} else {
				throw new Exception('Can not delete myself...', 1);
			}
		} catch(Exception $e) {
			return response()->json([
				'error' => $e->getMessage(),
			]);
		}
		return response()->json([
			'status' => 'ok',
		]);
	}
}