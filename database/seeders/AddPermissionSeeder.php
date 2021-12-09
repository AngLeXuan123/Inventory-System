<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
  
class AddPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Brand-list',
            'Brand-create',
            'Brand-edit',
            'Brand-delete',
            'Order-list',
            'Order-create',
            'Order-edit',
            'Order-delete',
            'Category-list',
            'Category-create',
            'Category-edit',
            'Category-delete'
        ];
     
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}