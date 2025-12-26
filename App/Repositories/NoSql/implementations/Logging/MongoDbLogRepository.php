<?php

namespace App\Repositories\NoSql\Implementations\Logging;

use Configs\Database\Interfaces\MongoDatabaseInterface;
use MongoDB\InsertOneResult;

class MongoDbLogRepository
{
    private const COLLECTION_NAME = 'logs';

    public function __construct(private MongoDatabaseInterface $mongo) {}

    public function findAll()
    {
        $data = [];

        return $data;
    }

    public function insertOne(array $document, array $options = []): InsertOneResult
    {
        $collection = $this->mongo->getCollection(self::COLLECTION_NAME);

        return $collection->insertOne($document, $options);
    }
}