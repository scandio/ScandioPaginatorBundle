<?php
namespace Scandio\PaginatorBundle\Service;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class Paginator implements \Iterator
{
    private $router;
    private $limit;
    private $page;
    /**
     * @var \ArrayIterator
     */
    private $list;
    private $totalCount = 0;
    private $templateEngine;
    private $listKeys;

    private $current;

    /**
     * @param \Symfony\Bundle\FrameworkBundle\Routing\Router $router
     */
    public function __construct(Router $router, EngineInterface $templateEngine, $defaultRoute)
    {
        $this->router = $router;
        $this->templateEngine = $templateEngine;
        $this->defaultRoute = $defaultRoute;
    }

    /**
     * @param int $limit
     */
    public function setLimit($limit = 50)
    {
        $this->limit = $limit;
    }

    /**
     * @param int $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @param array $items
     */
    public function setList($items)
    {
        if (is_array($items)) {
            $iterator = new \ArrayIterator($items);
        } else {
            $iterator = $items;
        }
        $this->list = $iterator;
    }

    /**
     * @param int $totalCount
     */
    public function setTotalCount($totalCount)
    {
        $this->totalCount = $totalCount;
    }

    /**
     * @return int
     */
    public function getTotalPages()
    {
        $totalPages = 0;
        if ($this->totalCount > 0) {
            $totalPages = (int) ceil($this->totalCount/$this->limit);
        }
        return $totalPages;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        return $this->list->current();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        $this->list->next();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        return $this->list->key();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        return $this->list->valid();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->list->rewind();
    }

    /**
     * @return string
     */
    public function getPaginationBar($paginationRoute = null, array $pathParameters = array())
    {
        $parameters = array(
            'page' => $this->page,
            'limit' => $this->limit,
            'totalCount' => $this->totalCount,
            'totalPages' => $this->getTotalPages(),
            'paginationRoute' => !empty($paginationRoute) ? $paginationRoute : $this->defaultRoute,
            'pathParameters' => $pathParameters
        );
        return $this->templateEngine->render('ScandioPaginatorBundle::pagination_bar.html.twig', $parameters);
    }
}