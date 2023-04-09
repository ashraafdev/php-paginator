<?php 

namespace Tests;

use PHPUnit\Framework\TestCase;
use AshraafDev\PhpPaginator;
use AshraafDev\PhpPaginator\Paginator;

require __DIR__ . '/../vendor/autoload.php';

class PaginatorTest extends TestCase {

    protected $paginator;

    public static function paginatorDataProvider(): array
    {
        $data = [
            [1, 2, 3, 4, 5, 6 ,7],
            ['d', 's', 'e', 'c', 'r'],
            ['tomas', 'abdelkader', 'test test', '9adooor', 'mbarek', 'flaaan'],
        ];

        return [
            $data[rand(0, 2)],
            rand(0, 3),
        ];
    }

    /*protected function setUp(): void
    {
        $this->paginator = new Paginator();
    }*/

}
?>