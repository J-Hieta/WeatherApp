<?php 
    class MainPage {
        public function __construct() {
            $this->db = new Database();
        }
        public function getTemperature($city) {
            $temp;
            $url = "https://api.openweathermap.org/data/2.5/weather?q=".$city."&units=metric&appid=".OPENWEATHERMAP_API_KEY;

            //Sample data url
            //$url = "https://samples.openweathermap.org/data/2.5/weather?q=London,uk&appid=b6907d289e10d714a6e88b30761fae22";


            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response_json = curl_exec($ch);
            $httpResponse = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            $response = json_decode($response_json, true);

            //Get first value of array (Current temperature)
            if($httpResponse === 200) {
                foreach($response['main'] as $r) {
                    break;
                }
                if(!empty($r)) {
                    return $r;
                }
            } else {
                return 0;
            }   
        }

        // Save preferred city to database
        public function saveCity($city) {
            // Check if previous entry exists
            $this->db->query('SELECT * FROM citypref');
            $row = $this->db->singleResult();

            // Save city if no previous preference
            if($this->db->rowCount() == 0) {
                $this->db->query('INSERT INTO citypref(preferred_city) VALUES(:city)');
                $this->db->bind(':city', $city);

                // Execute
                if($this->db->execute()){
                    return true;
                } else {
                    return false;
                }
            } elseif($this->db->rowCount() > 0){
                // Update city if previous preference exists
                $this->db->query('UPDATE citypref SET preferred_city = :city');
                $this->db->bind(':city', $city);

                // Execute
                if($this->db->execute()){
                    return true;
                } else {
                    return false;
                }
            }
        }

        //Retrieve saved city from database
        public function getSavedCity() {
            $this->db->query('SELECT preferred_city FROM citypref');
            $row = $this->db->singleResult();
            return $row;
        }
    }