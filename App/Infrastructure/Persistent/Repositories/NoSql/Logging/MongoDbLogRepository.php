<?php

namespace App\Infrastructure\Persistent\Repositories\NoSql\Logging;

use App\Infrastructure\Persistent\Databases\Interfaces\MongoDatabaseInterface;
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