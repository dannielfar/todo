<?php 
switch ($_REQUEST["acao"]) {
    case 'cadastrar':
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $mail = $_POST['email'];
        $senha = md5($_POST['senha']);

        $sql = "INSERT INTO `clientes`(`nome`, `telefone`, `status`, `mail`, `senha`) 
        VALUES ('{$nome}' ,'{$telefone}',1, '{$mail}', '{$senha}')";

        $res = $conn->query($sql);
        if($res==true){
            print "<script>alert('cadastro realizado com sucesso');</script>";
            print "<script>location.href='?page=#';</script>";
        } else{
            print "<script>alert('Não foi possível realizar o cadastro');</script>";
            print "<script>location.href='?page=#';</script>";  
        }
        break;
        case "login":
    $email = $_POST["email"];
    $senha = $_POST["senha"];
            echo "{$email} {$senha}";
    if(!empty($email) && !empty($senha)){
        echo "1";
        $query = "SELECT * from clientes where mail = '{$email}'";
        $result = mysqli_query($conn, $query);
    echo "2";
        if(mysqli_num_rows($result) > 0 && $result){
            echo "2";
            $user_data = mysqli_fetch_assoc($result);
            if($user_data['senha'] === md5($senha)){
                echo "3";
                $_SESSION['id'] = $user_data['id'];
                $_SESSION['mail'] = $user_data['mail'];
                header("Location: index.php");
                if (isset($_SESSION['id'])) {
    echo "Sessão iniciada com sucesso. O ID do usuário é: " . $_SESSION['id'];
} else {
    echo "Sessão não iniciada ou variável de sessão 'id' não definida.";
}
                die;
            } else{
                echo "4";
        echo"Usuário ou senha incorretos";
        
            }
        } else {
            echo "5";
        echo"Usuário ou senha incorretos";
        }
} else {
    echo "6";
    echo"Confirme as informações adicionadas";
}


            break;
 case 'criar':

    // Escapar a descrição da tarefa para evitar injeção SQL
    $task_description = mysqli_real_escape_string($conn, $_POST['task_description']);
    
    // Preparar a consulta
    $stmt = $conn->prepare("INSERT INTO todo (`client_id`, `todo_name`, `done_time`, `status`) VALUES (?, ?, '', '1')");
    
    // Verificar se a preparação da consulta falhou
    if ($stmt === false) {
        // Exibir erro de preparação
        echo "Erro ao preparar a consulta: " . $conn->error;
        exit;
    }
    
    // Bind dos parâmetros
    $stmt->bind_param("is", $_SESSION['id'], $task_description); // "i" para integer (client_id) e "s" para string (task_description)
    
    // Executar a consulta
    $execute_result = $stmt->execute();
    
    // Verificar se a execução foi bem-sucedida
    if (!$execute_result) {
        // Exibir erro de execução
        echo "Erro ao executar a consulta: " . $stmt->error;
        exit;
    }
    
    // Fechar a declaração após a execução
    $stmt->close();
    
    // Redirecionar para a página task.php ou exibir sucesso
    include("pages/task.php");
    break;

    case "done":
    $task_id = $_POST['task_id'];
    $update_sql = "UPDATE todo SET status = '0' WHERE id = $task_id";
    mysqli_query($conn, $update_sql);
    include("pages/task.php");
    exit;

    case "delete":

    $task_id = $_POST['task_id'];
    $delete_sql = "DELETE FROM todo WHERE id = $task_id";
    mysqli_query($conn, $delete_sql);
    include("pages/task.php");
    exit;


}
        

 ?>




    