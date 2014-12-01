<?php
namespace Router;

class Router implements \Countable{
    private $routes=[];
    
    public function count(){
        return count($this->routes);
    }
    /**
     * 
     * @param array $array
     * @throws \RuntimeException
     */
    public function addRoute(array $array){
        foreach($array as $k=>$v){
            if(!empty($this->routes) && !empty($this->routes[$k])){
                throw new \RuntimeException(sprintf('Cannot override route "%s".', $k));
            }
            $this->routes[$k]=$v;
        }
    }
    /**
     * 
     * @param type $url
     * @return type
     * @throws Exception
     */
    public function getRoute($url){
        foreach($this->routes as $v){
            $check=preg_match("/^" . $v['pattern'] . "$/", $url, $matches);
            if(!$check){
                continue;
            }
            $connect=explode(':', $v['connect']);
            $array=[
                'controller' => $connect[0],
                'action' => $connect[1]
            ];
            if(!empty($v['params'])){
                $array['params']=$this->getParams(explode(',',$v['params']), $matches);
            }
            return $array;
        }
        throw new \RuntimeException('404');
    }
    /**
     * 
     * @param type $inputParam
     * @param array $matches
     * @return array
     */
    protected function getParams(array $arrayParam, array $matches){
        $params=[];
        foreach($arrayParam as $v){
            $params[$v]=$matches[$v];
        }
        return $params;
    }
}