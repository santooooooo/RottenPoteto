<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContribute extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contributes', function (Blueprint $table) {
            $table->bigIncrements('id');
	    			$table->string('title');
	    			$table->text('contents');
	    			$table->string('picture');
						$table->string('genre');
						$table->float('satisfaction', 5, 2)->default(0);
						$table->float('recommended', 5, 2)->default(0);
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
        Schema::dropIfExists('contributes');
    }
}
