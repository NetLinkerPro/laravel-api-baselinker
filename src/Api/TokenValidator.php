<?php

namespace NetLinker\ApiBaselinker\Api;
use NetLinker\ApiBaselinker\BaselinkerClient;
use NetLinker\ApiBaselinker\BaselinkerApiException;

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
