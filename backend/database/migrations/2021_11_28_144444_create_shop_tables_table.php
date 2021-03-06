<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_tables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_hash')->nullable();
            $table->text('table_name');
            $table->integer('shop_id');
            $table->integer('status')->default(9);
            $table->integer('max_people');
            $table->integer('people')->default(0);
            $table->boolean('is_display')->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_tables');
    }
}
