<?php
$data = array ( "request" => array(
            "passengers" => array( 
                    adultCount => 1
                        ),
                    "slice" => array( 
                            array(
                                origin => "BOS",
                                destination => "LAX",
                                date => "2014-09-09"),
                            array(
                                origin => "LAX",
                                destination => "BOS",
                                date => "2014-09-10"),
                            ),
                                solutions => "1"
                            ),                   
             );                                                                                   
$data_string = json_encode($data);
$ch = curl_init('https://www.googleapis.com/qpxExpress/v1/trips/search?key=2899cd9b18a440029d811f3d77e45c4fc09fb0b8');                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));                                                                                                                   

$result = curl_exec($ch);
curl_close($ch);

/* then I echo the result for testing purposes */

echo $result;

?>