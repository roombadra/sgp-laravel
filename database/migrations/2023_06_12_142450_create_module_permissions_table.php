<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('module_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("profile_id")->constrained("profiles")->onUpdate("cascade")->onDelete("cascade");
            $table->foreignId("module_name");
            $table->boolean("active")->nullable();
            $table->boolean("can_create");
            $table->boolean("can_read");
            $table->boolean("can_update");
            $table->boolean("can_delete");
            $table->boolean("can_fetch");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_permissions');
    }
};