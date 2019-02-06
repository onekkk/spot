<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id');
            $table->string('name', 240);
            $table->text('body', 3000);
            $table->double('lat', 9, 6);
            $table->double('lng', 9, 6);
            $table->string('img_path', 3000)->nullable();
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
        Schema::dropIfExists('items_details');
    }
}
