<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $name = config('acl.tables.roles','roles');

        Schema::create($name, function (Blueprint $table) {
            $table->uuidId();
            $table->tenant();
            $table->user();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->enum('special', ['all-access', 'no-access'])->nullable();
            $table->status();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['name','tenant_id']);
            $table->unique(['slug','tenant_id']);
        });
    }

    /**
     * Reverse the migration.
     *
     * @return void
     */
    public function down()
    {
        $name = config('shinobi.tables.roles','roles');

        Schema::drop($name);
    }
}
