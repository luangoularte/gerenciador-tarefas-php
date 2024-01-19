<?php 

session_start();

if (isset($_POST["task_name"])) {
    if ($_POST["task_name"] != ""){

        $data = [
            "task_name" => $_POST['task_name'],
            "task_description" => $_POST["task_description"],
            "task_date" => $_POST["task_date"]
        ];

        array_push($_SESSION["tasks"], $data);
        unset($_POST["task_name"]);
        unset($_POST["task_description"]);
        unset($_POST["task_date"]);

        var_dump($_SESSION["tasks"]);

    } else {
        $_SESSION["message"] = "O campo nome da tarefa não pode ser vazio!";
    }
}

?>