<?php 

require __DIR__ . "/connect.php";

$stmt = $conn->prepare("SELECT * FROM tasks");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

session_start();

if (!isset($_SESSION["tasks"])) {
    $_SESSION["tasks"] = array();
}

if (isset($_GET["task_name"])) {
    if ($_GET["task_name"] != ""){
        array_push($_SESSION["tasks"], $_GET["task_name"]);
        unset($_GET["task_name"]);
    } else {
        $_SESSION["message"] = "O campo nome da tarefa não pode ser vazio!";
    }
}


?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <title>Gerenciador de Tarefas</title>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Gerenciador de tarefas</h1>
    </div>
    <div class="form">
        <form action="task.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="insert" value="insert">
            <label for="task-name">Tarefa:</label>
            <input type="text" name="task_name" placeholder="Nome da Tarefa">
            <label for="task_description">Descrição:</label>
            <input type="text" name="task_description" placeholder="Descrição da Tarefa">
            <label for="task_date">Data</label>
            <input type="date" name="task_date">
            <label for="task_image">Imagem:</label>
            <input type="file" name="task_image">
            <button type="submit">Cadastrar</button>
        </form>
        <?php 
        
        if (isset($_SESSION["message"])) {
            echo "<p style='color: #EF5350';>" . $_SESSION['message'] . "</p>";
            unset($_SESSION["message"]);
        }
        
        ?>
    </div>
    <div class="separator">

    </div>
    <div class="list-tasks"> 
        <?php 
            
                echo "<ul>";

                foreach ($stmt->fetchAll() as $task) {
                    echo "<li>
                        <a href='details.php?key=". $task["id"] ."'>". $task['task_name'] ."</a>
                        <button type='button' class='btn-clear' onclick='deletar". $task["id"] ."()'>Remover</button>
                        <script>
                            function deletar". $task["id"] ."(){
                                if (confirm('Confirmar remoção?')) {
                                    window.location = 'http://localhost:8080/cursophp/gerentarefas/task.php?key=". $task["id"] ."';
                                }
                                return false;
                            } 
                        </script>
                    </li>";
                }

                echo "</ul>";
            
        
        ?>
        
        
    </div>
    <div class="footer">
        <p>Desenvolvido por @luangoularte</p>
    </div>
</div>

</body>
</html>