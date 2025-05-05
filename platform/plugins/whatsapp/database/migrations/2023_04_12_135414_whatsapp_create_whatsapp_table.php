<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('whatsapp_broadcast', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->longText('recipients');
            $table->timestamps();
        });
        Schema::create('whatsapp_chat', function (Blueprint $table) {
            $table->string('msg_id')->primary();
            $table->string('chat_id');
            $table->string('event_type', 255);
            $table->string('referenceId');
            $table->string('from', 255);
            $table->string('to', 255);
            $table->string('author', 255);
            $table->string('pushname', 255);
            $table->string('ack', 255);
            $table->string('type', 255);
            $table->longText('body');
            $table->string('media', 500);
            $table->string('fromMe', 255);
            $table->string('self', 255);
            $table->string('isForwarded', 255);
            $table->string('time', 255);
            $table->string('lo_address', 255);
            $table->string('lo_latitude', 255);
            $table->string('lo_longitude', 255);
            $table->timestamps();
        });
        Schema::create('whatsapp_contacts', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->longText('display')->nullable();
            $table->string('name', 255);
            $table->string('channel', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('tags', 255)->nullable();
            $table->string('country', 255)->nullable();
            $table->string('language', 255)->nullable();
            $table->string('conversation_Status', 500);
            $table->string('assignee', 255)->nullable();
            $table->string('last_message', 255);
            $table->string('date_added', 255);
            $table->timestamps();
        });
        Schema::create('whatsapp_conversations_type', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('type', 255);
            $table->longText('img');
            $table->string('title', 255);
            $table->timestamps();
        });
        Schema::create('whatsapp_quick-replies', function (Blueprint $table) {
            $table->id();
            $table->longText('message');
            $table->timestamps();
        });
        Schema::create('whatsapp_reportelements', function (Blueprint $table) {
            $table->string('report_id', 255);
            $table->string('element', 255);
        });
        Schema::create('whatsapp_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('broadcast_id');
            $table->string('name', 255);
            $table->longText('message');
            $table->integer('template_id');
            $table->string('count', 255);
            $table->string('date', 255);
            $table->timestamps();
        });
        Schema::create('whatsapp_setting', function (Blueprint $table) {
            $table->id();
            $table->string('ultramsg_whatsapp_token', 50);
            $table->string('ultramsg_whatsapp_instance_id', 50);
            $table->string('pusher_key', 45);
            $table->string('pusher_secret', 45);
            $table->string('pusher_app_id', 45);
            $table->string('pusher_cluster', 45);
        });
        Schema::create('whatsapp_templates', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->longText('file');
            $table->string('fileType', 255);
            $table->longText('message');
            $table->timestamps();
        });
       
        Schema::create('whatsapp_translations', function (Blueprint $table) {
            $table->string('lang_code');
            $table->integer('whatsapp_id');
            $table->string('name', 255)->nullable();

            $table->primary(['lang_code', 'whatsapp_id'], 'whatsapp_translations_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('whatsapp_broadcast');
        Schema::dropIfExists('whatsapp_chat');
        Schema::dropIfExists('whatsapp_contacts');
        Schema::dropIfExists('whatsapp_conversations_type');
        Schema::dropIfExists('whatsapp_quick-replies');
        Schema::dropIfExists('whatsapp_reportelements');
        Schema::dropIfExists('whatsapp_reports');
        Schema::dropIfExists('whatsapp_setting');
        Schema::dropIfExists('whatsapp_templates');
        Schema::dropIfExists('whatsapp_whatsapp_translations');
    }
};
