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
        DB::unprepared('
        CREATE TRIGGER update_stok_retur after INSERT ON detail_retur
        FOR EACH ROW BEGIN
        UPDATE barang
        SET stok = stok - NEW.qty_retur
        WHERE
        kd_brg = NEW.kd_brg;
        END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER update_stok_retur');
    }
};
