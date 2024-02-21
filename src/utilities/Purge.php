<?php

namespace helloswish\craftsecuricacheclear\utilities;

use Craft;
use craft\base\Utility;

/**
 * Purge utility
 */
class Purge extends Utility
{
    public static function displayName(): string
    {
        return Craft::t('securi-cache-clear', 'Securi Cache Purge');
    }

    static function id(): string
    {
        return 'securi-purge';
    }

    public static function iconPath(): ?string
    {
        return Craft::getAlias("@helloswish/craftsecuricacheclear/resources/images/logo.svg");
    }

    static function contentHtml(): string
    {
        return Craft::$app->getView()->renderTemplate('securi-cache-clear/_utility.twig');
    }
}
