<?php

namespace LoggerClients;
use \Emarref\Jwt\Claim;

class LoggerClient {

    public function generateToken($apiKey) {
        $token = new \Emarref\Jwt\Token();
        $token->addClaim(new Claim\Audience([$apiKey]));
        $jwt = new \Emarref\Jwt\Jwt();
        $algorithm = new \Emarref\Jwt\Algorithm\HS512('megadev_secret');
        $encryption = \Emarref\Jwt\Encryption\Factory::create($algorithm);
        $serializedToken = $jwt->serialize($token, $encryption);
        return $serializedToken;
    }

    public function pushLog($token = null, $level = null, $data = [], $source = '') {
        $retVal = array(
            'status' => 'failed',
        );
        try {
            if ($level != null && $token != null) {
                $time = time();
                $ip = self::_http()->getClientIp();
                $device = self::_http()->getUserAgent();

                $metaData = array(
                    'language' => 'PHP',
                    'ip' => $ip,
                    'device' => $device
                );

                $params = array(
                    'type' => 'request',
                    'token' => $token,
                    'level' => $level,
                    'time' => $time,
                    'source' => $source,
                    'data' => $data,
                    'meta' => $metaData
                );
                $url = self::_http()->getBaseUrl() . "/api/message?destination=queue://logger";
                $strParams = json_encode($params);
                $output = self::_http()->curlExec($url, $strParams);
                $retVal['status'] = 'ok';
                $retVal['response'] = $output;
            }
        } catch (Exception $ex) {
            $retVal['message'] = $ex->getMessage();
        }
        return $retVal;
    }

    private static function _http() {
        return new \LoggerClients\Http\Http();
    }

}
