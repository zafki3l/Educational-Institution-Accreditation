<?php

namespace App\Repositories\NoSql\Implementations;

use App\Repositories\NoSql\Interfaces\LogRepositoryInterface;
use Configs\Database\Interfaces\MongoDatabaseInterface;

class LogRepository implements LogRepositoryInterface
{
    public function __construct(private MongoDatabaseInterface $mongo) {}

    public function find()
    {
        $data = [];
        $students = $this->mongo->getCollection('student');

        foreach ($students as $student) {
            $data[] = $student;
        }

        return $data;
    }
}