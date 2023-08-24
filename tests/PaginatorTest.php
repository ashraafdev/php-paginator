<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use AshraafDev\PhpPaginator\Paginator;
use AshraafDev\PhpPaginator\Misc;
use PHPUnit\Framework\Attributes\DataProvider;

require __DIR__ . '/../vendor/autoload.php';

class PaginatorTest extends TestCase
{

    protected $paginatorMock;

    protected function setUp(): void
    {
        

        //$this->paginatorMock = new Paginator([1, 2, 3, 4, 5, 6, 7], 2);
        $this->paginatorMock = $this->getMockBuilder(Paginator::class)
            ->setConstructorArgs([
                [1, 2, 3, 4, 5, 6, 7, 8, 9], 2
            ])
            ->getMock();

        $this->paginatorMock->method('middleware')->willReturn([
            'host' => 'localhost',
            'path' => 'test',
            'page' => 1,
        ]);


    }

    public static function paginatorDataProvider(): array
    {
        $data = [
            [1, 2, 3, 4, 5, 6, 7],
            //['d', 's', 'e', 'c', 'r'],
            //['tomas', 'abdelkader', 'test test', '9adooor', 'mbarek', 'flaaan'],
        ];

        $count = [
            7, // 5, 6,
        ];

        return [
            [1, 2, 3, 4, 5, 6, 7],
        ];
    }
}
