<?php

namespace App\Contracts\JWT;

interface JwtContract
{
    public function decodeRS256($token, $keyPath): array;

    public function encodeHS256($payload, $key);

    public function decodeHS256($token, $key);
}
