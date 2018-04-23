<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
	public function list()
	{
		$orderField = request('sort', 'id');
		$order = $orderField == 'role' ? 'roles.name' : 'users.'.$orderField;
		$total = \DB::table('users')->count();
		$users = \DB::table('users')
			->select(
				'users.id', 'users.username', 'users.email', 'roles.name AS role', 
				\DB::raw('CONCAT(users.status, " ", IFNULL(users.ip, "")) AS status')
			)
			->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
			->offset(request('offset', 0))
			->limit(request('limit', 20))
			->orderBy($order, request('order', 'asc'))
			->get();
		$data = [
			'rows' => $users,
			'total' => $total,
		];
		return response()->json([
			'data' => $data,
		]);
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
}