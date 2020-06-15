<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
	    			$table->unsignedBigInteger('contribute_id');
	    			$table->unsignedBigInteger('google_user_id');
	    			$table->foreign('contribute_id')->references('id')->on('contributes');
	    			$table->foreign('google_user_id')->references('id')->on('google_users');
						$table->string('title');
						$table->text('review');
						$table->unsignedInteger('satisfaction');
						$table->unsignedInteger('recommended');
						$table->unsignedInteger('good_point')->default(0);
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
        Schema::dropIfExists('user_reviews');
    }
}
