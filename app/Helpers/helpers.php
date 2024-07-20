<?php

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Double;

if (!function_exists('apiResponse')) {
    function apiResponse($data = null, $message = null, $code = 200)
    {
        $array = [
            'data' => $data,
            'status' => in_array($code, successCode()),
            'message' => $message,
        ];
        return response($array, $code);
    }
}

if (!function_exists('successCode')) {
    function successCode(): array
    {
        return [
            200, 201, 202
        ];
    }
}

if (!function_exists('getDateOfSpecificDay')) {

    function getDateOfSpecificDay($day, $date): \Carbon\Carbon
    {
        $dayOfWeek = $date->dayOfWeek;

        if ($dayOfWeek != (int)$day) {
            $date = $date->addDay();
            $date = getDateOfSpecificDay($day, $date);
        }
        return $date;
    }
}

if (!function_exists('replaceFlags')) {

    function replaceFlags($content,$values =[])
    {
        if (count($values)){
            foreach (\App\Enum\FcmEventsNames::$FLAGS as $FLAG)
            {
                if (isset($values[$FLAG]))
                    $content = str_replace($FLAG,$values[$FLAG],$content);
            }
        }
        return $content;

    }
}

if (!function_exists('getLocale')) {

    function getLocale(): string
    {
        return app()->getLocale();
    }
}

if (!function_exists('userCan')) {

    function userCan(Request $request, string $permission)
    {
        if(!$request->user()->can($permission))
            abort(403);
    }
}


if (!function_exists('setLanguage')) {

    function setLanguage(string $locale): void
    {
        app()->setLocale($locale);
    }
}


if (!function_exists('isPointInPolygon')) {

    function isPointInPolygon(string $lat, string $lng)
    {
        $setting = Setting::first();
        $latP = $lat;
        $lngP = $lng;
        $latA = $setting->point_one_lat;
        $lngA = $setting->point_one_lng;
        $latB = $setting->point_two_lat;
        $lngB = $setting->point_two_lng;
        $latC = $setting->point_three_lat;
        $lngC = $setting->point_three_lng;
        $latD = $setting->point_four_lat;
        $lngD = $setting->point_four_lng;

        $checkLat =  ($latP >$latA && $latP < $latB && $latP > $latC && $latP < $latD)? true:false;
        $checkLng =  ($lngP >$lngA && $lngP > $lngB && $lngP < $lngC && $lngP < $lngD)? true:false;
        if($checkLat && $checkLng)
            return "true";
        else
            return "false";

    }

}
