<?php

  if (is_page(array('Busca'))){
    if (array_key_exists('informacoes', $_GET)) $s_informacoes = $_GET['informacoes'];
    if (array_key_exists('dados', $_GET)) $s_dados = $_GET['dados'];
  }
  
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="fb:app_id" content="1237764039687630">

    <title><?php get_titulo($s_informacoes, $s_dados); ?></title> 

    <?php /*,'Blog' e is_search() removidos */ 
    	if(is_singular(array('vaga','post')) || is_author() || is_category() || is_page(array('Busca','vagas-do-autor','posts-do-autor','posts-da-categoria','Empresa','Cidade','Estado','Área'))): ?>
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script>
          (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-4807449657289752",
            enable_page_level_ads: true,
            overlays: {bottom: true}
          });
        </script>
    <?php endif; ?>

    <?php wp_head(); ?>
  </head>
  
  <body class="nav-on-header smart-nav">
    
    <nav class="navbar">
      <div class="container">

        <div class="pull-left">
          <a class="navbar-toggle" href="#" data-toggle="offcanvas"><i class="ti-menu"></i></a>

          <div class="logo-wrapper">

            <div class="logo-alt" href="home">
              <a href="<?= get_option('home'); ?>">Trampo<span class="interncor"><span class="pontocor">.</span><span class="corx">x</span><span class="cory">y</span><span class="corz">z</span></span></a>
            </div>

            <div class="logo" href="home">
              <a href="<?= get_option('home'); ?>">Trampo<span class="interncor"><span class="pontocor">.</span><span class="corx">x</span><span class="cory">y</span><span class="corz">z</span></span></a>
            </div>
          </div>
        </div>

        <ul class="nav-menu">
          <li>
            <a href="<?= get_option('home').'/busca'; ?>">Ver vagas</a>
          </li>
          <?php 
            $count_blog = wp_count_posts('post')->publish;
            if ($count_blog > 0): 
          ?>
          <li>
            <a href="<?= get_option('home').'/blog'; ?>">Nosso blog</a>
          </li>
          <?php endif; ?>
          <li>
            <a href="<?= get_option('home').'/whatsapp'; ?>">Whatsapp</a>
          </li>
          <li>
            <a href="<?= get_option('home').'/contato'; ?>">Contato</a>
          </li>
        </ul>
      </div>
    </nav>
    
    <?php if(!is_singular(array('vaga','servico')) && !is_author() && !is_category() && !is_page(array('Busca','Divulgador','Mobile','vagas-do-autor','posts-do-autor','posts-da-categoria','Empresa','Cidade','Estado','Área','perfil-recrutador'))): ?>
      <?php $count_posts = wp_count_posts('vaga')->publish; ?>
      <header class="site-header size-lg text-center" style="background-image: url(<?= get_template_directory_uri(); ?>/assets/img/bg-banner1.jpeg)"> 
        <div class="container">
          <div class="col-xs-12">
            <br><br>
            <h2 id="responsive_slogan">
              Temos<mark><?= $count_posts; ?></mark>novas vagas nesse momento... 
              <br> Não fique sem<mark>trampo!</mark>
            </h2>
            <h2 id="noresponsive_slogan">
              <span class="fastslogan"></span>
            </h2>
            <?php if(!is_singular(array('servico'))): ?>
              <h5 class="font-alt">Arrume seu trampo conosco</h5>
            <?php endif; ?>
            <?php if(!is_page('Home') && !is_404() && !is_search() && !is_page('Whatsapp')): ?>
              <h2>Você está em<mark><?php the_title(); ?></mark></h2>
            <?php elseif(is_404()): ?>
              <h2>Nada encontrado nesse endereço :(</h2>
            <?php elseif(is_search()): ?>
              <h2>Veja os resultados abaixo para "<?= get_search_query(); ?>"</h2>
            <?php elseif(is_page('Whatsapp')): ?>
              <h2>Seja bem vindo caro Visitante :D</h2>
            <?php endif; ?>
            <br><br><br>
            <?php if(is_page('Home') || is_404()): ?>
              <form class="header-job-search" method="GET" action="busca">
                <div class="input-keyword">
                  <input name="informacoes" type="text" class="form-control" placeholder="Código, Trampo, Descrição, Tipo ou Formação">
                </div>

                <div class="input-location">
                  <input name="dados" type="text" class="form-control" placeholder="Cidade ou Empresa">
                </div>

                <div class="btn-search">
                  <button class="btn btn-info" type="submit">Procurar trampo</button>
                </div>
              </form>
            <?php endif; ?>
          </div>

        </div>
      </header>
    <?php endif; ?>