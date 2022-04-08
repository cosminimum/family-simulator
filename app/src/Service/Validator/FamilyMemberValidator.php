<?php

namespace App\Service\Validator;

use App\Entity\FamilyMember;
use App\Exception\FamilyMemberValidationException;
use App\Repository\FamilyMemberRepository;
use App\Repository\FamilyRepository;
use App\Service\Adapter\FamilyMemberAdapterService;

class FamilyMemberValidator
{
    public static function validate(FamilyMember $familyMember): bool
    {
        $familyRepository = new FamilyRepository();

        $family = $familyRepository->findAll();

        if (!$family) {
            return true;
        }

        $familyMemberRepository = new FamilyMemberRepository();

        $hasMom = false;
        $hasDad = false;

        if ($family->count() > 0) {
            foreach ($family->getData() as $member) {
                /** @var FamilyMember $member */
                $alreadyMember = FamilyMemberAdapterService::arrayToEntity(
                    $familyMemberRepository->findById($member->member_id)->getData()[0]
                );

                if (FamilyMember::DAD_TYPE === $familyMember->getName() && FamilyMember::DAD_TYPE === $alreadyMember->getName()) {
                    throw new FamilyMemberValidationException('ERROR: The family already has a dad. (No support for modern families yet. :))');
                }

                if (FamilyMember::DAD_TYPE == $alreadyMember->getName()) {
                    $hasDad = true;
                }

                if (FamilyMember::MOM_TYPE === $familyMember->getName() && FamilyMember::MOM_TYPE === $alreadyMember->getName()) {
                    throw new FamilyMemberValidationException('ERROR: The family already has a mum. (No support for modern families yet. :))');
                }

                if (FamilyMember::MOM_TYPE == $alreadyMember->getName()) {
                    $hasMom = true;
                }

                if (FamilyMember::PARENT_ROLE !== $familyMember->getRole()) {
                    if (FamilyMember::ADOPTED_CHILD_TYPE === $familyMember->getName()) {
                        if (!$hasMom && !$hasDad) {
                            throw new FamilyMemberValidationException(sprintf('ERROR: No %s without a mum or a dad.', $familyMember->getName()));
                        }
                    }

                    if (!$hasMom || !$hasDad) {
                        throw new FamilyMemberValidationException(sprintf('ERROR: No %s without a mum and a dad.', $familyMember->getName()));
                    }
                }
            }
        } else {
            if (FamilyMember::PARENT_ROLE !== $familyMember->getRole()) {
                throw new FamilyMemberValidationException(sprintf('ERROR: No %s without a mum and a dad.', $familyMember->getName()));
            }
        }

        return true;
    }
}