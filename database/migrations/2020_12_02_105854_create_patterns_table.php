<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatternsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patterns', function (Blueprint $table) {
            $table->id();
            $table->string('theme');
            $table->text('sms_text');
            $table->text('viber_text');
            $table->string('tag');
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('user_id')
                ->on('users')
                ->references('id')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }
}
