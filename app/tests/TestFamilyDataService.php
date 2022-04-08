<?php

use \PHPUnit\Framework\TestCase;
use App\Component\Database\Result;
use App\Service\FamilyDataService;

class TestFamilyDataService extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function testCalculateWithResults(array $results, array $expected)
    {
        $resultMock = $this
            ->getMockBuilder(Result::class)
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $resultMock
            ->method('getData')
            ->willReturn($results)
        ;

        $data = FamilyDataService::calculate($resultMock);

        $this->assertEquals($data, $expected);
    }

    /**
     * @dataProvider provider
     */
    public function testCalculateWithoutResults(array $results, array $expected)
    {
        $resultMock = $this
            ->getMockBuilder(Result::class)
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $resultMock
            ->method('getData')
            ->willReturn([])
        ;

        $data = FamilyDataService::calculate($resultMock);

        $this->assertEquals($data, $expected);
    }

    public function provider()
    {
        return [
            [
                'results' => [
                    [1, 1]
                ],
                'expected' => [
                    'members' => [],
                    'total_members' => 0,
                    'total_spendings' => 0
                ]
            ]
        ];
    }
}