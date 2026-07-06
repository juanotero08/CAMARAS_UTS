<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('camaras', function (Blueprint $table) {
            $table->string('canal')->nullable()->after('nvr');
        });
    }

    public function down()
    {
        Schema::table('camaras', function (Blueprint $table) {
            $table->dropColumn('canal');
        });
    }
};
