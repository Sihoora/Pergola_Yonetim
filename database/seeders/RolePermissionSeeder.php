<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // 

          // İzinleri oluştur
          $permissions = [
            'view projects',
            'create orders',
            'access admin area',
            'production order',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Rolleri oluştur
        $adminRole = Role::create(['name' => 'Admin']);
        $cizimciRole = Role::create(['name' => 'Çizimci']);
        $personelRole = Role::create(['name' => 'Personel']);

        // Admin tüm izinlere sahip olacak
        $adminRole->givePermissionTo(Permission::all());

        // Çizimci 'sipariş oluştur' ve 'imalat projelerini görüntüleme' izinlerine sahip olacak
        $cizimciRole->givePermissionTo(['view projects', 'create orders', 'production order']);

        // Personel sadece 'sipariş oluştur' iznine sahip olacak
        $personelRole->givePermissionTo('create orders');
    }




    
}
