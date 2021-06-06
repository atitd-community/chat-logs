<?php

use App\Models\ChatLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('system/{timestamp}', function(Request $request, $timestamp) {
    $raw = ChatLog::where('game_name', 'ATITD10A')
                  ->where('channel_name', 'System')
                  ->where('msg_date', '>', gmdate("Y-m-d H:i:s", $timestamp))
                  ->get();

    $return = [];

    $i = 0;

    foreach($raw as $key => $value) {
        $return[$i]['message'] = $value->full_message;
        $return[$i]['timestamp'] = (new Carbon($value->msg_date))->timestamp;

        $i++;
    }

    return $return;
});
