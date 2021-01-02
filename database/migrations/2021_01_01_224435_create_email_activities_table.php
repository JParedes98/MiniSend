<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_user_id');
            $table->string('subject', 250)->nullable();
            $table->longText('text')->nullable();
            $table->longText('html')->nullable();
            $table->timestamps();
        });

        Schema::create('email_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_owner_id');
            $table->unsignedBigInteger('email_id');
            $table->string('name', 100);
            $table->string('extension', 20);
            $table->binary('object');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE email_attachments MODIFY COLUMN object longblob");

        Schema::create('email_recipients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('related_user_id');
            $table->string('email', 255)->unique();
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
        Schema::dropIfExists('email_activities');
        Schema::dropIfExists('email_attachments');
        Schema::dropIfExists('email_recipientss');
    }
}
