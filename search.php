<?php get_header(); ?> 

    <main class="container blog-page">
      <div class="row"> 
        <div class="col-md-8 col-lg-9">
 
          <?php

            if(have_posts()):
              while(have_posts()):
                the_post();
          ?>

            <article class="post">
              <div class="post-media">
                <a href="<?= the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
              </div>

              <header>
                <h2><a href="<?= the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <time datetime="2016-04-04 20:00"><?php echo get_the_date(); ?>
                  <?php  
                        $categories = get_the_category();
                        $separator = ' ';
                        $output = '';
                        if ( ! empty( $categories ) ) {
                            foreach( $categories as $category ) {
                                $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'Veja todos os posts em %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
                            }
                            echo ', em '.trim( $output, $separator );
                        }
                  ?>
                </time>
                <ul class="post-meta">
                  <li><i class="fa fa-clock-o"></i> <?= tt_reading_time($post->ID); ?> | <i class="fa fa-comments"></i> <span class="fb-comments-count" data-href="<?= the_permalink(); ?>"></span></li>
                </ul>
              </header>

              <div class="blog-content">
                <p class="text-justify">
                  <?php 
                    $content = get_the_content(); 
                    echo str_replace('&nbsp;', ' ', strip_tags(mb_strimwidth($content, 0, 500, '...')));
                  ?>
                </p>
              </div>

              <p class="read-more">
                <a class="btn btn-primary btn-outline" href="<?= the_permalink(); ?>">Continue lendo</a>
              </p>
            </article>

          <?php
              endwhile;
          ?>

          <nav>
            <ul class="pager">
              <li class="previous"><?= get_previous_posts_link( '<i class="ti-arrow-left"></i> Posts Anteriores'); ?></li>
              <li class="next"><?= get_next_posts_link( 'Proximos Posts <i class="ti-arrow-right"></i>' , $loop->max_num_pages); ?></li>
            </ul>
          </nav>

          <?php
            else:
              echo '<h4>Não foi encontrado nenhum resultado para o termo "'.get_search_query().'"</h4><br>';
            endif;
          ?>
        </div>
        
        <?php 
          $count_blog = wp_count_posts('post')->publish;
          if ($count_blog > 0): 
        ?>
        <div class="col-md-4 col-lg-3">

          <div class="widget">
            <h6 class="widget-title">Buscar</h6>
            <div class="widget-body">
              <?php get_search_form(); ?>
            </div>
          </div>

          <div class="widget">
            <h6 class="widget-title">Populares</h6>
            <ul class="widget-body media-list">
              
              <?php

                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 5
                );

                $loop = new WP_Query( $args );
                if( $loop->have_posts() ):
                  while( $loop->have_posts() ):
                    $loop->the_post();
              ?>

                <li>
                  <div class="thumb"><a href="<?= the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></div>
                  <div class="content">
                    <h5><a href="<?= the_permalink(); ?>"><?php the_title(); ?></a></h5>
                    <time datetime="2016-04-04 20:00">
                      <?php echo get_the_date(); ?>
                      <br>  
                      <?php  
                        $categories = get_the_category();
                        $separator = ' ';
                        $output = '';
                        if ( ! empty( $categories ) ) {
                            foreach( $categories as $category ) {
                                $output .= 'Seção <a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'Veja todos os posts em %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
                            }
                            echo trim( $output, $separator );
                        }
                      ?>
                    </time>
                  </div>
                </li>

              <?php
                  endwhile;
                endif;
              ?>
  
            </ul>
          </div>

          <div class="widget widget_categories">
            <h6 class="widget-title">Categorias</h6>
            <ul class="widget-body">
              <?php
                $taxonomies = get_terms( array(
                    'taxonomy' => 'category',
                    'exclude'   => 4,
                    'hide_empty' => false
                ) );
                 
                if ( !empty($taxonomies) ) :
                    foreach( $taxonomies as $categoria ) {
                      $categoria_esc .= '<li class="cat-item"><a href="' . esc_url( get_category_link( $categoria->term_id ) ) . '">'. esc_attr( $categoria->name ) .'</a></li>';
                    }
                    echo $categoria_esc;
                endif;
              ?>
            </ul>
          </div>

          <div class="widget">
            <h6 class="widget-title">Conteúdo VIP</h6>
            <div class="widget-body">
              <div class="team-member">
                <h5>Seja nosso assinante GRATIS!</h5>
                <p>Insira seu endereço de email abaixo e receba as novidades e vagas gratuitamente no seu email ;)</p>
                <form id="pfb-signup-submission" class="form-subscribenews" action="#">
                  <div class="input-group">
                    <input id="pfb-signup-box-email" type="email" class="form-control input-lg" placeholder="Diga-nos seu email..." required>
                    <button id="pfb-signup-button" class="btn btn-info" type="submit">Inscrever</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <script>
          $('#pfb-signup-submission').submit(function(event) {
            event.preventDefault();

            // Get data from form and store it
            var pfbSignupFNAME = 'Querido';
            var pfbSignupLNAME = 'Visitante';
            var pfbSignupEMAIL = $('#pfb-signup-box-email').val();

            // Create JSON variable of retreived data
            var pfbSignupData = {
              'firstname': pfbSignupFNAME,
              'lastname': pfbSignupLNAME,
              'email': pfbSignupEMAIL
            };

            // Send data to PHP script via .ajax() of jQuery
            $.ajax({
              type: 'POST',
              dataType: 'json',
              url: '<?php echo get_template_directory_uri()."/mailchimpsignup.php"; ?>',
              data: pfbSignupData,
              beforeSend: function(){
                 $("#pfb-signup-button").html('Inscrevendo...');
              },
              success: function (results) {
                $('#pfb-signup-box-email').attr('disabled',true);
                console.log(results);
                $("#pfb-signup-button").html('Inscrito <i class="fa fa-check"></i>');
                $('#pfb-signup-button').attr('disabled',true);
              },
              error: function (results) {
                window.alert('Nos desculpe, ocorreu um erro ao tentar te adicionar na lista de amigos :(');
                console.log(results);
              }
            });
          });
        </script>

        </div>      
      </div>
    </main>

<?php get_footer(); ?>