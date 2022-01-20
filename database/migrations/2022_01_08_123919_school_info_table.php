<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SchoolInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_info', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('type',20);
            $table->string('audit_no',20);
            $table->string('gs_divition',50);
            $table->string('ds_divition',50);
            $table->string('distric',50);
            $table->string('pc',50);
            $table->string('status',1);
            $table->string('contact',20);
            $table->string('email',50)->nullable();
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
        Schema::dropIfExists('school_info');
    }
}
