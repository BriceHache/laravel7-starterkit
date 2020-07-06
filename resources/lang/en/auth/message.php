<?php
/**
* Language file for auth error messages
*
*/

return [

    'account_already_exists' => 'An account with this email address already exists.',
    'account_not_found'      => "The user name or password is incorrect.",
    'account_not_activated'  => "This user account is not activated.",
    'account_suspended'      => "User account suspended due to too many connection attempts. Try again after [:delay] secondes",
    'account_banned'         => 'This user account is banned.',

    'signin' => [
        'error'   => "There was a problem during authentication, please try again.",
        'success' => 'You have been authenticated.',
    ],

    'signup' => [
        'error'   => "There was a problem creating your account, please try again.",
        'success' => 'Account successfully created.',
    ],

        'forgot-password' => [
            'error'   => "There was a problem recovering your password, please try again.",
            'success' => 'Password recovery email sent successfully.',
        ],

        'forgot-password-confirm' => [
            'error'   => "There was a problem changing your password, please try again.",
            'success' => 'Your password has been successfully changed.',
        ],

    'activate' => [
        'error'   => "There was a problem activating your account, please try again.",
        'success' => 'Your account has been activated.',
    ],

];
