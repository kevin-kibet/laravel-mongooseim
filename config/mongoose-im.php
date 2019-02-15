<?php
/**
 * Created by PhpStorm.
 * User: kibet
 * Date: 7/2/2018
 * Time: 4:02 PM
 */
return [
    'api' => env('MONGOOSE_IM_API', 'http://im.savepal.novacent.net'),
    'domain' => env('MONGOOSE_IM_DOMAIN', 'im.savepal.novacent.net'),
    'muc_domain' => env('MONGOOSE_IM_MUC_DOMAIN'),
    'muc_light_domain' => env('MONGOOSE_IM_MUC_LIGHT_DOMAIN'),
    'debug' => env('MONGOOSE_IM_DEBUG', true)
];
