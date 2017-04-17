<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('ofo', function (Blueprint $table) {    //建立数据表user
       $table->increments('id');               //主键自增
       $table->string('password');             //'password'
       $table->string('bikeId');             //'password'
       $table->timestamps();                   //自动生成时间戳记录创建更新时间
   });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
