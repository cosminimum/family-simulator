<?php

namespace App\Service;

use App\Component\Database\Result;
use App\Entity\FamilyMember;
use App\Repository\FamilyMemberRepository;
use App\Service\Adapter\FamilyMemberAdapterService;

class FamilyDataService
{
    private const MULTI_CHILD_FAMILY_COST_REDUCTION_AMOUNT = 50;

    public static function calculate(Result $result): array
    {
        $totalSpendings = 0;
        $members = [];
        $familyHasChild = false;

        if ($result->count() > 0) {
            $familyMemberRepository = new FamilyMemberRepository();

            foreach ($result->getData() as $familyMemberId) {
                // can be little slow here, because of multi-querying
                // we can create a repository method that supports IN and can be created a single query outside this loop
                $familyMember = FamilyMemberAdapterService::arrayToEntity(
                    // instead of two way adapter will be nice a serializer / normalizer
                    $familyMemberRepository->findById($familyMemberId->member_id)->getData()[0]
                );

                $members[] = $familyMember->getName();

                if (FamilyMember::CHILD_ROLE === $familyMember->getRole()) {
                    $familyHasChild = true;
                }

                $cost = $familyMember->getCost();
                if ($familyHasChild) {
                    $cost = $familyMember->getCost() + self::MULTI_CHILD_FAMILY_COST_REDUCTION_AMOUNT;
                }

                $totalSpendings += $cost;
            }
        }

        return [
            'members' => $members,
            'total_members' => $result->count(),
            'total_spendings' => $totalSpendings
        ];
    }
}