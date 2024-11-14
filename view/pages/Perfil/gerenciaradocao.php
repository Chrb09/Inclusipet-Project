<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" href="../../assets/css/StyleGeral.css" />
  <!-- CSS EXTERNO GERAL -->
  <link rel="stylesheet" href="../../assets/css/StyleUsuario.css" />
  <link rel="stylesheet" href="../../assets/css/StyleGerenciarAdocao.css" />
  <!-- CSS EXTERNO PAGINA -->
  <link rel="icon" href="../../assets/img/Outros/inclusipet.ico" />
  <!-- ICON -->
  <title>Gerenciar Adoção</title>
  <style>
    .principal .titulo {
      margin-bottom: 0.75em;
    }

    .nav-perfil {
      display: flex;
      flex-direction: column;
      width: 8em;
      align-items: center;
      text-align: center;
      transition: filter 0.3s;

      &:hover {
        filter: brightness(80%);
      }
    }

    .nav-perfil img {
      width: 7em;
    }

    .card-txt {
      margin-top: 0.5em;
    }

    @media (max-width: 768px) {
      .nav-perfil {
        margin-inline: auto;
      }
    }

    .center {
      text-align: center !important;
    }
  </style>
</head>

<body>
  <!-- PERFIL -->
  <div class="container-usuario">
    <?php

    $sidebarActive = "adocao";
    include('../../components/sidebarperfil.php');

    require_once("../../../controller/DAO/AdocaoDAO/AdocaoDAO.php"); ?>
    <div class="main">
      <?php include('../../components/headers/headerperfil.php');

      $adocaoDao = new AdocaoDAO($conn, $BASE_URL);
      $adocoes = $adocaoDao->getAdocaoByCodCliente($clienteData->codcliente);
      ?>

      <div class="content">

        <?php include('../../components/navmobileperfil.php');
        // Adicionar Condição
        $condicao = true;

        if ($condicao == true) { ?>
          <div class="principal">
            <!--Div que contem o conteudo principal da pagina-->
            <h3 class="titulo">Para Adoção</h3>
            <!--Titulo da página-->

            <?php foreach ($adocoes as $adocao):
              $imagens = $adocaoDao->getImagemAdocaoByCod($adocao->CodAdocao); ?>

              <!--Inicio Item-->
              <div class="item">
                <!--Div que contem um dos animais disponiveiis prar a a adoção-->
                <img src="../../assets/img/ImagensAdocao/<?= $adocao->CodAdocao ?>/<?= $imagens[0] ?>"
                  alt="<?= $adocao->Nome ?>" class="animal" />

                <div class="descricao-pet">
                  <!--Div com a descrição do animal-->
                  <div class="titulo_item"><?= $adocao->Nome ?></div>
                  <p class="descricao"><?= $adocao->Endereco ?></p>
                  <p class="descricao"><?= $adocao->Descricao ?></p>
                </div>

                <div class="botoes">
                  <?php if ($adocao->Aprovado == '1') { ?>
                    <?php if ($adocao->Adotado == '0') { ?>
                      <button class="botao-solido editar-button">
                        <img src="../../assets/img/Perfil/editar_icon.png" alt="Editar" class="editar" />
                        Editar
                      </button>

                      <form action="../../../model/Arquivo/Inicializacao/adoption_process.php" method="POST">
                        <input type="hidden" name="type" value="update_adotado">
                        <input type="hidden" name="codAdocao" value="<?= $adocao->CodAdocao ?>">
                        <input type="hidden" name="adotado" value="1">

                        <button class="botao-borda" type="submit">Adotado?</button>
                      </form>
                    <?php } else { ?>
                      <form action="../../../model/Arquivo/Inicializacao/adoption_process.php" method="POST">
                        <input type="hidden" name="type" value="update_adotado">
                        <input type="hidden" name="codAdocao" value="<?= $adocao->CodAdocao ?>">
                        <input type="hidden" name="adotado" value="0">

                        <button class="botao-solido adotar" type="submit">Adotado</button>
                      </form>
                    <?php } ?>
                  <?php } else if ($adocao->Aprovado == '0' && $adocao->MotivoRecusar != '') { ?>
                      <button class="botao-solido editar-button">
                        <img src="../../assets/img/Perfil/editar_icon.png" alt="Editar" class="editar" />
                        Editar
                      </button>
                      <button class="botao-solido recusar"
                        onclick="mostrarMotivo('<?= $adocao->MotivoRecusar ?>')">Recusado</button>
                  <?php } else { ?>
                      <button class="botao-solido pendente"><img src="../../assets/img/Perfil/horario.png"
                          alt="" />Pendente</button>
                  <?php } ?>
                </div>
              </div>
              <!--Fim item-->

            <?php endforeach; ?>

          </div>
        <?php } else { ?>
          <div class="titulo">Nenhuma adoção criada</div>
          <br>
          <a class="nav-perfil" href="anuncioadocao.php"><img src="../../assets/img/Perfil/anunciar.png" alt="" />
            <div class="card-txt">
              <p>Criar anúncio de</p>
              <strong>Adoção</strong>
            </div>
          </a>
        <?php } ?>
      </div>
    </div>
  </div>
</body>

<script>
  function mostrarMotivo(Motivo) {
    Swal.fire({
      title: `<div class="titulo-sweetalert center">Motivo</div>`,
      html: `
        <p>`+ Motivo + `</p>
        <br>
        <div class="linha-sweetalert">
          <button class="botao-borda" onclick="Swal.close()"  type="button">Voltar</button>
        </div>

        `,
      customClass: {
        popup: 'container-input',
      },
      showConfirmButton: false,
      focusConfirm: false,
      backdrop: "rgb(87, 77, 189, 0.5",
    });
  }

</script>

</html>