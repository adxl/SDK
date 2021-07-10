<?php


class Env
{

    public static function getFacebookEnv()
    {
        return [
            'client_id' => '840316776603368',
            'client_secret' => '9771f095c09afdd4a48fe7a7b2baceff'
        ];
    }

    public static function getGoogleEnv()
    {
        return [];
    }

    public static function getGithubEnv()
    {
        return [
            'client_id' => '4286ff00bb74368139df',
            'client_secret' => '2465b2509785a2e29a3ef4ede9045fb174e7d736'
        ];
    }

    public static function getFireAuthEnv()
    {
        return [];
    }
}
