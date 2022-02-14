<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnNullableInLedger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ledgers', function (Blueprint $table) {
            if (Schema::hasColumn('ledgers', 'commodity_category')) {
                $table->string('commodity_category')->change()->nullable();
            }
            if (Schema::hasColumn('ledgers', 'exchange_rate')) {
                $table->unsignedFloat('exchange_rate')->change()->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ledger', function (Blueprint $table) {
            $table->integer('commodity_category')->change()->nullable(false);
            $table->integer('exchange_rate')->change()->nullable(false);
        });
    }
}
