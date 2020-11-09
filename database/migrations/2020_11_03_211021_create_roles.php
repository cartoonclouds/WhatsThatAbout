<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Spatie\Permission\Models\Role::create([
            'name' => 'super-admin',
            'pretty_name' => 'Super Administrator'
        ]);

        \Spatie\Permission\Models\Role::create([
            'name' => 'admin',
            'pretty_name' => 'Administrator'
        ]);

        \Spatie\Permission\Models\Role::create([
            'name' => 'moderator',
            'pretty_name' => 'Moderator'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Spatie\Permission\Models\Role::whereIn('name', ['super-admin', 'admin', 'moderator'])->delete();

        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
