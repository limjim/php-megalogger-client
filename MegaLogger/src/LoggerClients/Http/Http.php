<?php

namespace LoggerClients\Http;

class Http {

    const BASE_URL = 'http://192.168.1.172:8161';

    public function getBaseUrl() {
        return self::BASE_URL;
    }

    public function getClientIp() {
        $ipaddress = '';

        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } else if (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }

        return $ipaddress;
    }

    public function getUserAgent() {

        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $platform = "N/A";
        $browser = "N/A";
        $osRegex = array(
            '/windows nt 10/i' => 'Windows 10',
            '/windows nt 6.3/i' => 'Windows 8.1',
            '/windows nt 6.2/i' => 'Windows 8',
            '/windows nt 6.1/i' => 'Windows 7',
            '/windows nt 6.0/i' => 'Windows Vista',
            '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
            '/windows nt 5.1/i' => 'Windows XP',
            '/windows xp/i' => 'Windows XP',
            '/windows nt 5.0/i' => 'Windows 2000',
            '/windows me/i' => 'Windows ME',
            '/win98/i' => 'Windows 98',
            '/win95/i' => 'Windows 95',
            '/win16/i' => 'Windows 3.11',
            '/macintosh|mac os x/i' => 'Mac OS X',
            '/mac_powerpc/i' => 'Mac OS 9',
            '/linux/i' => 'Linux',
            '/ubuntu/i' => 'Ubuntu',
            '/iphone/i' => 'iPhone',
            '/ipod/i' => 'iPod',
            '/ipad/i' => 'iPad',
            '/android/i' => 'Android',
            '/blackberry/i' => 'BlackBerry',
            '/webos/i' => 'Mobile',
            '/windows phone/i' => 'Windows Phone'
        );
        $browserRegex = array(
            '/MSIE/i' => 'IE',
            '/Firefox/i' => 'Firefox',
            '/Chrome/i' => 'Chrome',
            '/Safari/i' => 'Safari',
            '/Opera/i' => 'Opera',
            '/Netscape/i' => 'Netscape'
        );

        foreach ($osRegex as $regex => $value) {

            if (preg_match($regex, $userAgent)) {
                $platform = $value;
            }
        }
        foreach ($browserRegex as $regex => $value) {

            if (preg_match($regex, $userAgent)) {
                $browser = $value;
                break;
            }
        }

        return array(
            "platform" => $platform,
            "browser" => $browser
        );
    }

    public function curlExec($host, $strParams) {
        $process = curl_init($host);
        curl_setopt($process, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($process, CURLOPT_HEADER, 1);
        curl_setopt($process, CURLOPT_USERPWD, "admin" . ":" . "admin");
        curl_setopt($process, CURLOPT_TIMEOUT, 2000);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, $strParams);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        $retVal = curl_exec($process);
        curl_close($process);
        return $retVal;
    }

}
