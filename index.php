<?php
// Iniciar a sessão
session_start();
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
      .navbar-custom {
        background-color: #007bff;
      }
      .navbar-custom .navbar-brand, .navbar-custom .navbar-nav .nav-link {
        color: #fff;
      }
      .navbar-custom .navbar-nav .nav-link:hover {
        color: #dcdcdc;
      }
      .welcome-message {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      }
      .welcome-message a {
        font-weight: bold;
      }
      .form-control-custom {
        border-radius: 20px;
      }
      .btn-custom {
        border-radius: 20px;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-custom">
      <div class="container-fluid">

        <?php
        if (isset($_SESSION['id'])) {
            echo '
            <a class="nav-link active" aria-current="page" href="#">Seja bem-vindo: ' . $_SESSION['mail'] . '</a>';
        }
        ?>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <!-- No longer showing the "Tarefas" link since it's removed -->
          </ul>

          <!-- Botão de logout à esquerda -->
          <form class="d-flex" role="search">
            <?php
            if (isset($_SESSION['id'])) {
                echo '<a class="btn btn-outline-light btn-custom" href="?page=logout">Logout</a>';
            } else {
                echo '<a class="btn btn-outline-light btn-custom" href="?page=login_page">Login</a>';
                echo '<a class="btn btn-outline-light btn-custom ms-2" href="?page=novo">Cadastre-se</a>';
            }
            ?>
          </form>
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="row mt-5">
        <div class="col-md-8 offset-md-2">
          <?php
          include("db/config.php");
          include("functions.php");
          $user_data = check_login($conn);

          switch (@$_REQUEST["page"]) {
            case "novo":
              include("pages/novo-usuario.php");
              break;
            case "login_page":
              include("pages/login.php");
              break;
            case "salvar":
              include("db/salvar.php");
              break;
            case "login":
              include("db/salvar.php");
              break;
            case "task":
              include("pages/task.php");
              break;
            case "logout":
              session_unset();
              session_destroy();
              include("pages/login.php");
              exit;
            default:
              if (isset($_SESSION['id'])) {
                  echo "<div class='welcome-message'>
                          <h2>Bem-vindo, " . $_SESSION['mail'] . "!</h2>
                          <p>Encontre suas tarefas <a href='?page=task'>aqui</a></p>
                        </div>";
              } else {
                  echo "<div class='welcome-message'>
                          <h2>Faça o login para continuar</h2>
                        </div>";
              }
          }
          ?>
        </div>
      </div>
    </div>

    <script src="js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>
