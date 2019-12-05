<?php
require_once("./model/especialidade.php");
$especialidade = new Especialidade;

if (!empty($_POST)) {
    $especialidade->setNome($_POST['especialidade']);
    $especialidade->setValor_dia($_POST['valor']);
    $especialidade->add();
}

if (!empty($_GET['acao'])) {
    if ($_GET['acao'] == "remover") {
        var_dump($_GET);
        if ($_GET['dados'])
            $ativo = 0;
        else
            $ativo = 1;
        $especialidade->remove($_GET['id'], $ativo);
        header("Location: index.php?p=especialidade");
    }
}
?>

<section class="container">
    <h2>Formulario da Especialidade</h2>
    <form method="post" class="container">
        <div class="form-group">
            <label for="especialidade">Nome da Especialidade</label>
            <input type="text" class="form-control" id="especialidade" name="especialidade" required>
        </div>
        <div class="form-group">
            <label for="valor">Valor do dia</label>
            <input type="number" class="form-control" id="valor" name="valor" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <button type="reset" class="btn btn-primary">Cancelar</button>
    </form>
</section>

<section class="container">
    <table class="table">
        <tr>
            <th> ID </th>
            <th> Nome </th>
            <th> Valor Dia </th>
            <th> Estado </th>
            <th> <i class="fas fa-trash-alt"></i> </th>
        </tr>
        <?php
        require_once("./model/especialidade.php");
        $especialidade = new Especialidade;
        foreach ($especialidade->listAll() as $esp) {
            echo "
                <tr>
                    <td> $esp->id_especialidade </td>
                    <td> $esp->nome </td>
                    <td> $esp->valor_dia </td>
                    <td>";
            echo ($esp->ativo) ? "Ativa" : "Inativa";
            echo "
                </td>
                    <td> <a href='index.php?p=especialidade&acao=remover&id=$esp->id_especialidade&dados=$esp->ativo'> <i class='fas fa-trash-alt'></i> </a> </td>
                </tr>";
        }
        ?>
    </table>
</section>