<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\UserAccessToken;

class UserHelper
{
    public static function save_or_update_user($user_data)
    {
        $user = User::where('email', $user_data['email'])->first();

        if(is_null($user)) {

            $user_model = new User;
            $user_model->name = $user_data['name'];
            $user_model->email = $user_data['email'];
            $user_model->save();

            $access_token_model = new UserAccessToken;
            $access_token_model->user_id = $user_model->id;
            $access_token_model->name = $user_data['name'];
            $access_token_model->access_token = $user_data['access_token'];
            $access_token_model->save();
        } else {
            UserAccessToken::where('user_id', $user->id)
            ->update(['access_token' => $user_data['access_token']]);

        }
    }
}
