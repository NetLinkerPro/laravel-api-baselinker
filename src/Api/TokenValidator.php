<?php

namespace NetLinker\LaravelApiBaselinker\Api;
use NetLinker\LaravelApiBaselinker\BaselinkerClient;
use NetLinker\LaravelApiBaselinker\BaselinkerApiException;

class TokenValidator
{
    /**
     * Is valid token
     *
     * @param $token
     * @return bool
     */
    public static function isValidToken($token)
    {
        $baselinkerClient = new BaselinkerClient(['token' =>$token]);
        try{
            $baselinkerClient->storages()->getStoragesList();
            return true;
        } catch (BaselinkerApiException $e){
            return false;
        }
    }
}
