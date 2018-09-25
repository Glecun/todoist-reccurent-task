<?php

class TodoistDao {
    var $token;
    var $toProject;
    var $urlAdd;
    var $urlGet;

    public function __construct() {
        $this->token = "[YOUR-TOKEN]";
        $this->toProject = '[YOUR-PROJECT]';
        $this->urlAdd  = "https://todoist.com/api/v7/quick/add ";
        $this->urlGet  = "https://todoist.com/api/v7/items/get";
    }

    function addTask($task){
        $post_data = [
            'token' => $this->token,
            'text' => $task['name'].' '.$task['date'].' '.$this->toProject,
            'note' => $task['comment']
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->urlAdd);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $output = curl_exec($ch);
        curl_close($ch);

        return json_decode($output);
    }

    function getTask($id) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->urlGet."?token=".$this->token."&item_id=".$id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output);
    }

}