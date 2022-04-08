<?php

namespace App\Service\Adapter;

use App\Entity\FamilyMember;

class FamilyMemberAdapterService
{
    public static function arrayToEntity(array $familyMember): FamilyMember
    {
        return (new FamilyMember())
            ->setId((int) $familyMember[FamilyMember::ID_COLUMN_NAME])
            ->setName($familyMember[FamilyMember::NAME_COLUMN_NAME])
            ->setCost($familyMember[FamilyMember::COST_COLUMN_NAME])
            ->setRole($familyMember[FamilyMember::ROLE_COLUMN_NAME])
        ;
    }
}