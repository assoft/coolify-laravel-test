<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default Roles
        $adminRole = Role::query()->firstOrCreate(['name' => 'admin']);
        $moderatorRole = Role::query()->firstOrCreate(['name' => 'moderator']);
        $businessOwnerRole = Role::query()->firstOrCreate(['name' => 'business_owner']);
        $businessAdminRole = Role::query()->firstOrCreate(['name' => 'business_admin']);
        $businessManagerRole = Role::query()->firstOrCreate(['name' => 'business_manager']);

        $admin = User::factory()->create(["name" => "Administrator", "email" => "admin@admin.com"]);
        $admin->assignRole($adminRole);

        $moderator = User::factory()->create(["name" => "Moderator", "email" => "mod@mod.com"]);
        $moderator->assignRole($moderatorRole);

        User::factory()->create();

        $businessOwner = User::factory()->create(["name" => "Business Owner"]);
        $businessOwner->assignRole($businessOwnerRole);
        $businessOwner->companies()->create(Company::factory()->make()->toArray());
    }
}
