<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuccessfulEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('successful_emails', function (Blueprint $table) {
            $table->id();
            $table->mediumInteger('affiliate_id');
            $table->text('envelope');
            $table->string('from');
            $table->string('subject');
            $table->string('dkim')->nullable();
            $table->string('SPF')->nullable();
            $table->float('spam_score')->nullable();
            $table->string('email');
            $table->string('raw_text');
            $table->string('sender_ip', 50)->nullable();
            $table->string('to');
            $table->integer('timestamp');
            $table->boolean('is_processed')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('successful_emails');
    }
}
