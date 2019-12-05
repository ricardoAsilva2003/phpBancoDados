<?php

class Endereco {
    public $cep;
    public $logradouro;
    public $bairro;
    public $cidade;
    public $uf;
    
    function add(){
        try{
            $sql = "insert into endereco (cep, logradouro, bairro, cidade, uf) 
            values (:cep, :logradouro, :bairro, :cidade, :uf)";
            require_once("dao.php");
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":cep", $this->cep);
            $stman->bindParam(":logradouro", $this->logradouro);
            $stman->bindParam(":cidade", $this->cidade);
            $stman->bindParam(":bairro", $this->bairro);
            $stman->bindParam(":uf", $this->uf);
            $stman->execute();  
            aviso("Cadastrado!");        
        } catch(Exception $e){
            erro("Erro ao cadastrar! " . $e->getMessage());
        }
    }

    function listAll()
    {
        $result = null;
        try {
            $sql = "select * from endereco";
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
            $sql = "select * from endereco e where e.cep = :id";
            require_once("dao.php");
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":id", $id);
            $stman->execute();
            $result = $stman->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            erro("Erro ao listar a endereco! " . $e->getMessage());
        }
        return $result;
    }


    function update()
    {
        $result = null;
        try {
            $sql = "
            UPDATE endereco e SET
            cep = :cep,
            logradouro = :logradouro,
            bairro = :bairro,
            cidade = :cidade,
            uf = :uf
            WHERE e.cep = :cep;";
            require_once("dao.php");
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":cep", $this->cep);
            $stman->bindParam(":logradouro", $this->logradouro);
            $stman->bindParam(":cidade", $this->cidade);
            $stman->bindParam(":bairro", $this->bairro);
            $stman->bindParam(":uf", $this->uf);
            $stman->execute();
            $result = $stman->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            erro("Erro ao Atualizar! " . $e->getMessage());
        }
        return $result;
    }


    function remove($id)
    {
        $result = null;
        try {
            $sql = "
            DELETE FROM sexo s WHERE s.id_sexo = :id";
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