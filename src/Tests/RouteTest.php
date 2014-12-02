<?php
namespace Tests;
    
use Router\Route;
use Router\Router;
use Symfony\Component\Yaml\Yaml;

class RouteTest extends \PHPUnit_Framework_TestCase{
    protected $route;
    protected $router;
    protected $routeyml;
    protected $url;
   
    public function setUp(){
        $this->router = new Router();
        $this->routeyml = Yaml::parse(__DIR__.'/Fixtures/routes.yml');
        $this->url = Yaml::parse(__DIR__ . '/Fixtures/urls.yml');
    }
    
    public function assertPreConditions(){
        $this->assertEquals(0, count($this->router));
    }
    
    public function testAddRoute(){
        foreach($this->routeyml as $route){
            $this->router->addRoute(new Route($route));
        }
        $this->assertEquals(count($this->routeyml), count($this->router));
    }
    
    public function testAddSameRoute(){
        $array=[
            'pattern' => '\/[a-zA-Z0-9\-_]+\/(?P<id>[1-9][0-9]*)',
            'connect' => 'Controllers\BlogController:show'
        ];
        $obj = new Route($array);
        $this->router->addRoute($obj);
        $this->setExpectedException('RuntimeException', 'Route already exist');
        $obj = new Route($array);
        $this->router->addRoute($obj);
    }
    
    public function testGetController(){
        foreach($this->routeyml as $route){
            $this->router->addRoute(new Route($route));
        }
        foreach($this->router as $route){
            $this->assertEquals('Controllers\BlogController', $route->getController());
        }
    }
    
    public function testGetAction(){
        foreach($this->routeyml as $route){
            $this->router->addRoute(new Route($route));
        }
        $arrayTest=['index', 'show'];
        foreach($this->router as $route){
            //$this->assertEquals('show', $route->getAction());
            $this->assertTrue(in_array($route->getAction(), $arrayTest));
        }
    }
    
    public function testNoController(){
        $array=[
                'pattern' => '\/[a-zA-Z0-9\-_]+\/(?P<id>[1-9][0-9]*)',
                'connect' => ''
            ];
        $this->setExpectedException('RuntimeException', 'Access controller novalidate');
        $this->router->addRoute(new Route($array));
    }
    
    public function testNoAction(){
        $array=[
                'pattern' => '\/[a-zA-Z0-9\-_]+\/(?P<id>[1-9][0-9]*)',
                'connect' => 'Controllers\BlogController'
            ];
        $this->setExpectedException('RuntimeException', 'Access controller novalidate');
        $this->router->addRoute(new Route($array));
    }
    
    public function testGetRoute(){
        // on ajoute les def des routes à la classe Routes
        foreach($this->routeyml as $route){
            $this->router->addRoute(new Route($route));
        }
        $id = 0;
        foreach($this->url['BlogController_show'] as $url){
            $this->assertEquals(json_encode([
                'controller' => 'Controllers\BlogController',
                'action' => 'show',
                'params' => [
                    'id' => (string) ++$id
                ]
            ]), json_encode($this->router->getRoute($url)));
        }
    }
}