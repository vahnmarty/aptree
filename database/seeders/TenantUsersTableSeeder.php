<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TenantUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenants = Tenant::get();

        foreach($tenants as $tenant)
        {
            $tenant->run(function(){

                $this->createRoles();
            });
        }
    }

    public function createRoles()
    {
        $role = Role::firstOrCreate(['name' => 'admin']);
        $role = Role::firstOrCreate(['name' => 'instructor']);
        $role = Role::firstOrCreate(['name' => 'student']);
    }
}
