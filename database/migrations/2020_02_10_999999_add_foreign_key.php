<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class AddForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // relazione tra apartments e users
        Schema::table('apartments', function (Blueprint $table) {
            $table -> bigInteger('user_id') -> unsigned() -> index();
            $table -> foreign('user_id', 'apartments_users')
                   -> references('id')
                   -> on('users');
         });


         // relazione tra messages e apartments
         Schema::table('messages', function (Blueprint $table) {
            $table -> bigInteger('apartment_id') -> unsigned() -> index();
            $table -> foreign('apartment_id', 'messages_apartments')
                   -> references('id')
                   -> on('apartments');
         });

         // relazione tra views e apartments
         Schema::table('views', function (Blueprint $table) {
            $table -> bigInteger('apartment_id') -> unsigned() -> index();
            $table -> foreign('apartment_id', 'views_apartments')
                   -> references('id')
                   -> on('apartments');
         });

         // relazione tra apartments e service
         Schema::table('apartment_service', function (Blueprint $table) {
            $table -> bigInteger('apartment_id') -> unsigned() -> index();
            $table -> foreign('apartment_id' , 'apartment') -> references('id') -> on('apartments');
            
            $table -> bigInteger('service_id') -> unsigned() -> index();
            $table -> foreign('service_id' , 'service') -> references('id') -> on('services'); 
        });

        // relazione tra apartments e sponsorships
         Schema::table('apartment_sponsorship', function (Blueprint $table) {
            $table -> bigInteger('apartment_id') -> unsigned() -> index();
            $table -> foreign('apartment_id' , 'apart') -> references('id') -> on('apartments');
            
            $table -> bigInteger('sponsorship_id') -> unsigned() -> index();
            $table -> foreign('sponsorship_id' , 'sponsorship') -> references('id') -> on('sponsorships'); 
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apartments', function (Blueprint $table) {
              $table -> dropForeign('apartments_users');
              $table -> dropColumn('user_id');
        });

        Schema::table('messages', function (Blueprint $table) {
              $table -> dropForeign('messages_apartments');
              $table -> dropColumn('apartment_id');
        });

        Schema::table('views', function (Blueprint $table) {
              $table -> dropForeign('views_apartments');
              $table -> dropColumn('apartment_id');
        });

        Schema::table('apartment_service', function (Blueprint $table) {
            $table -> dropForeign('apartment');
            $table -> dropForeign('service');

            $table -> dropColumn('apartment_id');
            $table -> dropColumn('service_id');
        });

        Schema::table('apartment_sponsorship', function (Blueprint $table) {
            $table -> dropForeign('apart');
            $table -> dropForeign('sponsorship');

            $table -> dropColumn('apartment_id');
            $table -> dropColumn('sponsorship_id');
        });
    }
}
