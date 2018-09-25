<?php

class TaskDao {
    var $bdd;

    public function __construct() {
        $this->bdd = pg_connect("host=[HOST] user=[USER] password=[PASSWORD] dbname=[DBNAME]");
        if (!$this->bdd) {
            echo "Une erreur s'est produite.\n";
            exit;
        }
    }

    function findAllValidTasks(){
        $sql = "SELECT id,tasks.name,tasks.comment,tasks.valid,tasks.tempo,tasks.lastid,tasks.date FROM tasks WHERE tasks.valid=TRUE";
        $result = pg_query($this->bdd, "$sql");
        if ($result > 0) {
            $row = pg_fetch_all($result);
            return $row;
        }
    }

    function updateTask($task) {
        $sql = "UPDATE tasks SET lastid = $1, date = $2  WHERE id = $3 ;";
        $result = pg_query_params($this->bdd, "$sql", array($task['lastid'], $task['date'], $task['id']));
    }
}