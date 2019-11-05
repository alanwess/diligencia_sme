<?php get_header(); ?>

    <main>
      <section>
        <div class="container">
          <header class="section-header">
            <span>Recentemente</span>
            <h2>Trampos postados</h2>
          </header>

          <div class="row item-blocks-connected">

            <?php

              $args = array(
                'post_type' => 'vaga',
                'posts_per_page' => '5'
              );

              $loop = new WP_Query( $args );
              if( $loop->have_posts()):
                while( $loop->have_posts() ):
                  $loop->the_post();
                  $vagas_meta_data = get_post_meta( $post->ID );  
            ?>

            <div class="col-xs-12">
              <a class="item-block" href="<?= the_permalink(); ?>">
                <header>
                  <div class="logo"><?php the_post_thumbnail(); ?></div> 
                  <div class="hgroup">
                    <h4><?php the_title(); ?></h4>
                    <?php 

                      $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
                      $terms1 = wp_get_post_terms( $post->ID, 'empresa', $args );
                      $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
                      $terms2 = wp_get_post_terms( $post->ID, 'cidade', $args );
                      $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
                      $terms3 = wp_get_post_terms( $post->ID, 'estado', $args );

                    ?>
                    <h5><?= $terms1[0]->name; ?></h5>
                  </div>
                  <div class="header-meta">
                    <span class="location"><?= $terms2[0]->name.', '.$terms3[0]->name; ?></span>
                    <?php
                      if (strtolower(esc_attr( $vagas_meta_data['tipo_id'][0] )) == "temporário" || strtolower(esc_attr( $vagas_meta_data['tipo_id'][0] )) == "temporário")
                        echo '<span class="label label-danger">'.esc_attr( $vagas_meta_data['tipo_id'][0] ).'</span>';

                      if (strtolower(esc_attr( $vagas_meta_data['tipo_id'][0] )) == "efetivo")
                        echo '<span class="label label-success">'.esc_attr( $vagas_meta_data['tipo_id'][0] ).'</span>';

                      if (strtolower(esc_attr( $vagas_meta_data['tipo_id'][0] )) == "pj")
                        echo '<span class="label label-primary">'.esc_attr( $vagas_meta_data['tipo_id'][0] ).'</span>';

                      if (strtolower(esc_attr( $vagas_meta_data['tipo_id'][0] )) == "freelancer")
                        echo '<span class="label label-default">'.esc_attr( $vagas_meta_data['tipo_id'][0] ).'</span>';

                      if (strtolower(esc_attr( $vagas_meta_data['tipo_id'][0] )) == "estágio" || strtolower(esc_attr( $vagas_meta_data['tipo_id'][0] )) == "estágio")
                        echo '<span class="label label-info">'.esc_attr( $vagas_meta_data['tipo_id'][0] ).'</span>';

                      if (strtolower(esc_attr( $vagas_meta_data['tipo_id'][0] )) == "aprendiz")
                        echo '<span class="label label-warning">'.esc_attr( $vagas_meta_data['tipo_id'][0] ).'</span>';
                    ?>
                  </div>
                </header>
              </a>
            </div>
            <?php
                endwhile;
                echo '<p class="text-center"><a class="btn btn-info" style="margin-top: 20px;" href="busca?informacoes=&localizacao=">Ver novos trampos</a></p>';
              else:
                echo '<div class="container text-center"><h4>Nenhuma vaga a exibir no momento</h4></div>';
              endif;
            ?>
          </div>

          <br><br>
        </div>
      </section>

      <?php 
        $count_blog = wp_count_posts('post')->publish;
        if ($count_blog > 0): 
      ?>
      <section>
        <div class="container">
          <header class="section-header text-center">
              <span>Posts recentes</span>
              <h2>Nossos ultimos posts</h2>
          </header>

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
                echo str_replace('&nbsp;', ' ', strip_tags(mb_strimwidth($content, 0, 500, '...'))); 
              ?>
            </p>
            
            <br><br>
            <a class="btn btn-primary" href="<?php the_permalink() ?>">Ver mais</a>
          </div>

          <?php
              endwhile;
              echo '<div class="col-sm-12 col-md-12 text-center" style="display: block; margin-top: 30px">
            <a class="btn btn-primary" style="margin-top: 20px;" href="blog">Ver os novos posts</a>';
            else:
              echo '<div class="container text-center"><h4>Nenhum post encontrado neste momento</h4></div>';
            endif;
          ?>
          </div>
        </div>
      </section>
      <?php endif; ?>

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