<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('containers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('container_name');
            $table->enum('type', ['nginx','mysql','phpmyadmin','php']);
            $table->string('mysql_database')->nullable();
            $table->string('mysql_user')->nullable();
            $table->string('mysql_password')->nullable();
            $table->string('mysql_root_password')->nullable();
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
        Schema::dropIfExists('containers');
    }
};
