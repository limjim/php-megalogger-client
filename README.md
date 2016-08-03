# php megalogger client

##Installation:
```javascript
composer require megadevelop/php-megalogger-client
```
###OR
**add in file composer.json**
```javascript
"require": {
	"megadevelop/php-megalogger-client":"dev-master"
}
```
##Usage:
**Create an instance of the LoggerClients\LoggerClient class**

```
use LoggerClients\LoggerClient;

$loggerClient = new LoggerClient();
$apiKey = "asfkjewf46388asfafsf_megaToken";
$token = $loggerClient->generateToken(apiKey);

// Get level: info, debug, warning, error, critical
$levelObj = new Level();
$level = $levelObj->getLevelInfo();
$source = 'source_log';

$data = array("message" => "Message attachment token");
//push log 

$response = $loggerClient->pushLog($token, $level, $data, $source);
echo '<pre>';
print_r($response);
echo '</pre>';
```



