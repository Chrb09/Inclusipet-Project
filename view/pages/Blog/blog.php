<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" href="../../assets/css/StyleGeral.css" />
  <!-- CSS EXTERNO GERAL -->
  <link rel="stylesheet" href="../../assets/css/StyleBlog.css" />
  <!-- CSS EXTERNO PAGINA -->
  <link rel="icon" href="../../assets/img/Outros/inclusipet.ico" />
  <!-- ICON -->
  <title>Blog</title>
</head>

<body>
  <!-- HEADER-->
  <?php
  $activePage = "blog";
  include('../../components/headers/header.php');
  ?>
  <!-- BLOG -->
  <div class="container container-blog container__heading">
    <div class="titulo">O Blog direto da nossa equipe,<br />aqui na Inclusipet</div>
  </div>
  <div class="container container-blog container__main">
    <div class="sidebar-nav">
      <strong>Categorias de Blog</strong>
      <button class="sidebar-button ativo" onclick="" type="button">Ver Todos</button>
      <button class="sidebar-button" onclick="" type="button">Acessibilidade</button>
      <button class="sidebar-button" onclick="" type="button">Conscientização</button>
      <button class="sidebar-button" onclick="" type="button">Cuidados</button>
    </div>
    <main>
      <div class="section-nav-mobile">
        <div class="details open_faq">
          <div class="summary">Categorias de Blog</div>
          <div class="wrapper-faq">
            <div class="colapse">
              <div class="nav-mobile">
                <button class="sidebar-button ativo" onclick="" type="button">Ver Todos</button>
                <button class="sidebar-button" onclick="" type="button">Acessibilidade</button>
                <button class="sidebar-button" onclick="" type="button">Conscientização</button>
                <button class="sidebar-button" onclick="" type="button">Cuidados</button>
              </div>
            </div>
          </div>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="var(--purple)"
            class="arrow_faq">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
          </svg>
        </div>
      </div>
      <script src="../../assets/js/nav_mobile.js"></script>
      <div class="cartao-transp">
        <a href="post1.php"><img src="../../assets/img/Blog/Post1/blog1.png" alt="" class="cartao__imagem" /></a>
        <div class="cartao__content">
          <div class="categorias">
            <div class="categoria">Acessibilidade</div>
            Leitura em 5min
          </div>
          <b>Desvendando Mitos sobre Animais Deficientes</b>
          <div class="cartao_texto">
            A natureza é repleta de diversidade, e os animais também podem enfrentar desafios de saúde que os tornam
            diferentes do padrão. No entanto, muitas ideias erradas cercam os animais deficientes
          </div>
          <a href="post1.php" class="link">Ler Mais
            <?php
            include('../../assets/svg/seta_link.php');
            ?>
          </a>
        </div>
      </div>
      <div class="grid__blog">
        <div class="cartao-transp">
          <a href="post2.php"><img src="../../assets/img/Blog/Post2/blog2.png" alt="" class="cartao__imagem" /></a>
          <div class="cartao__content">
            <div class="categorias">
              <div class="categoria">Conscientização</div>
              Leitura em 5min
            </div>
            <b>A Importância de Combater a Violência Animals</b>
            <div class="cartao_texto">
              A relação entre seres humanos e animais transcende barreiras, refletindo uma interconexão que molda a
              própria essência de nossa sociedade. No entanto, mesmo diante desse elo intrínseco, a violência contra
              animais persiste em diferentes formas, levantando a necessidade urgente de combater e erradicar esse
              fenômeno.
            </div>
            <a href="post2.php" class="link">Ler Mais
              <?php
              include('../../assets/svg/seta_link.php');
              ?>
            </a>
          </div>
        </div>
        <div class="cartao-transp">
          <a href="post3.php"><img src="../../assets/img/Blog/Post3/blog3.png" alt="" class="cartao__imagem" /></a>
          <div class="cartao__content">
            <div class="categorias">
              <div class="categoria">Cuidados</div>
              Leitura em 5min
            </div>
            <b>Alergias em Animais de Estimação</b>
            <div class="cartao_texto">
              As alergias em animais de estimação são uma preocupação crescente para muitos proprietários, afetando a
              qualidade de vida dos animais e gerando inquietação entre aqueles que buscam proporcionar o melhor
              cuidado possível aos seus companheiros peludos.
            </div>
            <a href="post3.php" class="link">Ler Mais
              <?php
              include('../../assets/svg/seta_link.php');
              ?>
            </a>
          </div>
        </div>
        <div class="cartao-transp">
          <a href="post4.php"><img src="../../assets/img/Blog/Post4/blog4.png" alt="" class="cartao__imagem" /></a>
          <div class="cartao__content">
            <div class="categorias">
              <div class="categoria">Cuidados</div>
              Leitura em 5min
            </div>
            <b>Como Cuidar dos Dentes do Seu Pet</b>
            <div class="cartao_texto">
              Cuidar dos dentes do seu pet é uma parte essencial da saúde geral do animal. A saúde bucal adequada não
              só previne problemas dentários, mas também promove o bem-estar geral do seu companheiro. Aqui estão
              algumas dicas sobre como cuidar dos dentes do seu pet
            </div>
            <a href="post4.php" class="link">Ler Mais
              <?php
              include('../../assets/svg/seta_link.php');
              ?>
            </a>
          </div>
        </div>
        <div class="cartao-transp">
          <a href="post5.php"><img src="../../assets/img/Blog/Post5/blog5.png" alt="" class="cartao__imagem" /></a>
          <div class="cartao__content">
            <div class="categorias">
              <div class="categoria">Conscientização</div>
              Leitura em 5min
            </div>
            <b>A Importância das Vacinas para a Saúde dos Animais</b>
            <div class="cartao_texto">
              A saúde dos animais de estimação é uma preocupação fundamental para seus tutores dedicados, e uma das
              maneiras mais eficazes de garantir essa saúde é por meio da vacinação adequada. As vacinas desempenham
              um papel crucial na prevenção de doenças, protegendo não apenas os animais individuais, mas também
              contribuindo para a saúde geral da comunidade animal.
            </div>
            <a href="post5.php" class="link">Ler Mais
              <?php
              include('../../assets/svg/seta_link.php');
              ?>
            </a>
          </div>
        </div>
      </div>
    </main>
  </div>
  <!-- FOOTER -->
  <?php
  include('../../components/footer.php');
  ?>
</body>

</html>