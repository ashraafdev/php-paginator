<?php

namespace AshraafDev\PhpPaginator;

use Misc;

require __DIR__ . '/../vendor/autoload.php';

class Paginator
{

    public $data,
        $countPerPage,
        $currentPage,
        $sumPages,
        $totalData,
        $config;

    public function __construct(array $data, int $countPerPage)
    {
        $this->data = $data;
        $this->countPerPage = $countPerPage;
        $this->totalData = count($data);
        //$this->sumPages = (is_float($this->totalData / $this->countPerPage) ? floor($this->totalData / $this->countPerPage) : ($this->totalData / $this->countPerPage) - 1);
        $this->sumPages = ceil($this->totalData / $this->countPerPage);
    }

    protected function getData(): array
    {
        return array_slice($this->data, ($this->currentPage) * $this->countPerPage, $this->countPerPage);
    }

    public function getLinks()
    {
        $config = $this->middleware();

        $this->currentPage = $config['page'];

        /*
            return [
                'ID' => $item,
                'Link' => $config['host'] . '/' . $config['path'] . '?page=' . $item,
                'Disabled' => false,
                'isCurrentPage' => ($config['page'] == $item) ? true : false,
                ];
        */

        $range = range(1, $this->sumPages); // create a range of links, first just numbers between 1 and Count of Pages
        
        if (count($range) >= 5) {
            $links = array_slice($range, ((count($range) - $this->currentPage < 5) ? count($range) - 5 : ($this->currentPage - 1)), 5);
            
            $copyLinks = $links;

            foreach ($copyLinks as $key => $value) {
                // parse float value to integer
                $value = intval($value);
                
                $idInLink = array_filter($links, function ($currentValue) use ($value) {
                    return intval($currentValue) == $value;
                });
                
                $linksKey = array_keys($idInLink)[0];

                $links[$linksKey] = [
                    'ID' => $value,
                    'Link' => $config['host'] . '/' . $config['path'] . '?page=' . $value,
                    'Disabled' => false,
                    'isCurrentPage' => ($config['page'] == $value) ? true : false,
                ];
        
                if ($key == 0 && $value >= 2) {

                    if ($value > 2) {
                        array_unshift($links, [
                            'ID' => '...',
                            'Link' => null,
                            'Disabled' => true,
                        ]);
                    }

                    array_unshift($links, [
                        'ID' => 1,
                        'Link' => $config['host'] . '/' . $config['path'] . '?page=' . 1,
                        'Disabled' => false,
                        'isCurrentPage' => ($config['page'] == $value) ? true : false,
                    ]);

                } else if ($key == count($copyLinks) - 1 && $value <= $range[count($range) - 2]) {
                   
                    if ($value < $range[count($range) - 2]) {
                        $links[] = [
                            'ID' => '...',
                            'Link' => null,
                            'Disabled' => true,
                        ];
                    }
                

                    $links[] = [
                        'ID' => intval($range[count($range) - 1]),
                        'Link' => $config['host'] . '/' . $config['path'] . '?page=' . $range[count($range) - 1],
                        'Disabled' => false,
                        'isCurrentPage' => ($config['page'] == $value) ? true : false,
                    ];
                }
            }
        }

        return isset($links) ? $links : $range;
    }

    // method that return an array of current host and path and also check if the current page number is set, if not it will give 1 to it
    public function middleware(): array
    {
        return [
            'host' => $_SERVER['HTTP_HOST'],
            'path' => explode('?', $_REQUEST['REQUEST_URI'])[0],
            'page' => (isset($_GET['page']) && is_int($_GET['page']) && intval($_GET['page']) > 0) ? intval($_GET['page']) : 1,
        ];

        /*return [
            'host' => 'localhost',
            'path' => 'haha',
            'page' => 5,
        ];*/
    }

    public function launch(): array
    {

        $this->config = $this->middleware();
        $this->currentPage = $this->config['page'];
        
        return [
            $data = $this->getData(),
            $links = $this->getLinks(),
        ];
    }
}
