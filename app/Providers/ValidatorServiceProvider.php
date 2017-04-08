<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * バリデートサービスプロバイダ
 *
 * @author Kuniyasu Wada
 */
class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Add Validation Rules...
        \Validator::extend('api_access_token',  'App\Http\Validates\CustomValidator@validateAccessToken');
//         \Validator::extend('true',              'App\Http\Validates\CustomValidator@validateTrue');
//         \Validator::extend('false',             'App\Http\Validates\CustomValidator@validateFalse');
//         \Validator::extend('role_name',         'App\Http\Validates\CustomValidator@validateRoleName');
//         \Validator::extend('input_status',      'App\Http\Validates\CustomValidator@validateInputStatus');
//         \Validator::extend('video_scale',       'App\Http\Validates\CustomValidator@validateVideoScale');
//         \Validator::extend('jp_zip_code',       'App\Http\Validates\CustomValidator@validateJpZipCode');
//         \Validator::extend('card_number',       'App\Http\Validates\CustomValidator@validateCardNumber');
//         \Validator::extend('card_holder_name',  'App\Http\Validates\CustomValidator@validateCardHolderName');
//         \Validator::extend('security_code',     'App\Http\Validates\CustomValidator@validateSecurityCode');
//         \Validator::extend('card_expire',       'App\Http\Validates\CustomValidator@validateCardExpire');
//         \Validator::extend('account_name_kana', 'App\Http\Validates\CustomValidator@validateAccountNameKana');
//         \Validator::extend('only_zenkaku',      'App\Http\Validates\CustomValidator@validateOnlyZenkaku');
//         \Validator::extend('mime_images',       'App\Http\Validates\CustomValidator@validateImages');
//         \Validator::extend('mime_csv',          'App\Http\Validates\CustomValidator@validateCSV');
//         \Validator::extend('exists_file',       'App\Http\Validates\CustomValidator@validateExistsFile');
//         \Validator::extend('bamp_source',       'App\Http\Validates\CustomValidator@validateBampSource');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
