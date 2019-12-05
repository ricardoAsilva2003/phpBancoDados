<?php
class Paciente
{
    public $uid;
    public $nome;
    public $email;
    public $pws;
    public $nickname;

    public function add()
    {
        try {
            require_once("dao.php");
            $sql = "insert into paciente(nome,nickname, email, senha) value (:nome, :nickname, :email, :senha)";
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":nome", $this->nome);
            $stman->bindParam(":email", $this->email);
            $stman->bindParam(":senha", $this->pws);
            $stman->bindParam(":nickname", $this->nickname);
            $stman->execute();
            aviso("Salvo com sucesso!");
        } catch (Exception $e) {
            erro("Erro: " .  $e->getMessage());
        }
    }

    public function update()
    {
        try {
            require_once("dao.php");
            $sql = "update paciente
            set nome = :nome,
                nickname = :nickname,
                email = :email
            where uid = :id";
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":nome", $this->nome);
            $stman->bindParam(":email", $this->email);
            $stman->bindParam(":id", $this->uid);
            $stman->bindParam(":nickname", $this->nickname);
            $stman->execute();
            aviso("Atualizado com sucesso!");
        } catch (Exception $e) {
            erro("Erro: " .  $e->getMessage());
        }
    }


    public function get($uid)
    {
        $result = null;
        try {
            require_once("dao.php");
            $sql = "select * from paciente where uid = :id";
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":id", $uid);
            $stman->execute();
            $result = $stman->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            erro("Erro: " .  $e->getMessage());
        }
        return $result;
    }

    public function listAll()
    {
        $result = null;
        try {
            require_once("dao.php");
            $sql = "select * from paciente";
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            //$stman->bindParam(":nome", $this->nome);
            $stman->execute();
            $result = $stman->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            erro("Erro: " .  $e->getMessage());
        }
        return $result;
    }

    public function login($email, $senha)
    {
        $result = null;
        try {
            require_once("dao.php");
            $sql = "select * from paciente where email = :email and senha = :senha";
            $dao = new Dao;
            $stman = $dao->conecta()->prepare($sql);
            $stman->bindParam(":email", $email);
            $stman->bindParam(":senha", $senha);
            $stman->execute();
            $result = $stman->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            erro("Erro: " .  $e->getMessage());
        }
        return $result;
    }
}
