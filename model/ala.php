<?php
require_once("especialidade.php");

class Ala
{
    private $id_ala;
    private $hospital;
    private $especialidade;
    private $nome;
    private $quant_leitos;
    private $ativo;


    public function __construct()
    {
        $this->especialidade = new Especialidade;
        $this->hospital = new Especialidade;
        $this->quant_leitos = 1;
        $this->ativo = true;
    }

    // GETs e SETs ---------------------------------------------
    public function getId_ala()
    {
        return $this->id_ala;
    }

    public function setId_ala($id_ala)
    {
        $this->id_ala = $id_ala;
        return $this;
    }

    public function getEspecialidade()
    {
        return $this->especialidade;
    }

    public function setEspecialidade(Especialidade $especialidade)
    {
        $this->especialidade = $especialidade;
        return $this;
    }

    public function getQuant_leitos()
    {
        return $this->quant_leitos;
    }

    public function setQuant_leitos($quant_leitos)
    {
        $this->quant_leitos = $quant_leitos;
        return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function getHospital()
    {
        return $this->hospital;
    }

    public function setHospital( Hospital $hospital)
    {
        $this->hospital = $hospital;
        return $this;
    }

    public function getAtivo()
    {
        return $this->ativo;
    }

    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
        return $this;
    }


    // CRUD -------------------------------------------------
    function add()
    {
        try {
            $sql = "
            insert into ala (fk_id_hospital,fk_id_especialidade,quant_leitos) 
            values (:id_hospital, :id_especialidade, :leitos);
            ";
            require_once("dao.php");
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":especialidade", $this->nome);
            $stman->bindParam(":valor", $this->valor_dia);
            $stman->execute();
            $stman->execute();
            aviso("Cadastrado!");
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                erro("Dados ja cadastrados!");
            } else {
                erro("Erro ao cadastrar! " . $e->getCode());
            }
        }
    }


    function listAll()
    {
        $result = null;
        try {
            $sql = "select * from ala";
            require_once("dao.php");
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->execute();
            $result = $stman->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            erro("Erro ao listar! " . $e->getMessage());
        }
        return $result;
    }


    function get($id)
    {
        $result = null;
        try {
            $sql = "select * from ala a where a.id_ala = :id;";
            require_once("dao.php");
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":id", $id);
            $stman->execute();
            $result = $stman->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            erro("Erro ao listar a ala! " . $e->getMessage());
        }
        return $result;
    }


    function update()
    {
        $result = null;
        try {
            $sql = "
            UPDATE ala a SET
            fk_id_especialidade = :especialidade,
            fk_id_hospital = :hospital,
            nome = :nome,
            quant_leitos = :leitos,
            ativo = :ativo
            WHERE a.id_ala = :id;";

            require_once("dao.php");
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":id", $this->id_ala);
            $stman->bindParam(":especialidade", $this->especialidade->id_especialidade);
            $stman->bindParam(":hospital", $this->hospital->id_hospital);
            $stman->bindParam(":nome", $this->nome);
            $stman->bindParam(":leitos", $this->quant_leitos);
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
            UPDATE ala SET
            ativo = :ativo
            WHERE ala.id_ala = :id";

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

   // START TRANSACTION;
    // insert into ala 
    // (ala.fk_id_hospital,ala.fk_id_especialidade, ala.nome, ala.quant_leitos) 
    // values (1, 1, "B", 123);
    // COMMIT;
    // #ROLLBACK;
