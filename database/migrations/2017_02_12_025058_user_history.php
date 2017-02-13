<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       DB::unprepared('CREATE TABLE users_history select * from users where 1=2');
        DB::unprepared('CREATE TRIGGER `insert_into_users_histoy_on_insert` AFTER INSERT ON `users`
        FOR EACH ROW insert into users_history select * from users where id = new.id');
        DB::unprepared('CREATE TRIGGER `insert_into_users_histoy_on_update` AFTER UPDATE ON `users`
        FOR EACH ROW insert into users_history select * from users where id = old.id');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
