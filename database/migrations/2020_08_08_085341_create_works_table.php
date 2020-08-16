<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->text('require');
            $table->text('benefit');
            $table->string('position');
            $table->string('contact_name');
            $table->string('contact_phone');
            $table->string('contact_email');
            $table->enum('type', ['FullTime', 'PartTime']);
            $table->double('salary_min')->nullable();
            $table->double('salary_max')->nullable();
            $table->boolean('status');
            $table->date('last_date');
            $table->integer('hot')->default(0);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('works');
        Schema::enableForeignKeyConstraints();
    }
}
