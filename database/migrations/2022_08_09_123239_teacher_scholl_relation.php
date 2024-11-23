<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TeacherSchollRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        Schema::create('teacher_scholl_relations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_scholl')->nullable();
            $table->uuid('id_teacher')->nullable();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE teacher_scholl_relations ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_scholl_relations');
    }
}