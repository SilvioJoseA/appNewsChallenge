<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNytimesArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nytimes_articles', function (Blueprint $table) {
            $table->id();
            $table->text('abstract');
            $table->string('web_url');
            $table->text('snippet');
            $table->text('lead_paragraph');
            $table->string('source');
            $table->string('url_imagen')->nullable();
            $table->string('keywords');
            $table->timestamp('pub_date');
            $table->string('document_type');
            $table->string('news_desk');
            $table->string('section_name');
            $table->string('subsection_name')->nullable();
            $table->string('byline_original');
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
        Schema::dropIfExists('nytimes_articles');
    }
}
