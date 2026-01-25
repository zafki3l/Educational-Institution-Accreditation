<?php

namespace Core;

use App\Infrastructure\Persistent\Databases\Interfaces\Core\DatabaseInterface;
use PDO;
use PDOStatement;

abstract class SqlRepository
{
    protected function __construct(protected DatabaseInterface $db) {}

    protected function getAll(string $sql): array
    {
        $conn = $this->db->connect();

        $stmt = $this->executeQuery($conn, $sql);

        $data = $this->fetchAll($stmt);

        $stmt = null;

        return $data;
    }

    protected function getByParams(array $params, string $sql): array
    {
        $conn = $this->db->connect();

        $stmt = $this->executeQuery($conn, $sql, $params);

        $data = $this->fetchAll($stmt);

        $stmt = null;

        return $data;
    }

    protected function insert(string $table, array $data): mixed
    {
        $conn = $this->db->connect();

        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";

        $this->executeQuery($conn, $sql, array_values($data));

        $id = $conn->lastInsertId();

        return $id;
    }

    protected function update(string $sql, array $params): int
    {
        $conn = $this->db->connect();

        $stmt = $this->executeQuery($conn, $sql, array_values($params));

        return $stmt->rowCount();
    }

    protected function delete(string $sql, array $params): int
    {
        $conn = $this->db->connect();

        $stmt = $this->executeQuery($conn, $sql, array_values($params));

        return $stmt->rowCount();
    }

    private function executeQuery(PDO $conn, string $sql, array $params = []): PDOStatement
    {
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);

        return $stmt;
    }

    private function fetchAll(PDOStatement $stmt): array
    {
        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }
}