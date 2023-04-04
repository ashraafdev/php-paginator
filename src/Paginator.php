<?php

namespace AshraafDev\PhpPaginator;

require __DIR__ . '/../vendor/autoload.php';

class Paginator
{

    public $data,
        $countPerPage,
        $currentPage,
        $sumPages,
        $totalData;

    public function __construct(array $data, int $page, int $countPerPage)
    {
        $this->data = $data;
        $this->countPerPage = $countPerPage;
        $this->currentPage = $page;
        $this->totalData = count($data);
        $this->sumPages = (is_float($this->totalData / $this->countPerPage) ? floor($this->totalData / $this->countPerPage) : ($this->totalData / $this->countPerPage) - 1);
    }

    public function getData(): array
    {
        return array_slice($this->data, $this->currentPage * $this->countPerPage, $this->countPerPage);
    }
}
