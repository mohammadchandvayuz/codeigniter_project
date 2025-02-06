<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function generateJWT($user)
{
    $key = getenv('JWT_SECRET');
    if (!$key || empty($key)) {
        die('JWT_SECRET is not set or is empty.');
    }
    $issuedAt = time();
    $expirationTime = $issuedAt + 3600; // Token expires in 1 hour
    $payload = [
        'iat' => $issuedAt,
        'exp' => $expirationTime,
        'user_id' => $user['id'],
        'email' => $user['email']
    ];

    return JWT::encode($payload, $key, 'HS256');
}

function validateJWT($token)
{
    try {
        $key = getenv('JWT_SECRET');
        return JWT::decode($token, new Key($key, 'HS256'));
    } catch (\Exception $e) {
        return null;
    }
}
