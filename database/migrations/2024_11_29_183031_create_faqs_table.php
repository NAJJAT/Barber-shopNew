<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('faqs', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('faq_category_id');
        $table->unsignedBigInteger('user_id'); // Add user_id to link FAQs to users
        $table->string('question');
        $table->text('answer');
        $table->timestamps();
        $table->foreign('faq_category_id')->references('id')->on('faq_categories')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Foreign key constraint
    });
}

    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faqs');
    }
};
