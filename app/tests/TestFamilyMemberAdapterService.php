<?php

use PHPUnit\Framework\TestCase;
use App\Service\Adapter\FamilyMemberAdapterService;
use App\Entity\FamilyMember;

class TestFamilyMemberAdapterService extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function testArrayToEntity(array $familyMemberArray): void
    {
        $familyMemberModel = (new FamilyMember())
            ->setId(1)
            ->setRole('test')
            ->setCost(100)
            ->setName('test')
        ;

        $familyMember = FamilyMemberAdapterService::arrayToEntity($familyMemberArray);

        $this->assertEquals($familyMember, $familyMemberModel);
    }

    public function provider()
    {
        return [
            [
                'familyMemberArray' => [
                    'id' => 1,
                    'role' => 'test',
                    'cost' => 100,
                    'name' => 'test'
                ]
            ]
        ];
    }

}