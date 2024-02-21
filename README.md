Securi Cache Clear

Purge Securi caches from Craft.

## Requirements

This plugin requires Craft CMS 4.x or later, and PHP 8.0.2 or later.

## Installation

You can install this plugin from the Plugin Store or with Composer.

#### From the Plugin Store

Go to the Plugin Store in your project’s Control Panel and search for “Securi Cache Clear”. Then press “Install”.

#### With Composer

Open your terminal and run the following commands:

```bash
# go to the project directory
cd /path/to/my-project

# tell Composer to load the plugin
composer require swish-digital/craft-securi-cache-clear

# tell Craft to install the plugin
./craft plugin/install securi-cache-clear
```

## Configuration

Go to your Securi dashboard and locate the API section. Find your API Key and API Secret.

It is recommended that you add the key and secret to your .env file as environment variables. However, you may also enter them directly into the plugin settings.

Go to your Craft control panel > Settings > Plugins > Securi Cache Clear > Settings

Enter your API Key and API Secret, or choose the environment variables you previously setup, and save the plugin settings.

## Usage

Go to your Craft control panel > Utilities > Securi Cache Purge and click the "Purge Securi Cache" button. Once complete, the control panel will display a success notification popup.

## Roadmap

1. Add discreet uri cache clearing utility
2. Add cache clearing upon element save (entries, categories, globals, etc.)

## Support

Please [file an issue](https://github.com/Swish-Digital/securi-cache-clear/issues) on Github. 