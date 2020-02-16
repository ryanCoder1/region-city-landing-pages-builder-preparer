<!-- retrieve data from file to create a list and find random number testing time.
then link to 10 csv files with 100 test results in each file.
Written by: Ryan Lackey
Date: 1/30/19
-->

<?php
if(isset($_GET['fileName'])){


$fileName = $_GET['fileName'];
$file = fopen($fileName . '.txt', 'r');
if($file){
  $count = 0;
  $array = [];
  while(($buffer = fgets($file)) !== false){

    $array[$count] = $buffer;
    $count++;
  }

  if(!feof($file)){
    echo "Error: End of file";
  }
  fclose($file);
  $zipcodes = array();
  // break array[0] string into indexed array at ','
  $zipcodes = explode(',', $array[0]);

  function getApiCityState($zipcodes){

    $countZips = count($zipcodes);
    $stateCity = array();
    // loop through all zipcodes in array retrieving state/city from google geocode api
    for($i = 0; $i < $countZips; $i++){
      // google map geocode api url
      $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$zipcodes[$i]}&key=PROVIDE_YOUR_KEY_HERE";

      // get the json response
      $resp_json = file_get_contents($url);

      // decode the json
      $resp = json_decode($resp_json, true);

      if($resp['status'] == 'OK'){
        // if = the results in the ['address_component'] vary so the [5] is tested for ['short_name'] 'US'. Meaning that the [4] has the state, city info
       // elseif  = the results in the ['address_component'] vary so the [4] is tested for ['short_name'] 'US'. Meaning that the [3] has the state, city info
        if($resp['results'][0]['address_components'][5]['short_name'] == 'US'){
              array_push($stateCity, $resp['results'][0]['address_components'][4]['long_name']. ', '. $resp['results'][0]['address_components'][1]['long_name'] .PHP_EOL);
          }

      elseif($resp['results'][0]['address_components'][4]['short_name'] == 'US'){
              array_push($stateCity, $resp['results'][0]['address_components'][3]['long_name']. ', '. $resp['results'][0]['address_components'][1]['long_name'] .PHP_EOL);
          }


    }
  }
  // run array_unique to remove duplicate cities
  $uniqueStateCity = array_unique($stateCity);

  return $uniqueStateCity;
  }

// run the function with the zipcodes
$stateCityArray = getApiCityState($zipcodes);


  $countCities = count($stateCityArray);

    // loop 10 times thru different files with the same name incrementing by 1 each time.
        for($j = 0; $j <= $countCities; $j++){
              $file = fopen($fileName .'write.txt', 'a');
              fwrite($file, $stateCityArray[$j]);
            }

      fclose($file);
      echo "File created!";
   }else{
     echo "File can not be found!";
   }
}
?>
