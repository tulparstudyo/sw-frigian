<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class FixOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->fix_options_tables();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        echo " Swordbros options table is existing. \r\n";
    }
    
    private static function fix_options_tables(){
        if (!Schema::hasTable('tblCategory')){
            Schema::create('sw_options', function (Blueprint $table) {
                $table->char('option_group', 32);
                $table->char('option_key',32);
                $table->longText('value');
                $table->boolean('is_json');
            });
			echo "sw_options table created \r\n";
        } else{
			echo "sw_options table already exists \r\n";
        }
    }

}