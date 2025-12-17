<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->string('repo');
            $table->string('github_id')->unique();
            $table->string('title');
            $table->longText('body')->nullable();
            $table->string('html_url');
            $table->timestamp('created_at_github');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('issues');
    }
};