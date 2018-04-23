<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class StylistsController extends Controller
{
	public function list()
	{
		$total = \DB::table('stylists')->count();
		/*	->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('roles.name', '=', 'staff')->count();
		/*$users = \DB::table('users')
			->select(
				'users.id', 'users.first_name', 'users.last_name', 'users.email', 'users.phone', 'users.mobile'
			)
			->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
			->offset(request('offset', 0))
			->limit(request('limit', 20))
			->orderBy('users.'.request('sort', 'id'), request('order', 'asc'))
			->where('roles.name', '=', 'staff')
			->get();*/
		$stylists = \DB::table('stylists')
			->select('stylists.id', 'stylists.first_name', 'stylists.last_name', 'stylists.email', 'stylists.phone', 'stylists.mobile')
			->offset(request('offset', 0))
			->limit(request('limit', 20))
			->orderBy('stylists.'.request('sort', 'id'), request('order', 'asc'))
			->get();
		$data = [
			'rows' => $stylists,
			'total' => $total,
		];
		return response()->json([
			'data' => $data,
		]);
	}

	public function loadForSelect()
	{
		try {
			$stylists = \DB::table('stylists')
				->select(
					'stylists.id', 
					\DB::raw('CONCAT(stylists.first_name, " ", stylists.last_name) AS name')
				)
				->get();
			return response()->json([
				'stylists' => $stylists,
			]);
		} catch(Exception $e) {
			return response()->json([
				'error' => $e->getMessage(),
			]);
		}
	}
}