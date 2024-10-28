<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" href="../../assets/css/StyleGeral.css" />
  <!-- CSS EXTERNO GERAL -->
  <link rel="stylesheet" href="../../assets/css/StyleUsuario.css" />
  <link rel="stylesheet" href="../../assets/css/StyleMeusAgendamentos.css" />
  <!-- CSS EXTERNO PAGINA -->
  <link rel="icon" href="../../assets/img/Outros/inclusipet.ico" />
  <!-- ICON -->
  <title>Meus Agendamentos</title>
  <style>
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
  </style>
</head>

<body>
  <!-- PERFIL -->
  <div class="container-usuario">
    <?php

    $sidebarActive = "agendamentos";
    include('../../components/sidebarperfil.php');

    require_once("../../../controller/DAO/AgendamentoDAO/AgendamentoDAO.php");

    ?>
    <div class="main">
      <?php include('../../components/headers/headerperfil.php');

      $agendamentoDao = new AgendamentoDAO($conn, $BASE_URL);

      $agendamentos = $agendamentoDao->getAgendamentoByCodCliente($clienteData->codcliente);

      ?>
      <div class="content">

        <?php include('../../components/navmobileperfil.php');
        // Adicionar Condição
        
        if ($agendamentos !== []) { ?>
          <div class="titulo">Meus Agendamentos</div>
          <!--CODIGO DA PAGINA AQUI-->
          <div class="conteudo">
            <div class="card-agendamento">
              <div class="animal">
                <div class="animal-wrapper">
                  <img src="../../assets/img/Perfil/fonseca.png" alt="" />
                  <p>Fonseca</p>
                </div>
                <div class="status">Tudo Certo</div>
              </div>
              <table class="info-table">
                <tr>
                  <th>Pedido:</th>
                  <td>34012</td>
                </tr>
                <tr>
                  <th>Unidade:</th>
                  <td>Artur Alvim</td>
                </tr>
                <tr>
                  <th>Serviço:</th>
                  <td>Exame</td>
                </tr>
                <tr>
                  <th>Especialidade:</th>
                  <td>Clínico Geral</td>
                </tr>
                <tr>
                  <th>Data da Consulta:</th>
                  <td>24/04/2024</td>
                </tr>
                <tr>
                  <th>Horario da Consulta:</th>
                  <td>11:20</td>
                </tr>
              </table>
              <div class="button-wrapper-form">
                <button class="botao botao-borda" onclick="location.href='agendamento.php'" type="button">
                  Editar
                </button>
                <button class="botao botao-solido" onclick="" type="button">Cancelar</button>
              </div>
            </div>

            <div class="card-agendamento">
              <div class="animal">
                <div class="animal-wrapper">
                  <img src="../../assets/img/Perfil/fonseca.png" alt="" />
                  <p>Fonseca</p>
                </div>
                <div class="status">Tudo Certo</div>
              </div>
              <table class="info-table">
                <tr>
                  <th>Pedido:</th>
                  <td>34012</td>
                </tr>
                <tr>
                  <th>Unidade:</th>
                  <td>Artur Alvim</td>
                </tr>
                <tr>
                  <th>Serviço:</th>
                  <td>Exame</td>
                </tr>
                <tr>
                  <th>Especialidade:</th>
                  <td>Clínico Geral</td>
                </tr>
                <tr>
                  <th>Data da Consulta:</th>
                  <td>24/04/2024</td>
                </tr>
                <tr>
                  <th>Horario da Consulta:</th>
                  <td>11:20</td>
                </tr>
              </table>
              <div class="button-wrapper-form">
                <button class="botao botao-borda" onclick="location.href='agendamento.php'" type="button">
                  Editar
                </button>
                <button class="botao botao-solido" onclick="" type="button">Cancelar</button>
              </div>
            </div>

            <div class="card-agendamento">
              <div class="animal">
                <div class="animal-wrapper">
                  <img src="../../assets/img/Perfil/fonseca.png" alt="" />
                  <p>Fonseca</p>
                </div>
                <div class="status cancelado">Cancelado</div>
              </div>
              <table class="info-table">
                <tr>
                  <th>Pedido:</th>
                  <td>34012</td>
                </tr>
                <tr>
                  <th>Unidade:</th>
                  <td>Artur Alvim</td>
                </tr>
                <tr>
                  <th>Serviço:</th>
                  <td>Exame</td>
                </tr>
                <tr>
                  <th>Especialidade:</th>
                  <td>Clínico Geral</td>
                </tr>
                <tr>
                  <th>Data da Consulta:</th>
                  <td>24/04/2024</td>
                </tr>
                <tr>
                  <th>Horario da Consulta:</th>
                  <td>11:20</td>
                </tr>
              </table>
              <div class="button-wrapper-form desativado">
                <button class="botao botao-borda" onclick="" type="button" disabled>Editar</button>
                <button class="botao botao-solido" onclick="" type="button" disabled>Cancelar</button>
              </div>
            </div>
          </div>
        <?php } else { ?>
          <div class="titulo">Nenhum agendamento realizado</div>
          <br>
          <a class="nav-perfil" href="agendamento.php"><img src="../../assets/img/Perfil/agendar.png" alt="" />
            <div class="card-txt">
              <p>Agendar</p>
              <strong>Consulta</strong>
            </div>
          </a>
        <?php } ?>
      </div>
    </div>
  </div>
</body>

</html>