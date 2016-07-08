<?php
/*
Library Name: GEO IP Check
Description: Library for Location checking based on IP Address
Thanks to: https://github.com/willyarisky
*/

error_reporting(0);

class geoip
{
    private function get_client_ip()
    {
        $ip     = '';

        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ip     = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ip     = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ip     = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ip     = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ip     = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ip     = $_SERVER['REMOTE_ADDR'];
        else
            $ip     = '0.0.0.0';

        return $ip;
    }

    private function country($ip)
    {
        $ip     = $this->get_client_ip();
        $getloc = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
        $country = $getloc->country;		
		return $country;
    }

	function detail($country)
	{
		$country = $this->country();
		$getname = json_decode(file_get_contents("https://restcountries.eu/rest/v1/alpha/{$country}"));
		$name 	 = $getname->name;
		return $name;
	}
}
