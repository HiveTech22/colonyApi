<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->uuid('uuid')->primary()->unique();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->double('price');
            $table->string('built');
            $table->string('bedroom')->nullable();
            $table->string('bathroom')->nullable();
            $table->enum('purpose', ['for-rent', 'for-sale'])->default('for-rent');
            $table->string('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('image')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('video')->nullable();
            $table->string('frequency')->default('yearly');
            $table->text('description');
            $table->boolean('fence')->default(0);
            $table->boolean('pool')->default(0);
            $table->boolean('tiles')->default(0);
            $table->boolean('conditioning')->default(0);
            $table->boolean('wifi')->default(0);
            $table->boolean('park')->default(0);
            $table->boolean('furnish')->default(0);
            $table->boolean('laundry')->default(0);
            $table->boolean('isAvailable')->default(0);
            $table->boolean('isVerified')->default(0);
            $table->foreignId('property_category_id')->constrained('property_categories')->onDelete('cascade');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('properties');
    }
}