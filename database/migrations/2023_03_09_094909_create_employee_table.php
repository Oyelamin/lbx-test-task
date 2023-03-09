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
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->integer('uid')->unique()->index();
            $table->string('username')->nullable()->default(null)->index();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_initial')->nullable()->default(null);
            $table->string('name_prefix')->nullable()->default(null);
            $table->string('email')->index();
            $table->string('gender')->index();
            $table->date('date_of_birth')->index();
            $table->string('time_of_birth')->nullable()->default(null);
            $table->decimal('age_in_yrs', 8, 2)->default(0.00);
            $table->date('date_of_joining')->nullable()->default(null);
            $table->decimal('age_in_company', 8, 2)->default(0.00)->comment('(Years)');
            $table->string('phone')->nullable()->default(null);
            $table->string('place_name')->nullable()->default(null)->index();
            $table->string('country')->nullable()->default(null)->index();
            $table->string('city')->nullable()->default(null);
            $table->integer('zip')->nullable()->default(null)->index();
            $table->string('region')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};
