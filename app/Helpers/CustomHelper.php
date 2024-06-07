<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

if (!function_exists('getProvinces')) {
    function getProvinces()
    {
        try {
            $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');

            if ($response->successful()) {
                return $response->json();
            } else {
                // Handle error response if needed
                return [];
            }
        } catch (\Exception $e) {
            // Handle exceptions if any
            return [];
        }
    }
}

if(!function_exists('da')){
    function da($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        die();
    }
}

if (!function_exists('getRegencies')) {
    function getRegencies($provinceId)
    {
        try {
            $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/regencies/' . $provinceId . '.json');

            // dd($response);

            if ($response->successful()) {
                return $response->json();
            } else {
                // Handle error response if needed
                return [];
            }
        } catch (\Exception $e) {
            // Handle exceptions if any
            return [];
        }
    }
}

if (!function_exists('getDistricts')) {
    function getDistricts($regencyId)
    {
        try {
            $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/districts/' . $regencyId . '.json');

            // dd($response);

            if ($response->successful()) {
                return $response->json();
            } else {
                // Handle error response if needed
                return [];
            }
        } catch (\Exception $e) {
            // Handle exceptions if any
            return [];
        }
    }
}

if (!function_exists('getVillages')) {
    function getVillages($districtId)
    {
        try {
            $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/villages/' . $districtId . '.json');

            // dd($response);

            if ($response->successful()) {
                return $response->json();
            } else {
                // Handle error response if needed
                return [];
            }
        } catch (\Exception $e) {
            // Handle exceptions if any
            return [];
        }
    }
}

if (!function_exists('demohelper')) {
    function demohelper($string)
    {
        return $string;
    }
}

if (!function_exists('convertYmdToMdy')) {
    function convertYmdToMdy($date){
        return Carbon::createFromFormat('Y-m-d', $date)->format('m/d/Y');
    }
}
