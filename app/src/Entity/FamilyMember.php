<?php

namespace App\Entity;

class FamilyMember implements EntityInterface
{
    public const ID_COLUMN_NAME = "id";
    public const NAME_COLUMN_NAME = "name";
    public const ROLE_COLUMN_NAME = "role";
    public const COST_COLUMN_NAME = "cost";

    public const PARENT_ROLE = "parent";
    public const CHILD_ROLE = "child";
    public const PET_ROLE = "pet";

    public const DAD_TYPE = 'dad';
    public const MOM_TYPE = 'mom';
    public const CHILD_TYPE = 'child';
    public const ADOPTED_CHILD_TYPE = 'adopted_child';
    public const CAT_TYPE = 'cat';
    public const DOG_TYPE = 'dog';
    public const GOLDFISH_TYPE = 'goldfish';

    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $role;

    /** @var int */
    private $cost;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): FamilyMember
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): FamilyMember
    {
        $this->name = $name;

        return $this;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): FamilyMember
    {
        $this->role = $role;

        return $this;
    }

    public function getCost(): int
    {
        return $this->cost;
    }

    public function setCost(int $cost): FamilyMember
    {
        $this->cost = $cost;

        return $this;
    }
}