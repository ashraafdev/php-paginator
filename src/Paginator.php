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
        //$this->sumPages = (is_float($this->totalData / $this->countPerPage) ? floor($this->totalData / $this->countPerPage) : ($this->totalData / $this->countPerPage) - 1);
        $this->sumPages = ceil($this->totalData / $this->countPerPage);
    }

    public function getData(): array
    {
        return array_slice($this->data, ($this->currentPage - 1) * $this->countPerPage, $this->countPerPage);
    }

    public function getLinks(): array
    {
        $range = range(1, $this->sumPages); // create a range of links, first just numbers between 1 and Count of Pages
        if (count($range) > 6) {
            $links = array_slice($range, ((count($range) - $this->currentPage < 5) ? count($range) - 5: $this->currentPage), 5);
            
            if ($links[0] > 2) array_unshift($links, 1, '...',);
            else if ($links[0] == 2) array_unshift($links, 1,);

            if ($links[count($links) - 1] < $range[count($range) - 2]) array_push($links, '...', $range[count($range) - 1]);
            else if ($links[count($links) - 1] == $range[count($range) - 2]) array_push($links, $range[count($range) - 1]);
        }
        return isset($links) ? $links : $range;
    }
}
