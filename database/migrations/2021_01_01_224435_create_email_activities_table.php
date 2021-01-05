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
    public function up() {
        Schema::create('email_activities', function (Blueprint $table) {
            $table->id();
            $table->string('subject', 250)->nullable();
            $table->longText('text')->nullable();
            $table->longText('html')->nullable();
            $table->string('status', 25)->default('POSTED');
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('recipient_id');
            $table->timestamps();
        });

        Schema::create('email_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('email_id');
            $table->string('name', 100);
            $table->string('extension', 20);
            $table->binary('object');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE email_attachments MODIFY COLUMN object longblob");

        Schema::create('recipients', function (Blueprint $table) {
            $table->id();
            $table->string('email', 255)->unique();
            $table->timestamps();
        });

        Schema::create('user_contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('recipient_id');
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
        Schema::dropIfExists('recipientss');
        Schema::dropIfExists('user_contacts');
    }
}
