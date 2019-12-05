<?php
require_once("endereco.php");

class Hospital
{
    private $id_hospital;
    private $endereco;
    private $nome;
    private $numero;
    private $complemento;
    private $ativo;

    public function __construct()
    {
        $this->endereco = new Endereco;
        $this->ativo = true;
    }

    // GETs e SETs ---------------------------------------------
    public function getId_hospital()
    {
        return $this->id_hospital;
    }

    public function setId_hospital($id_hospital)
    {
        $this->id_hospital = $id_hospital;
        return $this;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEndereco(Endereco $endereco)
    {
        $this->endereco = $endereco;
        return $this;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;
        return $this;
    }

    public function getComplemento()
    {
        return $this->complemento;
    }

    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
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

    // CRUD -------------------------------------------------
    function add()
    {
        try {
            $sql = "
            INSERT INTO hospital (id_hospital, nome, fk_cep, numero, complemento) 
            VALUES (NULL, :nome, :endereco, :numero, :complemento);
            ";
            require_once("dao.php");
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":nome", $this->nome);
            $stman->bindParam(":endereco", $this->endereco->cep);
            $stman->bindParam(":numero", $this->numero);
            $stman->bindParam(":complemento", $this->complemento);
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
            $sql = "select * from hospital";
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
            $sql = "select * from hospital h where h.id_hospital = :id;";
            require_once("dao.php");
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":id", $id);
            $stman->execute();
            $result = $stman->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            erro("Erro ao listar a hospital! " . $e->getMessage());
        }
        return $result;
    }


    function update()
    {
        $result = null;
        try {
            $sql = "
            UPDATE hospital h SET
            nome = :nome,
            fk_cep = :endereco,
            numero = :numero,
            complemento = :complemento,
            ativo = :ativo
            WHERE h.id_hospital = :id;";
            require_once("dao.php");
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":id", $this->id_hospital);
            $stman->bindParam(":especialidade", $this->especialidade->id_especialidade);
            $stman->bindParam(":hospital", $this->hospital->id_hospital);
            $stman->bindParam(":nome", $this->nome);
            $stman->bindParam(":leitos", $this->quant_leitos);
            $stman->bindParam(":ativo", $this->ativo);
            $stman->execute();
            $result = $stman->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            erro("Erro ao atualizar! " . $e->getMessage());
        }
        return $result;
    }


    function remove($id, $dados)
    {
        $result = null;
        try {
            $sql = "
            UPDATE hospital SET
            ativo = :ativo
            WHERE hospital.id_hospital = :id";

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
    // insert into hospital 
    // (hospital.fk_id_hospital,hospital.fk_id_especialidade, hospital.nome, ala.quant_leitos) 
    // values (1, 1, "B", 123);
    // COMMIT;
    // #ROLLBACK;
    // INSERT INTO `hospital` (`id_hospital`, `nome`, `fk_cep`, `numero`, `complemento`) VALUES (NULL, 'Hospital Geral', '23520-120', '34', NULL);
