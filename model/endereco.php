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
}