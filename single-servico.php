<?php 
    get_header(); 

    if( have_posts() ):
      while( have_posts() ):
        the_post();
        setPostViews(get_the_ID());
        $servico_meta_data = get_post_meta( $post->ID );
        $link = get_the_permalink();
        $id_servico = $post->ID;
  ?>

    <header class="page-header bg-img size-lg" style="background-image: url(<?= get_template_directory_uri(); ?>/assets/img/bg-banner1.jpeg);">
      <div class="container page-name">
        <h2 id="responsive_slogan" class="text-center">
          Busque sua melhor oportunidade conosco.<br> Mude sua situação agora!
        </h2>
      </div>

      <div class="container">
        <div class="logo"><h1><i class="<?= esc_attr($servico_meta_data['servico_icone_id'][0]); ?>"></i> <?= esc_attr($servico_meta_data['servico_nome_id'][0]); ?></h1></div> 
        <hr>
        <p class="lead"><?= esc_attr($servico_meta_data['servico_textarea_id'][0]); ?></p>
      </div>

    </header>

    <main>

      <section>
        <div class="container">
          <div class="row">
            <div class="col-md-8 col-lg-9">

              <h1>Descrição do serviço</h1>
              <br>
              <?php the_content(); ?>
              <br>
              <h6 id="textcontato">Está interessado? Ficou alguma dúvida? Entre em contato conosco pelo nosso formulário de contato :)</h6>

              <div id="formulario" class="form">
                <hr>
                <h5>Entre em contato conosco logo abaixo para solicitar maiores informações sobre nossos serviços ;)</h5>
                <p>Por favor preencha as informações logo abaixo no formulário para que possamos entrar em contato com você para conversarmos e nos conhecermos um pouco melhor.</p>
                <form action="https://formspree.io/contato@trampe.xyz" method="POST">
                  <div class="form-group">
                    <select name="servico" class="form-control">
                      <option value="<?= esc_attr($servico_meta_data['servico_nome_id'][0]); ?>"><?= esc_attr($servico_meta_data['servico_nome_id'][0]); ?> (Selecionado)</option>
                      <?php
                        $args = array(
                          'post_type'        => 'servico',
                          'orderby'          => 'DATE',
                          'order'            => 'ASC'
                        );

                        $loop = new WP_Query( $args );
                        if( $loop->have_posts() && $ctrl_loop == 0): 
                          $count = $loop->post_count;
                          while( $loop->have_posts() ):
                            $loop->the_post();
                            $servicos_meta_data = get_post_meta( $post->ID ); 

                            echo '<option value="'.$servicos_meta_data['servico_nome_id'][0].'"">'.$servicos_meta_data['servico_nome_id'][0].'</option>';
                          endwhile;
                        endif;
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <input type="text" name="nome" class="form-control" placeholder="Seu nome completo" required>
                  </div>
                  <div class="form-group">
                    <input type="email" name="_replyto" class="form-control" placeholder="seuemail@exemplo.com" required>
                  </div>
                  <div class="form-group">
                    <input type="phone" name="whatsapp" class="form-control" placeholder="Whatsapp (Ex: 11 967534567)" required>
                  </div>
                  <div class="form-group">
                    <textarea name="mensagem" class="form-control" placeholder="Mensagem adicional ou dúvida ;)" required></textarea>
                  </div>

                  <input type="hidden" name="_next" value="https://trampo.xyz/obrigado" />
                  <input type="hidden" name="_subject" value="Nova solicitação de serviço" />
                  <input type="hidden" name="_language" value="pt-BR" />

                  <button type="submit" class="btn btn-primary">Quero mais informações! <i class="fa fa-info-circle"></i></button> 
                </form>
              </div>
              <hr>
              <header>
                <h3>Comentários</h3>
                <small><font size="1px">(Mantido pelo Facebook)</font></small>
              </header>

              <div class="fb-comments" width="100%" data-href="<?= $link; ?>" data-numposts="5"></div>
              <br><br>
            </div>
            <div class="col-md-4 col-lg-3">
              <style type="text/css">
                .item-block:after{
                  margin-top: 0px !important;  
                }

                .item-block{
                  margin-top: 0px !important;  
                }
              </style>
              <div class="widget">
                <h6 class="widget-title">Outros serviços</h6>
                <div class="widget-body item-blocks-connected"> 
                <?php
           
                  $args = array(
                    'post_type'        => 'servico',
                    'posts_per_page'   => 6
                  );

                  $loop = new WP_Query( $args );
                  if( $loop->have_posts()): 
                    while( $loop->have_posts() ):
                      $loop->the_post();
                      if($post->ID != $id_servico):
                ?> 
                    <a class="item-block" style="margin-top: 0 !important;" href="<?= the_permalink(); ?>">
                      <header>
                        <div class="hgroup">
                          <h6><?= the_title(); ?></h6>
                        </div>
                      </header>
                    </a>     
                <?php
                        endif;
                    endwhile;
                  endif;
                ?>  
                </div>
              </div>

              <div class="widget">
                <h6 id="vagasrelacionadas" class="widget-title">Vagas recentes</h6>
                <div class="widget-body item-blocks-connected"> 
                <?php

                  $args = array(
                    'post_type'        => 'vaga',
                    'orderby'         => 'date',
                    'order'           => 'desc',
                    'posts_per_page'   => 6
                  );

                  $loop = new WP_Query( $args );

                  if( $loop->have_posts()): 
                    $count_anuncio = 0;
                    while( $loop->have_posts() ):
                      $loop->the_post();
                      $search_meta_data = get_post_meta( $post->ID );
                ?> 
                    <a class="item-block" href="<?= the_permalink(); ?>">
                      <header>
                        <div class="hgroup">
                          <h6><?= the_title(); ?></h6>
                          <h5>
                            <?php 
                              if($search_meta_data['origemvaga_id'][0] == '')
                                echo "Via Trampo.xyz"; 
                              else
                                echo "Via ".$search_meta_data['origemvaga_id'][0];
                            ?>
                          </h5>
                        </div>
                      </header>
                    </a>     
                <?php 
                    endwhile;
                  endif;
                ?>  
                </div>
              </div>

              <div class="widget">
                <h6 class="widget-title">Posts Populares</h6>
                <ul class="widget-body media-list">
                  <?php

                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 6
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
                                    $output .= 'Em <a href="#" alt="' . esc_attr( sprintf( __( 'Veja todos os posts em %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
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
            </div>
          </div>
        </div>
      </section>

    </main> 

<?php
      endwhile;
    endif;
  
    get_footer(); 
?>