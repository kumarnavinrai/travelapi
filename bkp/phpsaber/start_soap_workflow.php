<?php
include_once 'workflow/Workflow.php';
include_once 'soap_activities/BargainFinderMaxSoapActivity.php';


$workflow = new Workflow(new BargainFinderMaxSoapActivity());
$result = $workflow->runWorkflow();

$xml = simplexml_load_string($result);
$json = json_encode($xml);
$array = json_decode($json,TRUE);

echo "<pre>";
print_r($array);
die;
/*ob_start();
echo "<pre>";
print_r($result);
$dump = ob_get_clean();
echo $dump;
flush();*/
