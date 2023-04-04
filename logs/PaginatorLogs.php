<?php 
namespace Logs;

use AshraafDev\PhpPaginator\Paginator;

require __DIR__ . '/../vendor/autoload.php';

class PaginatorLogs {

    public static function launch()
    {
        $phpPaginator = new Paginator([1,2,3,4,5,6,7,8,9, 10], 2, 3);
        var_dump($phpPaginator->sumPages);
    }

}

PaginatorLogs::launch();
