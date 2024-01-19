<?php 

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

if (isset($_GET["clear"])) {
    unset($_SESSION["tasks"]);
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
            if (isset($_SESSION["tasks"])) {
                echo "<ul>";

                foreach ($_SESSION["tasks"] as $key => $task) {
                    echo "<li>
                        <span>". $task['task_name'] ."</span>
                        <button type='button' class='btn-clear' onclick='deletar$key()'>Remover</button>
                        <script>
                            function deletar$key(){
                                if (confirm('Confirmar remoção?')) {
                                    window.location = 'http://localhost:8080/cursophp/gerentarefas/task.php?key=$key';
                                }
                                return false;
                            } 
                        </script>
                    </li>";
                }

                echo "</ul>";
            }
        
        ?>
        
        <form action="" method="get">
            <input type="hidden" name="clear" value="clear">
            <button type="submit" class="btn-clear">Limpar Tarefas</button>
        </form>
    </div>
    <div class="footer">
        <p>Desenvolvido por @luangoularte</p>
    </div>
</div>

</body>
</html>