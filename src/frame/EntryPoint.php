<?php 

namespace src\frame;
use src\aplication\RoutesAplication;
class EntryPoint{
    private $route;
    private $method;
    private $routesAplicaction;

    function __construct(
        string $route,
        string $method,
        RoutesAplication $routesAplicaction
    )
    {
        $this->route = $route;
        $this->method= $method;
        $this->routesAplicaction= $routesAplicaction;
        $this->verifyRoute();
    }   

    private function verifyRoute(){

        if($this->route != strtolower($this->route)){
            http_response_code(301);
            header('location:'. strtolower($this->route));
        }
    }
    private function loadTemplate($template, $variables=[]){
        extract($variables);
        ob_start();
        include __DIR__ . '/../../views/'. $template;
        return ob_get_clean();
    }

    public function run(){
        $routes = $this->routesAplicaction->getRoutesAplication();
        $controller = $routes[$this->route][$this->method]['controller'];
        $action = $routes[$this->route][$this->method]['action'];
        if(isset($routes[$this->route]['login']) && 
        !$this->routesAplicaction->getAutentification()->validationAll()){
            header('location: /');
        }

        if(isset($routes[$this->route]['permission']) &&
        !$this->routesAplicaction->hashPermission($routes[$this->route]['permission'])){
            header('location: /no/permission');
        }


        $result = $controller->$action();
        $title = $result['title'];
        if(isset($result['variables'])){
            $content = $this->loadTemplate($result['template'],$result['variables']);
        }else{
            $content = $this->loadTemplate($result['template']);
        }

        echo $this->loadTemplate('templates/layout.html.php',[
            'title' => $title,
            'content' => $content
        ]);
    }
}

