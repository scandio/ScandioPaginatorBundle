<?php
namespace Scandio\PaginatorBundle\Factory;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Scandio\PaginatorBundle\Service\Paginator;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Request;

class PaginatorFactory
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @var \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface
     */
    private $templating;

    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    private $request;

    public function __construct(Router $router, EngineInterface $templating, Request $request)
    {
        $this->router = $router;
        $this->templating = $templating;
        $this->request = $request;
    }

    /**
     * @return \Scandio\PaginatorBundle\Service\Paginator
     */
    public function create()
    {
        return new Paginator($this->router, $this->templating, $this->request->get('_route'));
    }
}