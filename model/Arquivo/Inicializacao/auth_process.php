<?php
// Arquivo de autenticação do usuário

require_once('globals.php');
require_once('db.php');

require_once('../../Classes/Modelagem/Message.php');
require_once('../../Classes/Modelagem/Cliente.php');
require_once('../../../controller/DAO/ClienteDAO/ClienteDAO.php');
require_once('../../Classes/Modelagem/Funcionario.php');
require_once('../../../controller/DAO/FuncionarioDAO/FuncionarioDAO.php');


$message = new Message($BASE_URL);
$clienteDao = new ClienteDAO($conn, $BASE_URL);
$funcionarioDao = new FuncionarioDAO($conn, $BASE_URL);


// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

// ===== COMEÇO DO CLIENTE =====

if ($type === 'register_client') {

  $nome = filter_input(INPUT_POST, "sign-up-name");
  $datanasc = filter_input(INPUT_POST, "sign-up-date");
  $telefone = filter_input(INPUT_POST, "sign-up-tel");
  $cep = filter_input(INPUT_POST, "sign-up-cep");
  $cpf = filter_input(INPUT_POST, "sign-up-cpf");
  $email = filter_input(INPUT_POST, "sign-up-email");
  $senha = filter_input(INPUT_POST, "sign-up-password");
  $confirmarsenha = filter_input(INPUT_POST, "sign-up-confirm-password");

  // Verificação de dados mínimos 
  if (!$nome || !$datanasc || !$telefone || !$cep || !$cpf || !$email || !$senha) {

    // Enviar uma msg de erro, de dados faltantes
    $message->setMessage("Preencha todos os campos.", "error", "toast", "back");

  } else if ($senha !== $confirmarsenha) {
    $message->setMessage("As senhas fornecidas não batem.", "error", "toast", "back");
  } else if (!validarCPF($cpf)) {
    $message->setMessage("CPF inválido.", "error", "toast", "back");
  } else {

    if ($clienteDao->findByEmail($email) !== false) {
      // Enviar uma msg de erro, de dados faltantes
      $message->setMessage("Email já cadastrado.", "error", "toast", "back");

    } else if ($clienteDao->findByCPF($cpf) !== false) {
      $message->setMessage("CPF já cadastrado.", "error", "toast", "back");
    } else if ($clienteDao->validateAge($datanasc) !== true) {
      $message->setMessage("Menor de 18 anos.", "error", "toast", "back");
    } else {
      $cliente = new Cliente();

      $clienteToken = $cliente->generateToken();
      $senhaFinal = $cliente->generatePassword($senha);

      $cliente->nome = $nome;
      $cliente->datanasc = $datanasc;
      $cliente->telefone = $telefone;
      $cliente->cep = $cep;
      $cliente->cpf = $cpf;
      $cliente->email = $email;
      $cliente->senha = $senhaFinal;
      $cliente->token = $clienteToken;

      $auth = true;

      $clienteDao->create($cliente, $auth);
    }
  }
} else if ($type === 'login_client') {

  $email = filter_input(INPUT_POST, "log-in-email");
  $senha = filter_input(INPUT_POST, "log-in-password");

  // Tenta autenticar usuário
  if ($clienteDao->authenticatecliente($email, $senha)) {

    $message->setMessage("Seja bem-vindo!", "success", "toast", "../../../view/pages/Perfil/perfil.php");

    // Redireciona o usuário, caso não conseguir autenticar
  } else {
    $message->setMessage("Usuário e/ou senha incorretos.", "error", "toast", "back");
  }

} else
  // ===== FIM DO CLIENTE =====





  // ===== COMEÇO DO FUNCIONÁRIO =====
//Cadastrar funcionário:
  if ($type === 'register_funcionario') {
    $codfuncionario = filter_input(INPUT_POST, "sign-up-codVet");
    $senha = filter_input(INPUT_POST, "sign-up-password");
    $nome = filter_input(INPUT_POST, "sign-up-nome");
    $codcargo = filter_input(INPUT_POST, "sign-up-cargo");
    $cpf = filter_input(INPUT_POST, "sign-up-cpf");
    $cep = filter_input(INPUT_POST, "sign-up-cep");
    $rg = filter_input(INPUT_POST, "sign-up-rg");
    $telefone = filter_input(INPUT_POST, "sign-up-tel");
    $codunidade = filter_input(INPUT_POST, "sign-up-unidade");

    if (!$nome || !$cpf || !$cep || !$rg || !$telefone || !$codunidade) {

      $message->setMessage("Preencha todos os campos.", "error", "toast", "back");
    } else if (!validarCPF($cpf)) {
      $message->setMessage("CPF inválido.", "error", "toast", "back");
    } else {

      if ($funcionarioDao->findById($codfuncionario) === false) {
        $funcionario = new Funcionario();

        $funcionarioToken = $funcionario->generateToken();
        $senhaFinal = $funcionario->generatePassword($senha);
        $funcionario->senha = $senhaFinal;

        $funcionario->nome = $nome;
        $funcionario->codcargo = $codcargo;
        $funcionario->cpf = $cpf;
        $funcionario->cep = $cep;
        $funcionario->rg = $rg;
        $funcionario->telefone = $telefone;
        $funcionario->codunidade = $codunidade;
        $funcionario->token = $funcionarioToken;
        $funcionario->dataAdmissao = date("Y-m-d");

        $authfuncionario = false;

        $funcionarioDao->create($funcionario, $authfuncionario, $senha);
      } else {
        // Enviar uma msg de erro, de dados faltantes
        $message->setMessage("Funcionario já cadastrado.", "error", "toast", "back");
      }
    }
  } else if ($type === 'login_funcionario') {

    $codfuncionario = filter_input(INPUT_POST, "log-in-cod");
    $senha = filter_input(INPUT_POST, "log-in-password");

    if ($funcionarioDao->authenticateFuncionario($codfuncionario, $senha)) {

      $message->setMessage("Seja bem-vindo!", "success", "toast", "../../../view/pages/Funcionario/perfil.php");

    } else {
      $message->setMessage("Usuário e/ou senha incorretos.", "error", "toast", "back");
    }

  } else {
    $message->setMessage("Informações inválidas!", "error", "toast", "../../../view/pages/index/index.php");
  }


//Criação da função para validação de CPF
function validarCPF($cpf)
{
  $cpf = preg_replace('/\D/', '', $cpf); // Remove caracteres não numéricos

  if (strlen($cpf) != 11 || preg_match('/^(\d)\1{10}$/', $cpf)) {
    return false; // CPF inválido
  }

  // Validação do primeiro dígito
  $soma = 0;
  for ($i = 1; $i <= 9; $i++) {
    $soma += (int) $cpf[$i - 1] * (11 - $i);
  }
  $resto = ($soma * 10) % 11;
  if ($resto >= 10)
    $resto = 0;
  if ($resto != (int) $cpf[9])
    return false;

  // Validação do segundo dígito
  $soma = 0;
  for ($i = 1; $i <= 10; $i++) {
    $soma += (int) $cpf[$i - 1] * (12 - $i);
  }
  $resto = ($soma * 10) % 11;
  if ($resto >= 10)
    $resto = 0;
  return $resto == (int) $cpf[10];
}