<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('branch_user', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\User::class)->constrained()->restrictOnDelete();
            $table->foreignIdFor(\App\Models\Branch::class)->constrained()->restrictOnDelete();

            $table->string('role')->default(\App\Enums\BranchUserRole::MEMBER->value);

            $table->primary(['user_id', 'branch_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_user');
    }
};
