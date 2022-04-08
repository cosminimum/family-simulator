<?php

namespace App\Repository;

use App\Component\Database\Result;
use App\Entity\EntityInterface;

interface RepositoryInterface
{
    public function findAll(): Result;
    public function removeAll(): void;
    public function findBy(array $filter, ?array $sort): Result;
}