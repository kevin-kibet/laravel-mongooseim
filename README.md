#  MongooseIm Admin API wrapper for Laravel/Lumen 5.*
[MongooseIm Admin API](https://mongooseim.readthedocs.io/en/latest/rest-api/Administration-backend/)

## Installation
```
composer require kevin-kibet/laravel-mongooseim
```
## Configuration
You can publish the configuration file using this command
```bash
$ php artisan vendor:publish --provider="MongooseIm\Providers\MongooseImServiceProvider"
```
#### Sample configuration
```php
<?php
return [
    'api' => env('MONGOOSE_IM_API', 'http://'),
    'domain' => env('MONGOOSE_IM_DOMAIN', 'im.savepal.novacent.net'),
    'muc_domain' => env('MONGOOSE_IM_MUC_DOMAIN'),
    'muc_light_domain' => env('MONGOOSE_IM_MUC_LIGHT_DOMAIN'),
    'debug' => env('MONGOOSE_IM_DEBUG', true)
];
```

### Laravel
Register the service provider: In your config/app.php
```php
'providers' => [
    // Other Service Providers

    MongooseIm\Providers\MongooseImServiceProvider::class
],
```

### Lumen
To load the configuration, in your bootstrap/app.php
```php
$app->configure('mongoose-im')
```
Register the service provider
```php
$app->register(MongooseIm\Providers\MongooseImServiceProvider::class);
```
## Examples

#### Send message
Send message to a user or room
```php
$send_message = new SendMessage($to, $from, $body);
$response = MongooseImFacade::execute($send_message);
```

#### Others
> Coming soon
