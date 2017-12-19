<?php
ini_set('display_errors',1);

/*** Confs ***/
$token = "[YOUR_TOKEN]";
$toProject = '[YOUR_PROJECT]';
$url = "https://todoist.com/api/v7/quick/add ";
$tomorrow='dem';

/*** Tasks ***/
$tasks = array (
    array(
		"nom" => "A task",
		"note" => "",
		"valide" => true,
		"tempo" => 7,
		"startDate" => '07-11-2017'
	),
	array(
		"nom" => "Another task",
		"note" => "with desription",
		"valide" => true,
		"tempo" => 15,
		"startDate" => '19-12-2017'
	)
);

/*** Script ***/
function addTask($content, $note){
    global $token, $url,$tomorrow,$toProject;
	
	$post_data = [
		'token' => $token,
		'text' => $content.' '.$tomorrow.' '.$toProject,
		'note' => $note
	];

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	$output = curl_exec($ch);
	curl_close($ch);
	
	return $output;
}

function isTaskTomorrow($startDate, $tempo){
	$days = (int)floor((strtotime("tomorrow")- strtotime($startDate) )/ (60 * 60 * 24));
	$occurence = $days/$tempo;
	$isTaskTomorrow = is_int($occurence);
	if($isTaskTomorrow)
		echo 'Occurrence numero '.$occurence;
	return $isTaskTomorrow;
}

foreach ($tasks as $task){
	if($task['valide']){
	    echo 'Tache '.$task['nom'].' : ';
		if(isTaskTomorrow($task['startDate'],$task['tempo'])){
			$output = addTask($task['nom'], $task['note']);
			$resArr = array();
			$resArr = json_decode($output);
			echo "<pre>"; print_r($resArr); echo "</pre>";
		} else {
			echo 'Pas demain';
		}
		echo'<br/>';
	}
}
?>

