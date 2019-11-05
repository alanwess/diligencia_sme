<?php get_header(); ?>
 
    <main>
      <section>
        <div class="container">
          <header class="section-header">
            <h2>Nosso foco</h2>
          </header>

          <p>
            <?php 
              if ( have_posts() ) : 
                while ( have_posts() ) : 
                  the_post();
                  the_content();
                endwhile; 
              else: 
            ?>
              <p>Não foi encontrado nenhum conteúdo nesse momento.</p>
            <?php endif; ?>
          </p>

        </div>
      </section>

      <section class="bg-alt">
        <div class="container">
          <header class="section-header">
            <span>Quem somos nós</span>
            <h2>Nosso time</h2>
            <p>Atualmente somos apenas 4, mas em breve cresceremos...</p>
          </header>

        <div class="row equal-team-members">

          <div class="col-xs-12 col-sm-3 col-md-3">
            <div class="team-member">
              <h5>Jéssica Bianca <small>Recrutadora de RH & Coach de Carreiras</small></h5>
              <img width="200px" src="<?= get_template_directory_uri(); ?>/assets/img/jessica.jpg" alt="avatar">
              <ul class="social-icons">
                <li><a class="linkedin" href="https://www.linkedin.com/in/j%C3%A9ssica-bianca-71a455116/"><i class="fa fa-linkedin"></i></a></li>
              </ul>
            </div>
          </div>

          <div class="col-xs-12 col-sm-3 col-md-3">
            <div class="team-member">
              <h5>Alan Wesley <small>Front-end Developer & Divulgador de trampos em TI</small></h5>
              <img width="200px" src="<?= get_template_directory_uri(); ?>/assets/img/alan.jpg" alt="avatar">
              <ul class="social-icons">
                <li><a class="linkedin" href="https://www.linkedin.com/in/alan-w-356b4430/"><i class="fa fa-linkedin"></i></a></li>
              </ul>
            </div>
          </div>

          <div class="col-xs-12 col-sm-3 col-md-3">
            <div class="team-member">
              <h5>Fernanda Vitória <small>Divulgadora de trampos</small></h5>
              <img width="200px" src="<?= get_template_directory_uri(); ?>/assets/img/fernanda.jpg" alt="avatar">
              <ul class="social-icons">
                <li><a class="linkedin" href="https://www.linkedin.com/in/fernanda-souza-1383b3168/"><i class="fa fa-linkedin"></i></a></li>
              </ul>
            </div>
          </div>

          <div class="col-xs-12 col-sm-3 col-md-3">
            <div class="team-member">
              <h5>Lúcia Souza<small>Divulgadora de trampos na área da saúde</small></h5>
              <img width="200px" src="<?= get_template_directory_uri(); ?>/assets/img/lucia.jpg" alt="avatar">
              <ul class="social-icons">
                <li><a class="linkedin" href="https://www.linkedin.com/in/l%C3%BAcia-souza-752407168/"><i class="fa fa-linkedin"></i></a></li>
              </ul>
            </div>
          </div>

        </div>

      </section>


      <section class="bg-alt">
        <div class="container">
          <header class="section-header">
            <span>Quem faz o trampo</span>
            <h2>Nossos redatores e recrutadores</h2>
            <p>Eles são nossa razão de existir.</p>
            <i><small><font size="1px">Clique no icone do perfil do redator para exibir a pagina do autor</font></small></i>
          </header>

        <div class="row equal-team-members">

          <?php

            $args = array(
              'blog_id'      => $GLOBALS['blog_id'],
              //'role'         => 'author',
              'role__in'     => array(),
              'role__not_in' => array(),
              'meta_key'     => '',
              'meta_value'   => '',
              'meta_compare' => '',
              'meta_query'   => array(),
              'date_query'   => array(),        
              'exclude'      => array(4,7),
              'orderby'      => 'login',
              'order'        => 'DESC',
              'offset'       => '',
              'search'       => '',
              'number'       => '',
              'count_total'  => false,
              'fields'       => 'all',
              'who'          => '',
              'has_published_posts' => true
            ); 
            $users = get_users($args);

            foreach ($users as $user) 
            { 
             
              $nome = $user->display_name;
              $email = $user->user_email;
              $avatar = scrapeImage(get_wp_user_avatar($user->ID));
              $profile = get_author_posts_url( $user->ID );

          ?>

            <a href="<?= $profile; ?>">
              <div class="col-xs-12 col-sm-2 col-md-2">
                <div class="team-member">
                  <img width="100px" src="<?= $avatar; ?>" alt="<?= $nome; ?>">
                  <h6><a href="<?= 'mailto:'.$email; ?>"><?= $nome; ?></a></h6>
                </div>
              </div>
            </a>

          <?php
           
            }

          ?>
        </div>
      </section>
    </main>

<?php get_footer(); ?>