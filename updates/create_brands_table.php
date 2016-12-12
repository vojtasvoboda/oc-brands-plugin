<?php namespace VojtaSvoboda\Brands\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateBrandsTable extends Migration
{
    public function up()
    {
        Schema::create('vojtasvoboda_brands_brands', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();

            $table->string('name', 300);
            $table->string('slug', 300)->nullable();
            $table->text('description', 300)->nullable();
            $table->string('external_link', 300)->nullable();
            $table->boolean('no_link')->default(false);

            $table->boolean('enabled')->default(true);
            $table->smallInteger('sort_order')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vojtasvoboda_brands_brands');
    }
}
