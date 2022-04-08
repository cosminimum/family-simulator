<?php

namespace App\Repository;

use App\Component\Database\Result;
use App\Entity\EntityInterface;

class FamilyMemberRepository extends AbstractRepository implements RepositoryInterface
{
    private const TABLE_NAME = "members";

    public function findAll(): Result
    {
        $data = $this->run(sprintf("SELECT * FROM %s", self::TABLE_NAME));

        return new Result($data);
    }

    public function removeAll(): void
    {
        $this->run(sprintf("DELETE FROM %s", self::TABLE_NAME));
    }

    public function findBy(array $filter, ?array $sort = []): Result
    {
        $data = $this->run(sprintf("SELECT * FROM %s WHERE name = ?", self::TABLE_NAME), $filter);

        return new Result($data);
    }

    public function findById(int $id): Result
    {
        $data = $this->run(sprintf("SELECT * FROM %s WHERE id = ?", self::TABLE_NAME), [$id]);

        return new Result($data);
    }

    public function findByName(string $name): Result
    {
        $data = $this->run(sprintf("SELECT * FROM %s WHERE name = ?", self::TABLE_NAME), [$name]);

        return new Result($data);
    }
}