<?php 
namespace Logs;

use AshraafDev\PhpPaginator\Paginator;

require __DIR__ . '/../vendor/autoload.php';

class PaginatorLogs {

    public static function launch()
    {
        $phpPaginator = new Paginator([1,2,3,4,5,6,7,8,9, 10, 11, 12, 13, 14, 15, 16], 1, 2);
        //var_dump($phpPaginator->getData());
        var_dump($phpPaginator->getLinks());
    }

}

PaginatorLogs::launch();
