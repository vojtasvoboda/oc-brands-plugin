<?php namespace VojtaSvoboda\Brands\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class CreateBrandCategoryTable extends Migration
{
    public function up()
    {
        Schema::create('vojtasvoboda_brands_brand_category', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('brand_id')->unsigned()->nullable()->default(null);
            $table->integer('category_id')->unsigned()->nullable()->default(null);
            $table->index(['brand_id', 'category_id']);
            $table->foreign('brand_id')->references('id')->on('vojtasvoboda_brands_brands')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('vojtasvoboda_brands_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vojtasvoboda_brands_brand_category');
    }
}
