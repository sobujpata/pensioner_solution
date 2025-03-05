<?php
namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken {
    public static function CreateToken($userEmail, $userID):string
    {
        $key = env('JWT_KEY');
        if (!$key || !is_string($key)) {
            throw new \InvalidArgumentException('JWT_KEY is not set or is not a valid string.');
        }
        $payload = [
            'iss'=>'larvel-token',
            'iat'=>time(),
            'exp'=>time()+60*60*24,
            'userEmail'=>$userEmail,
            'userID'=>$userID
        ];
        return JWT::encode($payload, $key, 'HS256');
    }
    public static function CreateTokenEmployer($employerEmail, $employerID, $designation):string
    {
        $key = env('JWT_KEY');
        if (!$key || !is_string($key)) {
            throw new \InvalidArgumentException('JWT_KEY is not set or is not a valid string.');
        }
        $payload = [
            'iss'=>'employer-token',
            'iat'=>time(),
            'exp'=>time()+60*60*24,
            'employerEmail'=>$employerEmail,
            'designation'=>$designation,
            'employerID'=>$employerID
        ];
        return JWT::encode($payload, $key, 'HS256');
    }
    public static function CreateTokenForAdmin($userEmail, $userID, $userRole):string
    {
        $key = env('JWT_KEY');
        $payload = [
            'iss'=>'admin-token',
            'iat'=>time(),
            'exp'=>time()+60*60*24,
            'userEmail'=>$userEmail,
            'userID'=>$userID,
            'userRole'=>$userRole,
        ];
        return JWT::encode($payload, $key, 'HS256');
    }
    public static function CreateTokenForPassword($userEmail):string
    {
        $key = env('JWT_KEY');
        $payload = [
            'iss'=>'larvel-token',
            'iat'=>time(),
            'exp'=>time()+36*20,
            'userEmail'=>$userEmail,
            'userID'=>'0'
        ];
        return JWT::encode($payload, $key, 'HS256');
    }

    public static function VerifyToken($token):string|object
    {
        try {
            if($token==null){
                return 'unauthorized';
            }
            else{
                $key =env('JWT_KEY');
                $decode=JWT::decode($token,new Key($key,'HS256'));
                return $decode;
            }
        }
        catch (Exception $e){
            return 'unauthorized';
        }
    }
    public static function VerifyTokenEmloyer($tokenEmployer):string|object
    {
        try {
            if($tokenEmployer==null){
                return 'unauthorized';
            }
            else{
                $key =env('JWT_KEY');
                $decode=JWT::decode($tokenEmployer,new Key($key,'HS256'));
                return $decode;
            }
        }
        catch (Exception $e){
            return 'unauthorized';
        }
    }
    public static function VerifyTokenAdmin($tokenAdmin):string|object
    {
        try {
            if($tokenAdmin==null){
                return 'unauthorized';
            }
            else{
                $key =env('JWT_KEY');
                $decode=JWT::decode($tokenAdmin,new Key($key,'HS256'));
                return $decode;
            }
        }
        catch (Exception $e){
            return 'unauthorized';
        }
    }
}

