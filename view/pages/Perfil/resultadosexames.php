<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" href="../../assets/css/StyleGeral.css" />
  <!-- CSS EXTERNO GERAL -->
  <link rel="stylesheet" href="../../assets/css/StyleUsuario.css" />
  <link rel="stylesheet" href="../../assets/css/StyleResultadosDeExames.css" />
  <!-- CSS EXTERNO PAGINA -->
  <link rel="icon" href="../../assets/img/Outros/inclusipet.ico" />
  <!-- ICON -->
  <title>Resultados Exames</title>
  <style>
    .top {
      align-items: end;
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
  </style>
</head>

<body>
  <!-- PERFIL -->
  <div class="container-usuario">
    <?php

    $sidebarActive = "exames";
    include('../../components/sidebarperfil.php');

    require_once("../../../controller/DAO/PetDAO/PetDAO.php");
    require_once("../../../controller/DAO/FuncionarioDAO/FuncionarioDAO.php");
    require_once("../../../controller/DAO/AgendamentoDAO/AgendamentoDAO.php");
    ?>
    <div class="main">
      <?php include('../../components/headers/headerperfil.php');

      $petDao = new PetDAO($conn, $BASE_URL);
      $agendamentoDao = new AgendamentoDAO($conn, $BASE_URL);
      $funcionarioDao = new FuncionarioDAO($conn, $BASE_URL); // instancia do FuncionarioDAO
      
      $pets = $petDao->getPetsByCodCliente($clienteData->codcliente);

      $servicos = $agendamentoDao->getAllServico();
      $agendamentos = $agendamentoDao->getAgendamentoByCodCliente($clienteData->codcliente);

      if ($pets != []) {
        if (isset($_POST)) {
          $codanimalinfo = filter_input(INPUT_POST, "pet");
          $datainfo = filter_input(INPUT_POST, "data");
          $tipoexameinfo = filter_input(INPUT_POST, "tipoexame");
        }

        if ($codanimalinfo == '') {
          $codanimalinfo = $pets[0]->CodAnimal;
        }
        if ($datainfo == '' && $tipoexameinfo == '') {
          $resultados = $agendamentoDao->getAgendamentoByInfoDate($codanimalinfo, "1900-01-01");
        } else if ($tipoexameinfo == '') {
          $resultados = $agendamentoDao->getAgendamentoByInfoDate($codanimalinfo, $datainfo);
        } else if ($tipoexameinfo != '' && $datainfo == '') {
          $resultados = $agendamentoDao->getAgendamentoByInfoDateType($codanimalinfo, "1900-01-01", $tipoexameinfo);
        } else {
          $resultados = $agendamentoDao->getAgendamentoByInfoDateType($codanimalinfo, $datainfo, $tipoexameinfo);
        }

      }



      ?>



      <div class="content">

        <?php include('../../components/navmobileperfil.php');
        if ($agendamentos != []) {
          ?>
          <div class="titulo">Resultados Exames</div>
          <form class="top" method="POST" action="resultadosexames.php">
            <div class="form-group">
              <label for="pet">Pet:</label>
              <div class="custom-select">
                <select id="pet" name="pet">
                  <?php foreach ($pets as $pet): ?>
                    <option value="<?= $pet->CodAnimal ?>" <?= ($codanimalinfo == $pet->CodAnimal) ? 'selected' : '' ?>>
                      <?= $pet->Nome ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="data">A Partir de:</label>
              <input type="date" id="data" name="data" value="<?= $datainfo ?>" />
            </div>

            <div class="form-group">
              <label for="tipo">Tipo de Exame:</label>
              <div class="custom-select">
                <select id="tipo" name="tipoexame">
                  <option value="" <?= ($tipoexameinfo == "*") ? 'selected' : '' ?>>
                    <?= "Todos" ?>
                  </option>
                  <?php foreach ($servicos as $servico): ?>
                    <option value="<?= $servico[0] ?>" <?= ($tipoexameinfo == $servico[0]) ? 'selected' : '' ?>>
                      <?= $servico[1] ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <button type="submit" class="botao-solido">Filtrar</button>
            </div>
          </form>
          <!--Fim das filtragens-->


          <!--Apresentação dos resultados COMEÇO-->
          <?php if ($resultados != []) { ?>
            <div class="card-container">
              <?php foreach ($resultados as $resultado):
                //Buscando o resultado com base no ID
                $funcionario = $funcionarioDao->findById($resultado->CodFuncionario);
                ?>
                <div class="card">
                  <div class="details">
                    <div class="summary summary-exame">
                      <div class="table-wrapper">
                        <table class="info">
                          <tr>
                            <th>Pedido</th>
                            <th>Data/Horario</th>
                            <th>Exames</th>
                            <th>Profissional</th>
                            <th>Unidade</th>
                          </tr>
                          <tr>
                            <td><?= $resultado->CodAgendamento ?></td>
                            <td>
                              <?php
                              $data = explode("-", $resultado->Data);
                              echo ("$data[2]/$data[1]/$data[0]");
                              ?> <br />
                              <?= explode(":00", $resultado->Hora)[0] . "h" ?>
                            </td>
                            <td><?= $agendamentoDao->getServicoByCod($resultado->CodServico) ?></td>
                            <td><?= $funcionario->nome ?></td>
                            <td><?= explode("-", $agendamentoDao->getUnidadeByCod($resultado->CodUnidade)[1])[1] ?></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div class="wrapper-faq">
                      <div class="colapse">
                        <p>
                          <strong>Info Adicionais:</strong>
                          <?= $resultado->Info ?>
                        </p>
                        <!-- Adicionar o link para o PDF -->
                        <?php if (!empty($resultado->Resultado)): ?>
                          <a href="../../../view/assets/img/ArquivosAgendamdento/<?= $resultado->Resultado ?>" 
                            target="_blank" class="botao-borda">Baixar PDF</a>
                        <?php else: ?>
                          <p><em>PDF não disponível</em></p>
                        <?php endif; ?>
                      </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="var(--purple)"
                      class="arrow_faq">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>

          <?php } else {
            ?>

            <b>Nenhum resultado encontrado</b>
            <?php

          }
        } else { ?>

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
<script src="../../assets/js/exames.js"></script>

</html>