<?php
class Especialidade
{
    private $id_especialidade;
    private $nome;
    private $valor_dia;
    private $ativo = true;

    //ID --------------------------------
    public function getId()
    {
        return $this->id_especialidade;
    }

    public function setId($id)
    {
        $this->id_especialidade = $id;
    }

    //Nome ------------------------------
    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    //Valor ----------------------------
    public function getValor_dia()
    {
        return $this->valor_dia;
    }

    public function setValor_dia($valor_dia)
    {
        $this->valor_dia = $valor_dia;
    }

    //Ativo ------------------------------
    public function getAtivo()
    {
        return $this->ativo;
    }

    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;

        return $this;
    }

    // CRUD ---------------------------------
    function add()
    {
        try {
            $sql = "insert into especialidade (nome, valor_dia)
            values (:nome, :valor);";
            require_once("dao.php");
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":nome", $this->nome);
            $stman->bindParam(":valor", $this->valor_dia);
            $stman->execute();
            aviso("Cadastrado!");
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                erro("Dados ja cadastrados!");
            } else {
                erro("Erro ao cadastrar! " . $e->getMessage());
            }
        }
    }

    function listAll()
    {
        $result = null;
        try {
            $sql = "select * from especialidade";
            require_once("dao.php");
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->execute();
            $result = $stman->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            erro("Erro ao listar todos! " . $e->getMessage());
        }
        return $result;
    }

    function get($id)
    {
        $result = null;
        try {
            $sql = "select * from especialidade e where e.id_especialidade = :id;";
            require_once("dao.php");
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":id", $id);
            $stman->execute();
            $result = $stman->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            erro("Erro ao listar a especialidade! " . $e->getMessage());
        }
        return $result;
    }

    function update()
    {
        $result = null;
        try {
            $sql = "
            UPDATE especialidade SET
            nome = :nome,
            valor_dia = :valor,
            ativo = :ativo
            WHERE especialidade.id_especialidade = :id;";

            require_once("dao.php");
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":id", $this->id_especialidade);
            $stman->bindParam(":nome", $this->nome);
            $stman->bindParam(":valor", $this->valor_dia);
            $stman->bindParam(":ativo", $this->ativo);
            $stman->execute();
            $result = $stman->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            erro("Erro ao Atualizar! " . $e->getMessage());
        }
        return $result;
    }

    function remove($id, $dados)
    {
        $result = null;
        try {
            $sql = "
            UPDATE especialidade SET
            ativo = :ativo
            WHERE especialidade.id_especialidade = :id";

            require_once("dao.php");
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":id", $id);
            $stman->bindParam(":ativo", $dados);
            $stman->execute();
            $result = $stman->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            erro("Erro ao remover! " . $e->getMessage());
        }
        return $result;
    }
}
