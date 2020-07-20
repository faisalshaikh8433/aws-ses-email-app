<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSentEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sent_emails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('to_email_address', 50);
            $table->string('subject', 150);
            $table->text('message');
            $table->text('aws_message_id');
            $table->boolean('opened')->default(false);
            $table->boolean('delivered')->default(false);
            $table->boolean('complaint')->default(false);
            $table->boolean('bounced')->default(false);
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
        Schema::dropIfExists('sent_emails');
    }
}
