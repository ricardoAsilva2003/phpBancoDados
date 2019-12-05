<div class="container">
    <form method="POST">
        <div class="form-group">
            <label for="cep">CEP</label>
            <input type="text" class="form-control" id="cep" name="cep" onblur="pesquisacep(this.value)" maxlength="9" require>
        </div>
        
        <div class="form-group">
            <label for="logradouro">Endereço</label>
            <input type="text" class="form-control" id="logradouro" name="logradouro" require>
        </div>
        <div class="form-group">
            <label for="bairro">Bairro</label>
            <input type="text" class="form-control" id="bairro" name="bairro" require>
        </div>
        <div class="form-group">
            <label for="cidade">Cidade</label>
            <input type="text" class="form-control" id="cidade" name="cidade" require>
        </div>

        <div class="form-group">
            <label for="uf">Estado</label>
            <input type="text" class="form-control" id="uf" name="uf" maxlength="2" require>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <button type="reset" class="btn btn-primary">Cancelar</button>
    </form>
</div>
<script src="js/viacep.js"></script>
<?php
if (!empty($_POST)) {
    require_once("./model/endereco.php");
    $endereco = new Endereco;
    $endereco->cep = $_POST['cep'];
    $endereco->logradouro = $_POST['logradouro'];
    $endereco->cidade = $_POST['cidade'];
    $endereco->bairro = $_POST['bairro'];
    $endereco->uf = $_POST['uf'];
    $endereco->add();
}
