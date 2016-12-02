<?php
header('Access-Control-Allow-Origin: *');
include_once 'workflow/Workflow.php';
include_once 'rest_activities/hottelcity.php';

$origin = filter_input(INPUT_GET, "q");

$workflow = new Workflow(new HotelcityActivity($origin));
$result = $workflow->runWorkflow();
//echo "<pre>"; print_r($result); die;
$res = reset($result);
if(isset($res["Hotelcityres"]))
{	
	$result = $res["Hotelcityres"];
	if(isset($result->Response))
	{
		$nextresult = $result->Response;	
		$data = $nextresult->grouped;	
		$key = 'category:AIR';
		if(isset($data->$key))
		{
			$datanext = $data->$key;
			
			if(isset($datanext->doclist))
			{
				$dataNext = $datanext->doclist;
				if(isset($dataNext->docs))
				{
					//echo "<pre>"; print_r($dataNext->docs); die;
					$responseArrayName = array();
					foreach ($dataNext->docs as $key => $value) 
					{
						$id = isset($value->id)?$value->id:"";
						$name = isset($value->name)?$value->name:"";
						$city = isset($value->city)?$value->city:"";
						$state = isset($value->stateName)?$value->stateName.", ":"";
						$country = isset($value->countryName)?$value->countryName:"";

						//$responseArrayName[$key]= $id." - ".$name.", ".$city.", ".$state.", ".$country;
						$responseArrayName[$key]= $city." (".$id."), ".$state.$country.", (".$name.")";
					}

					echo json_encode($responseArrayName); die;
				}
			}
		}
	}	
}

echo json_encode(array()); die;
die;
ob_start();
var_dump($result); die;
$dump = ob_get_clean();
echo $dump;
flush();
