<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('good_points', function (Blueprint $table) {
            $table->bigIncrements('id');
	    			$table->unsignedBigInteger('google_user_id');
	    			$table->unsignedBigInteger('user_review_id');
	    			$table->foreign('google_user_id')->references('id')->on('google_users');
	    			$table->foreign('user_review_id')->references('id')->on('user_reviews');
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
        Schema::dropIfExists('good_points');
    }
}
