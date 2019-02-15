#  MongooseIm Admin API wrapper for Laravel/Lumen 5.*
[MongooseIm Admin API](https://mongooseim.readthedocs.io/en/latest/rest-api/Administration-backend/)

## Installation
```
composer require kevin-kibet/laravel-mongooseim
```
## Configuration
You can publish the configuration file using this command

$ php artisan vendor:publish --provider="MongooseIm\Providers\MongooseImServiceProvider"
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

#### Create user
Register a new user to your xmpp server
```php
$create_user = new CreateUser($user, $password, $host);
$response = MongooseImFacade::createUser($create_user);
```

#### Send message
Send message to a user or conference
```php
$send_message = new SendMessage($type, $from, $to, $subject, $body);
$response = MongooseImFacade::sendMessage($send_message);
```
