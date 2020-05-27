<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GoogleUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('google_users', function (Blueprint $table) {
            $table->bigIncrements('id');
	    			$table->string('gmail')->unique();
	    			$table->string('name');
	    			$table->text('profile')->nullable();
	    			$table->string('icon')->nullable();
						$table->string('best')->nullable();
						$table->boolean('safety')->default(true);
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
        Schema::dropIfExists('google_users');
    }
}
