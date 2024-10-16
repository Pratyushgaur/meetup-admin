<?php

use App\Models\BusinessSetting;
use Carbon\Carbon;
use GuzzleHttp\Client;


if(! function_exists('Helpers_get_logo')) {
    function Helpers_get_logo()
    {
        if(BusinessSetting::exists()){
            $data = BusinessSetting::first();
            $config = "companyimage/".$data->logo;
        }else{
            $config = "category/1726249003_5352069_Screenshot 2024-09-13 225014.php";
        }
        return $config;
    }
}

if(! function_exists('Helpers_get_favicon')) {
    function Helpers_get_favicon()
    {
        if(BusinessSetting::exists()){
            $data = BusinessSetting::first();
            $config = "companyimage/".$data->fevicon;
        }else{
            $config = "category/1726249003_5352069_Screenshot 2024-09-13 225014.php";
        }
        return $config;
    }
}

if(! function_exists('Helpers_get_company_name')) {
    function Helpers_get_company_name()
    {
        if(BusinessSetting::exists()){
            $data = BusinessSetting::first();
            $config = $data->name;
        }else{
            $config = env('APP_NAME');
        }
        return $config;
    }
}

if(! function_exists('Helpers_get_influncer_default_commission')) {
    function Helpers_get_influncer_default_commission()
    {  
        if(BusinessSetting::exists()){           
            $data = BusinessSetting::first();
            $config = $data->Influancer_default_commission;
        }else{
            $config = 0;
        }
        return $config;
    }
}

if(! function_exists('Helpers_get_total_income')) {
    function Helpers_get_total_income()
    {
        if(BusinessSetting::exists()){
            $data = BusinessSetting::first();
            $config = $data->total_income;
        }else{
            $config = 0;
        }
        return $config;
    }
}

if(! function_exists('Helpers_get_previous_months')) {
    function Helpers_get_previous_months()
    {
        $month = [];
        for ($i=11; $i >= 0; $i--) { 
            $months = new Carbon('-'.$i.' month');
            array_push($month,$months->format('M-Y'));
        }
        return $month;
    }
}

// if(! function_exists('create_agora_project')) {
//     function create_agora_project()
//     {
//        $custmer_key = env('customerKey');
//        $custmer_secret = env('customerSecret');
//        $credentials = $custmer_key.":".$custmer_secret;
//        $base64 = base64_encode($credentials);

//     }
// }

  function generateZegoToken($userID, $appID, $appSecret) {
    $client = new Client();
    dd($client);
    $url = "https://api.zegocloud.com/v1/token";

    $response = $client->post($url, [
        'json' => [
            'app_id' => $appID,
            'app_secret' => $appSecret,
            'user_id' => $userID
        ]
    ]);
   
    $data = json_decode($response->getBody(), true);
    return $data['token'];
}


