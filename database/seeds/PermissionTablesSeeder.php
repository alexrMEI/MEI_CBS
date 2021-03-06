<?php

use Illuminate\Database\Seeder;

use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$admin = Role::create(['name' => 'admin']);
		$developer = Role::create(['name' => 'developer']);
		$sales = Role::create(['name' => 'salesman']);
		$client = Role::create(['name' => 'client']);

		$createUser = Permission::create(['name' => 'create user']);
		$createUser->assignRole($admin);
		
		$editUser = Permission::create(['name' => 'edit user']);
		$editUser->assignRole($admin);

		$deleteUser = Permission::create(['name' => 'delete user']);
		$deleteUser->assignRole($admin);

		$createProduct = Permission::create(['name' => 'create product']);
		$createProduct->assignRole($admin);
		$createProduct->assignRole($sales);

		$editProduct = Permission::create(['name' => 'edit product']);
		$editProduct->assignRole($admin);
		$editProduct->assignRole($sales);

		$deleteProduct = Permission::create(['name' => 'delete product']);
		$deleteProduct->assignRole($admin);

		$createFile = Permission::create(['name' => 'create file']);
		$createFile->assignRole($admin);
		$createFile->assignRole($developer);

		$editFile = Permission::create(['name' => 'edit file']);
		$editFile->assignRole($admin);
		$editFile->assignRole($developer);

		$deleteFile = Permission::create(['name' => 'delete file']);
		$deleteFile->assignRole($admin);

		$admin1 = User::where('username', '2190273')->first();
		$admin2 = User::where('username', '2190278')->first();
		$admin3 = User::where('username', '2190274')->first();
		$admin4 = User::where('username', '2190275')->first();
		$developer = User::where('username', 'dev')->first();
		$salesman = User::where('username', 'salesman')->first();

		$admin1->assignRole('admin');
		$admin2->assignRole('admin');
		$admin3->assignRole('admin');
		$admin4->assignRole('admin');
		$developer->assignRole('developer');
		$salesman->assignRole('salesman');
    }
}
