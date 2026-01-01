<?php

namespace App\Infrastructure\UTCDateTime;

use MongoDB\BSON\UTCDateTime;

class MongoUTCDateTime
{
    public static function now(): UTCDateTime
    {
        return new UTCDateTime();
    }
}