<?php

namespace helloswish\craftsecuricacheclear;

use Craft;
use craft\base\Model;
use craft\base\Plugin;
use craft\events\RegisterComponentTypesEvent;
use craft\services\Utilities;
use helloswish\craftsecuricacheclear\models\Settings;
use helloswish\craftsecuricacheclear\services\Api;
use helloswish\craftsecuricacheclear\utilities\Purge;
use yii\base\Event;

/**
 * Securi Cache Clear plugin
 *
 * @method static Securi getInstance()
 * @method Settings getSettings()
 * @author Swish Digital <support@swishdigital.co>
 * @copyright Swish Digital
 * @license MIT
 * @property-read Api $api
 */
class Securi extends Plugin
{
    public string $schemaVersion = '1.0.0';
    public bool $hasCpSettings = true;

    public static function config(): array
    {
        return [
            'components' => ['api' => Api::class],
        ];
    }

    public function init(): void
    {
        parent::init();

        // Defer most setup tasks until Craft is fully initialized
        Craft::$app->onInit(function() {
            $this->attachEventHandlers();
            // ...
        });
    }

    protected function createSettingsModel(): ?Model
    {
        return Craft::createObject(Settings::class);
    }

    protected function settingsHtml(): ?string
    {
        return Craft::$app->view->renderTemplate('securi-cache-clear/_settings.twig', [
            'plugin' => $this,
            'settings' => $this->getSettings(),
        ]);
    }

    private function attachEventHandlers(): void
    {
        // Register event handlers here ...
        // (see https://craftcms.com/docs/4.x/extend/events.html to get started)

        // The name of the event appears to have changed in Craft 5
        // Craft 5 = EVENT_REGISTER_UTILITIES
        // Older Craft versions = EVENT_REGISTER_UTILITY_TYPES
        $craftVersion = Craft::$app->version;

        if($craftVersion[0] === '5') {
            Event::on(Utilities::class, Utilities::EVENT_REGISTER_UTILITIES, function (RegisterComponentTypesEvent $event) {
                $event->types[] = Purge::class;
            });
        } else {
            Event::on(Utilities::class, Utilities::EVENT_REGISTER_UTILITY_TYPES, function (RegisterComponentTypesEvent $event) {
                $event->types[] = Purge::class;
            });
        }

    }
}
