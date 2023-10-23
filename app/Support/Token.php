<?php

namespace App\Support;

use Firebase\JWT\JWT;

class Token
{
    private static $secretKey;

    private static function getSecretKey(): string
    {
        if (!self::$secretKey) {
            self::$secretKey = env('SECRET_KEY');

            if (empty(self::$secretKey)) {
                throw new \RuntimeException('SECRET_KEY is not set in the environment');
            }
        }

        return self::$secretKey;
    }

    private static function getExpiration(): int
    {
        return 3600; // seconds
    }

    public static function generateToken(array $data): string
    {
        $issuedAt = time();
        $expire = $issuedAt + self::getExpiration();

        $token = [
            'iat' => $issuedAt,
            'exp' => $expire,
            'data' => $data,
        ];

        return JWT::encode($token, self::getSecretKey(), 'HS256');
    }

    public static function verifyToken(string $token): array
    {
        $algorithm = ['HS256'];

        try {
            $decoded = JWT::decode($token, self::getSecretKey(),$algorithm);
            return (array)$decoded;
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return [];
        }
    }

}