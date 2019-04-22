<?php
    class Pages extends Controller {
        public function __construct() {
            $this->mainModel = $this->model('MainPage');
        }

        public function index() {

            // Load saved city
            if(!isset($_GET['city'])) {
                $savedCity = $this->mainModel->getSavedCity();                
                if(!empty($savedCity)) {
                    foreach($savedCity as $c) {
                        
                        break;
                    }
                    $temp = $this->mainModel->getTemperature($c);
                    $data = [
                        'city' => $c,
                        'temp' => $temp,
                        'error' => ''
                    ];
                    if($temp != 0) {
                        $data['temp'] = $temp;
                        $this->view('index', $data);
                    }
                  
                } else {
                    $data = [
                        'city' => '',
                        'temp' => '',
                        'error' => ''
                    ];
                    $this->view('index', $data);

                }
            }

            elseif(isset($_GET['city'])) {
                $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
                $data = [
                    'city' => trim($_GET['city']),
                    'temp' => '',
                    'error' => ''
                ];
              
                $temp = $this->mainModel->getTemperature($data['city']);
                
                if($temp != 0) {
                    $data['temp'] = $temp;
                    $this->view('index', $data);
                } else {
                    $data['error'] = 'City not found';
                    $this->view('index', $data);
                }

            } else {
                $data = [
                    'city' => '',
                    'temp' => '',
                    'error' => ''
                ];
                $this->view('index', $data);
            }
            // Save or update preferred city to database.
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                if(isset($_POST['city'])) {
                     $this->mainModel->saveCity($_POST['city']);
                     $data['city'] = $_POST['city'];                     
                     echo '<div class="alert-success" id="msg-flash">'.$data['city'].' saved as preferred city</div>';
                     
                 }
            }
        }
    }