<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\User;
use App\Client;
use App\Service;

class ServicesController extends Controller
{
	public function records()
	{
		$total = \DB::table('services')->count();
		$query = \DB::table('services')
			->select('services.id', 'services.client_id', 'clients.first_name', 'clients.last_name', 'clients.email', 'clients.phone', 'clients.mobile')
			->join('clients', 'clients.id', '=', 'services.client_id')
			->offset(request('offset', 0))
			->limit(request('limit', 20))
			->orderBy('clients.'.request('sort', 'id'), request('order', 'asc'));
		$filter = trim(request('search'));
		if ($filter && $filter !== '') {
			$query
				->where('clients.first_name', 'like', $filter.'%')
				->orWhere('clients.last_name', 'like', $filter.'%')
				->orWhere('clients.email', 'like', $filter.'%');
			$total = $query->count();
		}
		$services = $query->get();
		$data = [
			'rows' => $services,
			'total' => $total,
		];
		return response()->json([
			'data' => $data,
		]);
	}

	public function client($id)
	{
		try {
			$client = Client::find($id);
			$total = \DB::table('services')
				->where('services.client_id', '=', $id)
				->count();
			$records = \DB::table('services')
				->select(
					'services.*', 
					\DB::raw('CONCAT(stylists.first_name, " ", stylists.last_name) stylist_name'),
					'service_items.title AS service'
				)
				->join('service_items', 'service_items.id', '=', 'services.service_id')
				->join('stylists', 'stylists.id', '=', 'services.stylist_id')
				->where('services.client_id', '=', $id)
				->get();
			$data = [
				'client' => $client,
				'records' => $records,
				'total' => $total,
			];
			return response()->json([
				'data' => $data,
			]);
		} catch(Exception $e) {
			return response()->json([
				'error' => $e->getMessage(),
			]);
		}
	}

	public function addRecord($id)
	{
		try {
			$client = Client::find($id);
			$service = new Service;
			$service->date_at = new \DateTime(request('date_at', 'now'));
			$service->brand = request('brand');
			$service->bleach = request('bleach', '');
			$service->tint = request('tint', '');
			$service->peroxide_volume = request('peroxide', '');
			$service->service_id = request('service_id');
			$service->perm = request('perm', '');
			$service->charge = request('charge');
			$service->client_id = $client->id;
			$service->stylist_id = request('stylist_id');
			$service->save();
			return response()->json([
				'record' => $service,
			]);
		} catch(Exception $e) {
			return response()->json([
				'error' => $e->getMessage(),
			]);
		}
	}

	public function load($id)
	{
		try {
			$service = Service::find($id);
			$client = Client::find($service->client_id);
			return response()->json([
				'service' => $service,
				'client' => $client,
			]);
		} catch(Exception $e) {
			return response()->json([
				'error' => $e->getMessage(),
			]);
		}
	}

	public function create()
	{
		try {
	        $user = new User;
	        $user->username = strtolower(request('first_name').'.'.request('last_name'));
	        $user->first_name = request('first_name');
	        $user->last_name = request('last_name');
	        $user->email = request('email');
	        $user->password = bcrypt(request('password'));
	        $user->phone = preg_replace('/[^0-9]+/si', '', request('phone'));
	        $user->mobile = preg_replace('/[^0-9]+/si', '', request('mobile'));
	        $user->status = 'open';
	        $user->save();
	        $user->assignRole('client');
	        $user->save();
	    } catch(Exception $e) {
	    	return response()->json([
				'error' => $e->getMessage(),
			]);
	    }
	    return response()->json([
			'user' => $user,
		]);
	}

	public function update($id)
	{
		try {
			$user = User::find($id);
			$data = request()->all();
			foreach (['first_name', 'last_name', 'email', 'phone', 'mobile',] as $field) {
				if (isset($data[$field])) {
					$user->$field = $data[$field];
				}
			}
			$user->save();
		} catch(Exception $e) {
			return response()->json([
				'error' => $e->getMessage(),
			]);
		}
		return response()->json([
			'user' => $user,
		]);
	}

	public function delete($id)
	{
		try {
			$record = Client::find($id);
			$record->delete();
		} catch(Exception $e) {
			return response()->json([
				'error' => $e->getMessage(),
			]);
		}
		return response()->json([
			'status' => 'ok',
		]);
	}

	public function servicesList()
	{
		
	}
}