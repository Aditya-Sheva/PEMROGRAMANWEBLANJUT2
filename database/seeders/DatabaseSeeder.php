<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Setup role & permission (Spatie)
        $roles = ['admin', 'sekretariat', 'reviewer', 'peneliti', 'ketua'];
        foreach ($roles as $roleName) {
            Role::findOrCreate($roleName, 'web');
        }

        $editProductsPermission = Permission::findOrCreate('edit products', 'web');
        $adminRole = Role::findByName('admin', 'web');
        $adminRole->givePermissionTo($editProductsPermission);

        $users = [
            ['email' => 'test@example.com', 'name' => 'Test User', 'role' => 'peneliti'],
            ['email' => 'sekretariat@etik.com', 'name' => 'Sekretariat', 'role' => 'sekretariat'],
            ['email' => 'reviewer1@etik.com', 'name' => 'Reviewer 1', 'role' => 'reviewer'],
            ['email' => 'peneliti@etik.com', 'name' => 'Peneliti', 'role' => 'peneliti'],
            ['email' => 'admin@etik.com', 'name' => 'Admin', 'role' => 'admin'],
            ['email' => 'ketua@etik.com', 'name' => 'Ketua Komite', 'role' => 'ketua'],
        ];

        foreach ($users as $row) {
            $user = User::updateOrCreate(
                ['email' => $row['email']],
                [
                    'name' => $row['name'],
                    'password' => Hash::make('password123'),
                    'role' => $row['role'],
                    'is_active' => true,
                ]
            );

            // Sync role lama (kolom users.role) dengan role dari Spatie
            $user->syncRoles([$row['role']]);
        }
    }
}
