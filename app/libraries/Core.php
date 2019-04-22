<?php
    class Core {
        protected $controller = 'Pages';
        protected $method = 'index';
        protected $params = [];

        public function __construct() {
            $url = $this->getUrl();
            
            //Check if controller exists
            if(file_exists('../app/controllers/' . ucwords($url[0]) . 'php')) {
                // Set value as controller
                $this->controller = ucwords($url[0]);
                unset($url[0]);
            }

            // Require the new controller
            require_once '../app/controllers/' . $this->controller . '.php';   
            $this->controller = new $this->controller;

            // Check if method exists
            if(isset($url[1])) {
                $this->method = ucwords($url[1]);
                unset($url[1]);
            }
        
            // Get params
            $this->params = $url ? array_values($url) : [];

            // Call a controller class and controller method with array of params
            call_user_func_array([$this->controller, $this->method], $this->params);
        
        }
        // Get parameters from url
        public function getUrl(){
            if(isset($_GET['url'])){
              $url = rtrim($_GET['url'], '/');
              $url = filter_var($url, FILTER_SANITIZE_URL);
              $url = explode('/', $url);
              return $url;
            }
        }
    }