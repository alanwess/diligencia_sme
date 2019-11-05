<?php get_header(); ?> 

    <header class="page-header bg-img size-lg" style="background-image: url(<?= get_template_directory_uri(); ?>/assets/img/bg-banner1.jpeg);">
      <div class="container page-name">
        <h2 id="responsive_slogan" class="text-center">
          Busque sua melhor oportunidade conosco.<br> Mude sua situação agora!
        </h2>
        <h5 class="font-alt text-center">Encontre seu trampo logo abaixo</h5>
      </div>

      <div class="container">
        <form action="/busca">
          <?php 
            $param1 = array_key_exists('informacoes', $_GET);
            $param2 = array_key_exists('dados', $_GET);
            $check = 0;
            $controli = 0;
            $controll = 0;
            $libera_all = 0;

            if($param1 || $param2){
              if($param1)
                if($_GET['informacoes'] != ''){
                   $informacoes_query = $_GET['informacoes'];
                   $controli = 1;
                }else{
                   $check++;
                }

              if($param2)
                if($_GET['dados'] != ''){ 
                   $dados_query = $_GET['dados'];
                   $controll = 1;
                }else{
                   $check++;
                }

                if($check == 2) echo '<h4>Todas os novos trampos foram listados abaixo</h4>';
                else{
                  if($controli == 1 && $controll == 1) 
                    echo '<h4>Você pesquisou por "'.$informacoes_query.'" em "'.$dados_query.'", veja os trampos abaixo</h4>';
                  elseif ($controli == 1) 
                    echo '<h4>Você pesquisou por "'.$informacoes_query.'", veja os trampos abaixo</h4>';
                  elseif ($controll == 1) 
                    echo '<h4>Você pesquisou por "'.$dados_query.'", veja os trampos abaixo</h4>';
                }

            } else {
              $libera_all = 1;
            }
          ?>

          <div class="row">
            <div class="form-group col-xs-12 col-sm-6">
              <input type="text" name="informacoes" class="form-control" placeholder="Informações: Código, Trampo, Descrição, Tipo ou Formação" value="<?= $informacoes_query ?>">
            </div>

            <div class="form-group col-xs-12 col-sm-6">
              <input type="text" name="dados" class="form-control" placeholder="Dados: Cidade ou Empresa" value="<?= $dados_query ?>">
            </div>
          </div>

          <div class="button-group">
            <div class="action-buttons">
              <button class="btn btn-primary">Nova Pesquisa</button>
            </div>
          </div>

        </form>

      </div>

    </header>

    <main>
      <section class="no-padding-top">
        <div class="container">
          <div class="row">

          <?php 

            /*$ctrl_loop = 0;
            if (!$param1 && !$param2)
              $ctrl_loop = 1;*/

            if($informacoes_query != ''){
              $metadata_args = array(
                'relation'  => 'OR',
                array(         
                  'key'     => 'codigo_id', 
                  'value'   => $informacoes_query, 
                  'compare' => 'LIKE',
                  'type'    => 'STRING'  
                ),
                array(         
                  'key'     => 'nomesistema_id', 
                  'value'   => $informacoes_query, 
                  'compare' => 'LIKE',
                  'type'    => 'STRING'  
                ),
                array(         
                  'key'     => 'textarea_id', 
                  'value'   => $informacoes_query, 
                  'compare' => 'LIKE',
                  'type'    => 'STRING'  
                ),
                array(         
                  'key'     => 'formacao_id', 
                  'value'   => $informacoes_query, 
                  'compare' => 'LIKE',
                  'type'    => 'STRING'  
                ),
                array(         
                  'key'     => 'nivelvaga_id', 
                  'value'   => $informacoes_query, 
                  'compare' => 'LIKE',
                  'type'    => 'STRING'  
                )
              );
            }

            if($dados_query != '') {
              $dados_query = createSlug(tirarAcentos($dados_query));

              $taxonomy_args = array(
                'relation' => 'OR',
                array(
                  'taxonomy' => 'cidade',
                  'field' => 'slug',
                  'terms' => array($dados_query)
                ),
                array(
                  'taxonomy' => 'empresa',
                  'field' => 'slug',
                  'terms' => array($dados_query)
                )
              );
            }

            $preargs = array(
              'post_type'        => 'vaga',
              'meta_query'       => $metadata_args,
              'tax_query'        => $taxonomy_args,
              'posts_per_page'   => -1
            );
            $countloop = new WP_Query($preargs);

            $paged = (get_query_var('paged') ) ? get_query_var('paged') : 1;
            $args = array(
              'post_type'        => 'vaga',
              'meta_query'       => $metadata_args,
              'tax_query'        => $taxonomy_args,
              'orderby'          => 'date',
              'order'            => 'DESC',
              'posts_per_page'   => 20,
              'paged'            => $paged
            );

            $loop = new WP_Query( $args );
            if($loop->have_posts()): 
          ?>

            <div class="col-xs-12">
              <br>
              <?php 
                if($check != 2 && $libera_all == 0){
                  if ($countloop->post_count > 20) 
                    echo '<h4>Nós encontramos <strong>'.$countloop->post_count.'</strong> resultado(s), mostraremos de 20 em 20 - Página '.$paged.'</h4>';
                  else echo '<h4>Nós encontramos <strong>'.$countloop->post_count.'</strong> resultado(s)</h4>';
                } else {
                  if ($countloop->post_count > 20) 
                    echo '<h4>Listagem de vagas concluída! Elas serão mostradas de 20 em 20 - Página '.$paged.'</h4>';
                }
              ?>
            </div>

          <?php
              $count_int = 0;
              while( $loop->have_posts() ):
                $loop->the_post();
                $vagas_meta_data = get_post_meta( $post->ID ); 
          ?>

            <div class="col-xs-12">
              <a class="item-block" href="<?= the_permalink(); ?>">
                <header>
                  <div class="logo"><?php the_post_thumbnail(); ?></div> 
                  <div class="hgroup">
                    <h4><?= esc_attr($vagas_meta_data['codigo_id'][0]).' - '.esc_attr($vagas_meta_data['nomesistema_id'][0]); ?></h4>
                    <h5>
                      <?php 
                        $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
                        $terms1 = wp_get_post_terms( $post->ID, 'empresa', $args );
                        $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
                        $terms2 = wp_get_post_terms( $post->ID, 'cidade', $args );
                        $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
                        $terms3 = wp_get_post_terms( $post->ID, 'estado', $args );

                        echo '<i class="fa fa-briefcase"></i> '.$terms1[0]->name.' - <i class="fa fa-map-marker"></i> '.$terms2[0]->name.'/'.$terms3[0]->name;

                        if (strtolower(esc_attr( $vagas_meta_data['tipo_id'][0] )) == "temporário")
                          echo '<span class="label label-danger">'.esc_attr( $vagas_meta_data['tipo_id'][0] ).'</span>';

                        if (strtolower(esc_attr( $vagas_meta_data['tipo_id'][0] )) == "efetivo")
                          echo '<span class="label label-success">'.esc_attr( $vagas_meta_data['tipo_id'][0] ).'</span>';

                        if (strtolower(esc_attr( $vagas_meta_data['tipo_id'][0] )) == "pj")
                          echo '<span class="label label-primary">'.esc_attr( $vagas_meta_data['tipo_id'][0] ).'</span>';

                        if (strtolower(esc_attr( $vagas_meta_data['tipo_id'][0] )) == "freelancer")
                          echo '<span class="label label-default">'.esc_attr( $vagas_meta_data['tipo_id'][0] ).'</span>';

                        if (strtolower(esc_attr( $vagas_meta_data['tipo_id'][0] )) == "estágio")
                          echo '<span class="label label-info">'.esc_attr( $vagas_meta_data['tipo_id'][0] ).'</span>';

                        if (strtolower(esc_attr( $vagas_meta_data['tipo_id'][0] )) == "aprendiz")
                          echo '<span class="label label-warning">'.esc_attr( $vagas_meta_data['tipo_id'][0] ).'</span>';

                        ?>
                    </h5>
                  </div>
                </header>

                <div class="item-body" style="word-wrap: break-word">
                  <p><?= esc_attr( $vagas_meta_data['textarea_id'][0] ); ?></p>
                </div>

                <footer>
                  <ul class="details cols-3 text-center">
                    <li>
                      <i class="fa fa-money"></i>
                      <span>
                      <?php
                        if ($vagas_meta_data['salario_id'][0] == ''){
                          echo 'À combinar';
                        } else {
                          echo esc_attr($vagas_meta_data['salario_id'][0]); 
                        }
                      ?> 
                      </span>
                    </li>

                    <li>
                      <i class="fa fa-level-up"></i>
                      <span><?= esc_attr( $vagas_meta_data['nivelvaga_id'][0] ); ?></span>
                    </li>

                    <li>
                      <i class="fa fa-graduation-cap"></i>
                      <span href="#"><?= esc_attr( $vagas_meta_data['formacao_id'][0] ); ?></span>
                    </li>
                  </ul>
                </footer>
              </a>
            </div>
          <?php
                $count_int++;
                if($count_int % 6 == 0):
          ?>
          <div>
            <div class="ads-feed col-xs-12 text-center">
              <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
              <ins class="adsbygoogle ads-shadow"
                   style="display:block"
                   data-ad-format="fluid"
                   data-ad-layout-key="-f1+2u+c7-9v-97"
                   data-ad-client="ca-pub-4807449657289752"
                   data-ad-slot="5647705551"></ins>
              <script>
                   (adsbygoogle = window.adsbygoogle || []).push({});
              </script>
            </div>
          </div>
          <?php
                endif;
              endwhile;
            else:
              if($param1 || $param2)
                echo '<h4 class="text-center">Nenhum item encontrado para a busca :(</h4>';
            endif;
          ?>
          </div>

          <?php if($countloop->post_count > 20): ?>
          <div class="row">
            <div class="col-xs-12">
              <nav style="margin-top: 20px;">
                <ul class="pager">
                  <li class="previous"><?= get_previous_posts_link( '<i class="ti-arrow-left"></i> Vagas anteriores'); ?></li>
                  <li class="next"><?= get_next_posts_link( 'Proximas Vagas <i class="ti-arrow-right"></i>' , $loop->max_num_pages); ?></li>
                </ul>
              </nav>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </section>
    </main>

<?php get_footer(); ?>