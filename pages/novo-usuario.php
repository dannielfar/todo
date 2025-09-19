<h1>Novo Usuario</h1>

<form action="?page=salvar" method="POST">
    <input type="hidden" name="acao" value="cadastrar">
    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="nome" class="form-control">
    </div>
    <div class="mb-3">
        <label>E-mail</label>
        <input type="email" name="email" class="form-control">
        <div id="emailHelp" class="form-text">Nunca iremos compartilhar seu email.</div>
    </div>
        <div class="mb-3">
        <label>Telefone</label>
        <input type="number" name="telefone" class="form-control">
    </div>
        <div class="mb-3">
        <label>Senha</label>
        <input type="password" name="senha" class="form-control">
    </div>
        <div class="mb-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>