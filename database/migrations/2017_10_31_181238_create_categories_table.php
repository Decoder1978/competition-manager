<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCategoriesTable
 */
class CreateCategoriesTable extends \App\Helpers\Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->string('short', 15);
            $table->unsignedInteger('order');

            $table->unsignedInteger('competition_id');
            $table->foreign('competition_id')
                ->references('id')
                ->on('competitions')
                ->onDelete('cascade');

            $table->unsignedInteger('area_id')
                ->nullable();
            $table->foreign('area_id')
                ->references('id')
                ->on('areas')
                ->onDelete('cascade');

            $table->string('discipline_title');
            $table->string('discipline_short');
            $table->unsignedInteger('discipline_id');
            $table->foreign('discipline_id')
                ->references('id')
                ->on('disciplines')
                ->onDelete('cascade');

            $table->string('category_group_title');
            $table->string('category_group_short');
            $table->unsignedInteger('category_group_id');
            $table->foreign('category_group_id')
                ->references('id')
                ->on('category_groups')
                ->onDelete('cascade');

            $this->audit($table);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
