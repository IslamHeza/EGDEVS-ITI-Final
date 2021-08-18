<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string("project_name");
            $table->string("description");
            $table->integer("rate")->default(0);
            $table->integer("budget");
            // $table->integer("final_price");
            $table->string("location");
            $table->string('status')->nullable()->default("pending");
            // $table->enum('status', ['done', 'proccessing','pending']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
