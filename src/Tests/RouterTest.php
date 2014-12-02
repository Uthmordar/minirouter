<?php
/*namespace Tests;
    
use Router\Router;
use Symfony\Component\Yaml\Yaml;
class RouterTest extends \PHPUnit_Framework_TestCase{
    protected $router;
   
    public function setUp(){
        $this->router = new Router;
    }
   
    public function assertPreConditions(){
        $this->assertEquals(0, count($this->router));
    }
   
    public function testAddRoute(){
        $this->router->addRoute(Yaml::parse(__DIR__.'/Fixtures/routes.yml'));
        $this->assertEquals(2, count($this->router));
    }
    
    public function testRedefRouteException(){
        $this->router->addRoute(Yaml::parse(__DIR__ . '/Fixtures/routes.yml'));
        $this->setExpectedException('RuntimeException', 'Cannot override route "BlogController_index".');
        $this->router->addRoute(Yaml::parse(__DIR__ . '/Fixtures/routes2.yml'));
    }
    
    public function testUrlBlogControllerShowId(){
        // on ajoute les def des routes à la classe Routes
        $this->router->addRoute(Yaml::parse(__DIR__ . '/Fixtures/routes.yml'));
        $id = 0;
        $urls=Yaml::parse(__DIR__ . '/Fixtures/urls.yml') ;
        foreach($urls['BlogController_show'] as $url){
            $this->assertEquals(json_encode([
                'controller' => 'Controllers\BlogController',
                'action' => 'show',
                'params' => [
                    'id' => (string) ++$id
                ]
            ]), json_encode($this->router->getRoute($url)));
        }
    }
    
    public function testNoUrl(){
        // on ajoute les def des routes à la classe Routes
        $this->router->addRoute(Yaml::parse(__DIR__ . '/Fixtures/routes.yml'));
        $id = 0;
        $urls=Yaml::parse(__DIR__ . '/Fixtures/urls.yml') ;
        $this->setExpectedException('RuntimeException', '404');
        foreach($urls['404'] as $url){
            $this->router->getRoute($url);
        }
    }
}*/