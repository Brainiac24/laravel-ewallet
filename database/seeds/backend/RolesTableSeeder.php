<?php

use Illuminate\Database\Seeder;

use App\Models\User\Role\Role;

class RolesTableSeeder extends Database\Seeds\BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Role::truncate();
        try {
            $roles = [
                ['id' => config('app_settings.role_admin_id'), 'name' => 'sadmin', 'display_name' => 'Администратор'],
            ];

            foreach ($roles as $role) {
                try {
                    Role::create($role);
                } catch (\Exception $e) {
                    $this->logger->error($e->getMessage());
                }
            }
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }
}
