<?php
class especialidade{
    private $id_especialidade;
    private $especialidade;
    private $valor_dia;


    /**--------------------
     * Get the value of valor_dia
     */ 
    public function getValor_dia()
    {
        return $this->valor_dia;
    }

    /**
     * Set the value of valor_dia
     *
     * @return  self
     */ 
    public function setValor_dia($valor_dia)
    {
        $this->valor_dia = $valor_dia;

        return $this;
    }
  //id ---------------------------------------------------
    /**
     * Get the value of especialidade
     */ 
    public function getEspecialidade()
    {
        return $this->especialidade;
    }

    /**
     * Set the value of especialidade
     *
     * @return  self
     */ 
    public function setEspecialidade($especialidade)
    {
        $this->especialidade = $especialidade;

        return $this;
    }
//especialidade--------------------------------------------------
    /**
     * Get the value of id_especialidade
     */ 
    public function getId_especialidade()
    {
        return $this->id_especialidade;
    }

    /**
     * Set the value of id_especialidade
     *
     * @return  self
     */ 
    public function setId_especialidade($id_especialidade)
    {
        $this->id_especialidade = $id_especialidade;

        return $this;
    }
    //valor------------------------------------------------------
    function add(){
        try{
            $sql = "insert into especialidade(especialidade, valor_dia) 
            values (:especialidade, :valor )";
            require_once("dao.php");
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":especialidade",getEspecialidade());
            $stman->bindParam(":valor", getValor_dia());
            $stman->execute();  
            aviso("Cadastrado!");        
        } catch(Exception $e){
            erro("Erro ao cadastrar! " . $e->getMessage());
        }
        function listALL(){
            try{
                $sql = "select * from especialidade";
                
                require_once("dao.php");
                $dao = new Dao;
                $stman = $dao->conecta()->prepare($sql);
                $stman->execute();  
                $result = $stman->fetchAll(PDO::FETCH_OBJ);
            
            } catch(Exception $e){
                erro("Erro ao listar! " . $e->getMessage());
            }
            return $result;
            }
    }