<?php
/**
 * Created by PhpStorm.
 * User: kibet
 * Date: 7/2/2018
 * Time: 4:02 PM
 */
return [
    'api' => env('MONGOOSE_IM_API', 'http://conversations.im:8088/api'),
    'domain' => env('MONGOOSE_IM_DOMAIN', 'conversations.im'),
    'muc_domain' => env('MONGOOSE_IM_MUC_DOMAIN', 'muc.conversations.im'),
    'muc_light_domain' => env('MONGOOSE_IM_MUC_LIGHT_DOMAIN', 'muclight.conversations.im'),
    'debug' => env('MONGOOSE_IM_DEBUG', true)
];
