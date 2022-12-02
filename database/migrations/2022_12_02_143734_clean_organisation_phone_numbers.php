<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CleanOrganisationPhoneNumbers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organisations', function (Blueprint $table) {
            $uncleanPhoneNumbers = DB::table('organisations')
            ->whereRaw('id not in (select id from organisations where phone REGEXP ?)', ['^(0[0-9]{10})$'])
            ->pluck('phone', 'id');

            $uncleanPhoneNumbers->each(function ($phone, $id) {
                $cleanPhone = preg_replace('/[^0-9]/', '', $phone);

                DB::table('organisations')
                ->where('id', $id)
                ->update(['phone' => $cleanPhone]);
            });

            $uncleanUpdateRequests = DB::table('update_requests')
            ->where('updateable_type', 'organisations')
            ->whereNotNull('data->phone')
            ->pluck('data', 'id');

            $uncleanUpdateRequests->each(function ($data, $id) {
                $cleanPhone = preg_replace('/[^0-9]/', '', json_decode($data)->phone);

                DB::table('update_requests')
                ->where('id', $id)
                ->update(['data->phone' => $cleanPhone]);
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organisations', function (Blueprint $table) {
            //
        });
    }
}
