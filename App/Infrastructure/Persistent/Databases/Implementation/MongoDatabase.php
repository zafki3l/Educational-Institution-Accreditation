<?php

namespace App\Infrastructure\Persistent\Databases\Implementation;

use App\Infrastructure\Persistent\Databases\Interfaces\MongoDatabaseInterface;
use MongoDB\Client;
use MongoDB\Collection;
use MongoDB\Database;

class MongoDatabase implements MongoDatabaseInterface
{
    private ?Client $client = null;
    private string $host;
    private string $port;
    private string $db;

    public function __construct()
    {
        $this->host = $_ENV['MONGO_HOST'] ?? throw new \RuntimeException('MongoDB Host missing!');
        $this->port = $_ENV['MONGO_PORT'] ?? throw new \RuntimeException('MongoDB Port missing!');
        $this->db = $_ENV['MONGO_DATABASE'] ?? throw new \RuntimeException('MongoDB Database missing!');

        $this->client = new Client("mongodb://{$this->host}:{$this->port}");
    }

    public function connect(): Client
    {
        return $this->client;
    }

    public function getDatabase(): Database
    {
        return $this->connect()->selectDatabase($this->db);
    }

    public function getCollection(string $collection_name): Collection
    {
        return $this->getDatabase()->selectCollection($collection_name);
    }
}