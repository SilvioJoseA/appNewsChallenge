<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuardianArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guardian_articles', function (Blueprint $table) {
            $table->id();
            $table->string('article_id');
            $table->string('type');
            $table->string('section_id');
            $table->string('section_name');
            $table->timestamp('web_publication_date');
            $table->string('web_title');
            $table->string('web_url');
            $table->string('api_url');
            $table->boolean('is_hosted');
            $table->string('pillar_id');
            $table->string('pillar_name');
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
        Schema::dropIfExists('guardian_articles');
    }
}
