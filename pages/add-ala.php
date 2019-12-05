<?php
require_once("./model/ala.php");

$ala = new Ala;

//var_dump($ala);

if (!$ala->getEspecialidade()->listAll()) {
    erro("Não existem especialidade cadastradas! 
    <br>
    <a href='index.php?p=especialidade'>
        <button class='btn btn-primary'>Cadastrar Especialidades</button>
    </a>");
    //header("Location: index.php?p=especialidade");
} else {

    if (!empty($_POST)) {
        var_dump($_POST);
        $ala->setNome($_POST['nome']);
        $ala->setQuant_leitos($_POST['leitos']);
        $ala->getEspecialidade()->setID($_POST['especiadidade']);
        $ala->add();
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
        <h2>Formulario da Ala</h2>
        <form method="post" class="">
            <div class="form-group">
                <label for="nome">Nome da Ala</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="leitos">Quantidade de Leitos</label>
                <input type="number" class="form-control" id="leitos" name="leitos" value='<?= $ala->getQuant_leitos() ?>' required>
            </div>

            <div class="form-group">
                <label for="especialidade">Especialidade</label>
                <select class="form-control" id="especialidade" name="especialidade">
                    <?php
                        foreach ($ala->getEspecialidade()->listAll() as $e) {
                            echo "<option value='$e->id_especialidade'>$e->nome";
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
                <th> Leitos </th>
                <th> Estado </th>
                <th> <i class="fas fa-trash-alt"></i> </th>
            </tr>
            <?php
                foreach ($ala->listAll() as $a) {
                    echo "
                <tr>
                    <td> $a->id_ala </td>
                    <td> $a->nome </td>
                    <td> $a->leitos </td>
                    <td>";
                    echo ($a->ativo) ? "Ativa" : "Inativa";
                    echo "
                </td>
                    <td> <a href='index.php?p=ala&acao=remover&id=$a->id_ala&dados=$a->ativo'> <i class='fas fa-trash-alt'></i> </a> </td>
                </tr>";
                }
                ?>
        </table>
    </section>

<?php } ?>