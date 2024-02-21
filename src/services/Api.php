<?php

namespace helloswish\craftsecuricacheclear\services;

use Craft;
use craft\helpers\App;
use helloswish\craftsecuricacheclear\Securi;
use yii\base\Component;

/**
 * Api service
 */
class Api extends Component
{

    /**
     * Purge the entire cache.
     */
    public function purgeEntireCache(): ?object
    {

        $settings = Securi::getInstance()->getSettings();

        $apiKey = App::parseEnv($settings->apiKey);
        $apiSecret = App::parseEnv($settings->apiSecret);

        if(strlen($apiKey) && strlen($apiSecret)) {

            //        curl 'https://waf.sucuri.net/api?v2' \
            //            --data 'k=API_KEY' \
            //            --data 's=API_SECRET' \
            //            --data 'a=clear_cache'

            //        https://waf.sucuri.net/api?k=b90b816ada2b777a04735bc91d9e9a3c&s=b090ddb8fb2e1a9f57bc8c955fb0d3df&a=clearcache

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'https://waf.sucuri.net/api?v2',
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => http_build_query(array(
                    // this is the Sucuri CloudProxy API key for this website
                    'k' => $apiKey,
                    // this is the Sucuri CloudProxy API secret for this website
                    's' => $apiSecret,
                    // this is the Sucuri CloudProxy API action for this website
                    'a' => 'clear_cache'
                ))
            ));
            // Send the request & save response to $json_resp
            $json_resp = curl_exec($curl);
            $resp = json_decode($json_resp);

            // Close request to clear up some resources
            curl_close($curl);

            return $resp;

        }

    }
}
