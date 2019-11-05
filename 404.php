<?php get_header(); //Template Name: Sobre ?>

    <main>
      <section>
        <div class="container">
          <h3>404: Pagina não encontrada</h3>
          <h5>Lamentamos o ocorrido :(</h5>
          <p>Infelizmente o conteúdo que procura não está mais disponivel em nosso site.</p>
          <br>
          <?php
            $count_blog = wp_count_posts('post')->publish;
            if ($count_blog > 0):
          ?>

          <h5>Já que está aqui, aproveite e conheça um pouco mais do nosso site :D. 
          <br>Veja logo abaixo as postagens do nosso blog que podem lhe agradar</h5>
          <br>

          <?php

              $args = array(
                'post_type' => 'post',
                'posts_per_page' => '3'
              );

              $loop = new WP_Query( $args );
              if( $loop->have_posts()):
                while( $loop->have_posts() ):
                  $loop->the_post();
          ?>

          <div class="col-sm-12 col-md-4" style="margin-bottom: 30px;">
            <header class="section-header text-left">
              <span>Blog: 
                <?php  
                  $categories = get_the_category();
                  $separator = ' ';
                  $output = '';
                  if ( ! empty( $categories ) ) {
                      foreach( $categories as $category ) {
                          $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'Veja todos os posts em %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
                      }
                      echo trim( $output, $separator );
                  }
                  ?>
              </span>
              <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
            </header>

            <p class="lead">
              <?php 
                $content = get_the_content(); 
                echo strip_tags(mb_strimwidth($content, 0, 500, '...')); 
              ?>
            </p>
            
            <br><br>
            <a class="btn btn-primary" href="<?php the_permalink() ?>">Ver mais</a>
          </div>

          <?php
                endwhile;
                echo '<div class="col-sm-12 col-md-12 text-center" style="display: block; margin-top: 30px">
              <a class="btn btn-primary" style="margin-top: 20px;" href="blog">Ver todos os Post</a>';
              else:
                echo '<div class="container text-center"><h4>Nenhum post encontrado neste momento</h4></div>';
              endif;
            endif;
          ?>
        </div>
      </section>

      <section class="bg-img text-center" style="background-image: url(<?= get_template_directory_uri(); ?>/assets/img/bg-banner1.jpeg">
        <div class="container">
          <h2><strong>Inscreva-se</strong></h2>
          <h6 class="font-alt"><?php if ($count_blog > 0) echo 'Gostou dos textos?!'; ?> Deixe-nos seu email e receba trampos e dicas exclusivas para sua vida profissional ;)</h6>
          <br><br>
          <form id="pfb-signup-submission" class="form-subscribe" action="#">
            <div class="input-group">
              <input id="pfb-signup-box-email" type="email" class="form-control input-lg" placeholder="Diga-nos seu email..." required>
              <span class="input-group-btn">
                <button id="pfb-signup-button" class="btn btn-success btn-lg" type="submit">Inscrever</button>
              </span>
            </div>
          </form>
        </div>
      </section>
    </main>

<?php get_footer(); ?>