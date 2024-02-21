<?php

namespace helloswish\craftsecuricacheclear\models;

use Craft;
use craft\base\Model;

/**
 * Securi Cache Clear settings
 */
class Settings extends Model
{
    public $apiKey = '';
    public $apiSecret = '';

    protected function defineRules(): array
    {
        return array_merge(parent::defineRules(), [
            [['apiKey', 'apiSecret'], 'required'],
            // ...
        ]);
    }
}
