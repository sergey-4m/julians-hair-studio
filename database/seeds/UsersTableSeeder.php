<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
	public function run()
	{
		//app()['cache']->forget('spatie.permission.cache');
		Permission::create(['name' => 'read']);
		Permission::create(['name' => 'create']);
		Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'delete']);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
        $role->save();

        $role = Role::create(['name' => 'staff']);
        $role->givePermissionTo('read');
        $role->save();

        $admin = new App\User;
        $admin->username = 'admin';
        $admin->email = 'admin@email.com';
        $admin->password = bcrypt('B!e281ckr');
        $admin->status = 'open';
        $admin->save();

        $admin = App\User::find(1);
        $admin->assignRole('admin');
        $admin->save();

        factory(App\User::class, 50)->create()->each(function($u) {
        	$uid = $u->id;
        	$u->save();
        	$u = App\User::find($uid);
        	$u->assignRole('staff');
        	$u->save();
        });
	}
}