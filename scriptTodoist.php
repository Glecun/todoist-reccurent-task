<?php
ini_set('display_errors',1);
include_once('dao/TaskDao.php');
include_once('dao/TodoistDao.php');
include_once('service/MailService.php');

$taskDao = new TaskDao();
$todoistDao = new TodoistDao();
$mailService = new MailService();

$tasks = $taskDao->findAllValidTasks();

foreach ($tasks as $task) {
    echo 'Tache '.$task['name'].' : ';

    $now = date('Y-m-d');
    if ($task['lastid']==null || $task['date']==null){
    	$task['date'] = "auj";
    	newTask($todoistDao, $task, $mailService, $taskDao);
	} else {
		$taskTodoist = $todoistDao->getTask($task['lastid']);
		if ($taskTodoist->item->checked == 1){
            $task['date'] = date('Y-m-d', strtotime($taskTodoist->date_completed. ' + '.$task['tempo'].' days'));
            newTask($todoistDao, $task, $mailService, $taskDao);
            echo "crée pour le ".$task['date'].'<br/>';
		} else {
			echo "en cours <br/>";
		}
	}
}

function newTask($todoistDao, $task, $mailService, $taskDao) {
    $output = $todoistDao->addTask($task);
    if (!($output === NULL || empty ($output))) {
        $task['lastid'] = $output->id;
        $task['date'] = $output->date_added;
        $taskDao->updateTask($task);
    } else {
        $mailService->sendMail("ScriptRecurrentTaskTodoist", "[Todoist] Erreur Api Todoist", "Erreur Api Todoist - Add Task", "");
    }
}
?>

