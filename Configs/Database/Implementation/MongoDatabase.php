<?php

namespace Configs\Database\Implementation;

use Configs\Database\Interfaces\MongoDatabaseInterface;
use MongoDB\Client;

class MongoDatabase implements MongoDatabaseInterface
{
    public function connect(): Client
    {
        try {
            return new Client("mongodb://{$_ENV['MONGO_HOST']}:{$_ENV['MONGO_PORT']}");
        } catch (\Exception $e) {
            throw $e;
        }
    }
}