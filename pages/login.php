<h1>Faça o login para ver suas tarefas</h1>

<form action="?page=salvar" method="POST">
    <input type="hidden" name="acao" value="login">
    <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">Nunca iremos compartilhar seu email.</div>
    </div>
    <div class="mb-3">
        <label for="senha" class="form-label">Senha</label>
        <input type="password" class="form-control" id="senha" name="senha">
    </div>
    <button type="submit" class="btn btn-primary">Logar</button>
</form>
