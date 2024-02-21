<?php

namespace helloswish\craftsecuricacheclear\controllers;

use Craft;
use craft\helpers\UrlHelper;
use craft\web\Controller;
use helloswish\craftsecuricacheclear\Securi;
use yii\web\Response;

/**
 * Purge controller
 */
class PurgeController extends Controller
{
    public $defaultAction = 'index';
    protected array|int|bool $allowAnonymous = self::ALLOW_ANONYMOUS_NEVER;

    /**
     * Purges entire Cloudflare zone cache.
     * @return Response
     */
    public function actionPurgeAll()
    {

        $result = Securi::getInstance()->api->purgeEntireCache();

        $url = UrlHelper::urlWithParams('utilities/securi-purge', [
            'type' => 'purgeEntireCache',
            'status' => $result->status
        ]);

        Craft::$app->getSession()->setSuccess($result->messages[0]);

        return $this->redirect($url);

    }
}
