<?php

require_once('../../../model/Arquivo/Inicializacao/globals.php');
require_once('../../../model/Arquivo/Inicializacao/db.php');
require_once('../../../model/Classes/Modelagem/Message.php');
require_once('../../../controller/DAO/ClienteDAO/ClienteDAO.php');
require_once('../../../controller/DAO/FuncionarioDAO/FuncionarioDAO.php');

$message = new Message($BASE_URL);
$flassMessage = $message->getMessage();

if (!empty($flassMessage["msg"])) {
  $message->clearMessage();
}

// cliente
$clienteDao = new ClienteDAO($conn, $BASE_URL);
$clienteData = $clienteDao->verifyToken(false);

// funcionario
$funcionarioDao = new FuncionarioDAO($conn, $BASE_URL);
$funcionarioData = $funcionarioDao->verifyToken(false);

if ($clienteData) {
  if ($clienteData->imagem == "") {
    $clienteData->imagem = "user.png";
  }

  $primeiroNome = explode(' ', trim($clienteData->nome));
}

if ($funcionarioData) {
  if ($funcionarioData->imagem == "") {
    $funcionarioData->imagem = "user.png";
  }
  $primeiroNomeFunc = explode(' ', trim($funcionarioData->nome));
}

?>

<header class="header">
  <div class="container container__header">
    <a href="../index/index.php">
      <img src="../../assets/img/Outros/inclusipet.png" alt="Logo Inclusipet" class="logo__header" />
    </a>
    <ul class="menu__header">
      <li>
        <a href="../QuemSomos/quemsomos.php" class="links__header <?php if ($activePage == 'quemsomos') {
          echo 'pagatual';
        } else {
          echo 'a-under ';
        } ?>">Quem Somos</a>
      </li>
      <li>
        <a href="../Unidades/unidades.php" class="links__header <?php if ($activePage == 'unidades') {
          echo 'pagatual';
        } else {
          echo 'a-under ';
        } ?>"">Unidades</a>
      </li>
      <li>
        <a href=" ../Blog/blog.php" class="links__header <?php if ($activePage == 'blog') {
          echo 'pagatual';
        } else {
          echo 'a-under ';
        } ?>"">Blog</a>
      </li>
      <li>
        <a href=" ../Adocao/adocao.php" class="links__header <?php if ($activePage == 'adocao') {
          echo 'pagatual';
        } else {
          echo 'a-under ';
        } ?>"">Adoção</a>
      </li>
      <li>
        <a href=" ../Contato/contato.php" class="links__header <?php if ($activePage == 'contato') {
          echo 'pagatual';
        } else {
          echo 'a-under ';
        } ?>"">Contato</a>
      </li>
        <li>
        <?php if ($clienteData) { ?> <!-- caso seja o cliente -->
          <a href=""> | </a>
          </li>

          <li>
          <!-- caso esteja logado -->
          <a href=" ../Perfil/perfil.php" class="a-logado"><?= $primeiroNome[0] ?>
            <img src="../../assets/img/ImagensPerfil/<?= $clienteData->imagem ?>" alt="Login" class="login__header" />
          </a>

        <?php } else if ($funcionarioData) { ?> <!-- caso seja o funcionario -->
            <a href=""> | </a>
          </li>

          <li>
            <!-- caso esteja logado -->
            <a href=" ../Funcionario/perfil.php" class="a-logado"><?= $primeiroNomeFunc[0] ?>
              <img src="../../assets/img/ImagensFuncionario/<?= $funcionarioData->imagem ?>" alt="Login"
                class="login__header" />
            </a>

        <?php } else { ?>
            <a href=" ../Login/login.php">
              <img src="../../assets/img/Login/login.png" alt="Login" class="login__header" />
            </a>
        <?php } ?>

      </li>
    </ul>
    <button class="barra__header">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
      </svg>
    </button>
    <div class="dropdown__header">
      <li>
        <a href="../QuemSomos/quemsomos.php" class="links__header">Quem Somos</a>
      </li>
      <li>
        <a href="../Unidades/unidades.php" class="links__header">Unidades</a>
      </li>
      <li>
        <a href="../Blog/blog.php" class="links__header">Blog</a>
      </li>
      <li>
        <a href="../Adocao/adocao.php" class="links__header">Adoção</a>
      </li>
      <li>
        <a href="../Contato/contato.php" class="links__header">Contato</a>
      </li>
      <li>
        <?php if ($clienteData) { ?>
          <!-- caso esteja logado -->
          <a href=" ../Perfil/perfil.php" class="a-logado">
            <img src="../../assets/img/ImagensPerfil/<?= $clienteData->imagem ?>" alt="Login"
              class="login__header-mobile" />
          </a>

        <?php } else if ($funcionarioData) { ?>
            <a href=" ../Perfil/perfil.php" class="a-logado">
              <img src="../../assets/img/ImagensFuncionario/<?= $funcionarioData->imagem ?>" alt="Login"
                class="login__header-mobile" />
            </a>

        <?php } else { ?>
            <div class="botao-solido-branco" onclick="location.href='../Login/login.php'" type="button">Login</div>
        <?php } ?>

      </li>
    </div>
  </div>
</header>
<script src="../../assets/js/dropdown_header.js"></script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  const Toast = Swal.mixin({
    toast: true,
    position: 'bottom-right',
    iconColor: 'white',
    customClass: {
      popup: 'colored-toast',
    },
    showConfirmButton: false,
    timer: 6500,
    timerProgressBar: true,
  })
</script>

<?php if (!empty($flassMessage["msg"])) {
  if ($flassMessage['format'] == "toast") {
    ?>
    <script type="text/javascript">
      Toast.fire({
        icon: "<?= $flassMessage["type"] ?>",
        title: "<?= $flassMessage["msg"] ?>",
      })
    </script>
    <?php
  } else if ($flassMessage['format'] == "popup") {
    ?>
      <script type="text/javascript">
        Swal.fire({
          html: `<div><p for="" > <?= $flassMessage["msg"] ?></p></div> `,
          showConfirmButton: true,
          icon: "<?= $flassMessage["type"] ?>",
          focusConfirm: true,
          customClass: {
            popup: 'container-custom',
          },
          backdrop: "rgb(87, 77, 189, 0.5",
        });
      </script>
    <?php
  }
}
?>