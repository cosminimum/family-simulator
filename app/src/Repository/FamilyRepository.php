<?php

namespace App\Repository;

use App\Component\Database\Result;
use App\Entity\EntityInterface;
use App\Service\Adapter\FamilyMemberAdapterService;

class FamilyRepository extends AbstractRepository implements RepositoryInterface
{
    private const TABLE_NAME = "family";

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
        $data = $this->run(sprintf("SELECT * FROM %s", self::TABLE_NAME), $filter);

        return new Result($data);
    }

    public function saveMember(int $id): void
    {
        $this->run(sprintf("INSERT INTO %s (member_id) VALUES (?)", self::TABLE_NAME), [$id]);
    }
}