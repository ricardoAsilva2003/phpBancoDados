<?php
require_once("./model/hospital.php");

$hospital = new hospital;

//var_dump($hospital);

if (!$hospital->getEndereco()->listAll()) {
    erro("Não existem endereços cadastradas! 
    <br>
    <a href='index.php?p=endereco'>
        <button class='btn btn-primary'>Cadastrar Endereço</button>
    </a>");
    //header("Location: index.php?p=especialidade");
} else {

    if (!empty($_POST)) {
        var_dump($_POST);
        $hospital->setNome($_POST['nome']);
        $hospital->setNumero($_POST['numero']);
        $hospital->setComplemento($_POST['complemento']);
        $hospital->getEndereco()->cep = ($_POST['cep']);
        $hospital->add();
    }

    if (!empty($_GET['acao'])) {
        if ($_GET['acao'] == "remover") {
            var_dump($_GET);
            if ($_GET['dados'])
                $ativo = 0;
            else
                $ativo = 1;
            $especialidade->remove($_GET['id'], $ativo);
            header("Location: index.php?p=hospital");
        }
    }
    ?>

    <section class="container">
        <h2>Formulario do Hospital</h2>
        <form method="post" class="">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="numero">Numero</label>
                <input type="text" class="form-control" id="numero" name="numero" required>
            </div>
            <div class="form-group">
                <label for="complemento">Complemento</label>
                <input type="text" class="form-control" id="complemento" name="complemento">
            </div>

            <div class="form-group">
                <label for="hospital">Hospital</label>
                <select class="form-control" id="hospital" name="cep">
                    <?php
                        foreach ($hospital->getEndereco()->listAll() as $e) {
                            echo "<option value='$e->cep'>$e->cep - $e->logradouro - $e->bairro - $e->uf";
                        }
                        ?>
                </select>
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
                <th> CEP </th>
                <th> Numero </th>
                <th> Complemento </th>
                <th> <i class="fas fa-trash-alt"></i> </th>
            </tr>
            <?php
                foreach ($hospital->listAll() as $hosp) {
                    echo "
                <tr>
                    <td> $hosp->id_hospital </td>
                    <td> $hosp->nome </td>
                    <td> $hosp->fk_cep </td>
                    <td> $hosp->numero </td>
                    <td> $hosp->complemento </td>
                    <td>";
                    echo ($hosp->ativo) ? "Ativa" : "Inativa";
                    echo "
                </td>
                    <td> <a href='index.php?p=hospital&acao=remover&id=$hosp->id_hospital&dados=$hosp->ativo'> <i class='fas fa-trash-alt'></i> </a> </td>
                </tr>";
                }
                ?>
        </table>
    </section>

<?php } ?>