<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserAccessToken;

class UserService
{
    public static function save_or_update_user($user_data)
    {
        $user_exists = User::where('email', $user_data['email'])->first();

        if(is_null($user_exists)) {
            $user_model = new User;

            $user_model->name = $user_data['name'];
            $user_model->email = $user_data['email'];
            $user_model->user_image = $user_data['image'];
            $user_model->save();

            if($user_data['provider']) {
                UserService::save_access_token(
                    $user_model->id,
                    $user_data['name'],
                    $user_data['access_token']
                );
            }
        }
    }

    public static function save_access_token($user_id, $provider_name, $access_token)
    {
        $token_model = new UserAccessToken;

        $token_model->user_id = $user_id;
        $token_model->provider_name = $provider_name;
        $token_model->access_token = $access_token;
        $token_model->save();
    }
}
