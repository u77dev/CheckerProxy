<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProxiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proxies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->ipAddress('ip');
            $table->integer('port');
            $table->enum('status', ['new', 'in_work', 'bad', 'good'])->default('new');
            $table->enum('type', ['http', 'socks4', 'socks5'])->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->ipAddress('real_ip')->nullable();
            $table->integer('ping')->nullable();
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
        Schema::dropIfExists('proxies');
    }
}
