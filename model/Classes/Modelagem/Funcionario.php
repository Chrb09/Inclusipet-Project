<?php
class Funcionario {
  public $codfuncionario;
  public $codcargo ;
  public $senha ;
  public $nome ;
  public $rg;
  public $cpf ;
  public $telefone;
  public $cep;
  public $codunidade;
  public $token;
  public $imagem ;

  public function getFullName($funcionario) {
    return $funcionario->nome;
  }

  public function generateToken() {
    return bin2hex(random_bytes(50));
  }
  
  public function generatePassword($senha) {
    return password_hash($senha, PASSWORD_DEFAULT);
  }

  public function imageGenerateName() {
    return bin2hex(random_bytes(60)) . ".jpg";
  }
}
  interface FuncionarioDAOInterface{
      public function buildfuncionario($data);
      public function create(Funcionario $funcionario , $authfuncionario = false );
      public function update(Funcionario $funcionario , $redirect = true );
      public function verifyToken($protected = false);
      public function setTokenToSession($token, $redirect = true);
      public function findById($codfuncionario);
      public function findByToken($token);
      public function destroyToken();
      public function changePassword(Funcionario $funcionario);
      public function getAllFuncionario();
      
  }


?>