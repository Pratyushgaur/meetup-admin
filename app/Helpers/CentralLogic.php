<?php

use App\Models\BusinessSetting;

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