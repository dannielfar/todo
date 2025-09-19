<?php

if (!isset($_SESSION['id'])) {

    echo "<h1>Você precisa estar logado para acessar essa página. <a href='login.php'>Clique aqui para fazer login</a></h1>";
    exit; 
}





function getTasks($conn) {
    $sql = "SELECT * FROM todo WHERE status = '1' AND client_id = '" . $_SESSION['id'] . "' ORDER BY creat_time DESC";
    return mysqli_query($conn, $sql);
}





?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Tarefas</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Minhas Tarefas</h1>

        <!-- Formulário para criar nova tarefa -->
        <div class="mb-4">
            <form action="?page=salvar" method="POST">
                <!-- Campo oculto para enviar a ação 'criar' -->
                <input type="hidden" name="acao" value="criar">
                
                <div class="input-group">
                    <input type="text" class="form-control" name="task_description" placeholder="Nova tarefa" required>
                    <button class="btn btn-primary" type="submit" name="new_task">Criar Nova Tarefa</button>
                </div>
            </form>
        </div>

        <h3>Tarefas Pendentes</h3>
        <div class="list-group">
            <?php
         
            $tasks = getTasks($conn);
            if (mysqli_num_rows($tasks) > 0) {
                while ($task = mysqli_fetch_assoc($tasks)) {
                    echo '<div class="list-group-item d-flex justify-content-between align-items-center">';
                    echo $task['todo_name'];

                    echo '<div>';
                    echo '<form action="?page=salvar" method="POST" style="display:inline-block;">
                            <input type="hidden" name="acao" value="done">
                            <input type="hidden" name="task_id" value="' . $task['id'] . '">
                            <button type="submit" class="btn btn-success btn-sm">Feita</button>
                        </form>';

                
                    echo '<form action="?page=salvar" method="POST" style="display:inline-block;">
                            <input type="hidden" name="acao" value="delete">
                            <input type="hidden" name="task_id" value="' . $task['id'] . '">
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "<p>Nenhuma tarefa pendente no momento.</p>";
            }
            ?>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
