<?php 

  if (isset($_GET['busca'])) $busca = $_GET['busca'];
  if (isset($_GET['area'])) $dados_query = $_GET['area'];

  get_header(); 
?>

    <style type="text/css">

      select option[disabled] {
          font-weight: bold;
          background: rgba(100, 100, 100, 0.2);
      }

      #entragrupo{
        display: none;
      }

    </style>

    <header class="page-header bg-img size-lg" style="background-image: url(<?= get_template_directory_uri(); ?>/assets/img/bg-banner1.jpeg);">
      <div class="container">
        <form action="#">
          <?php if (isset($_GET['area']) && $dados_query != ''): ?>
            <div class="row">
              <div class="col-xs-12 col-sm-12">
                <header class="section-header">
                  <span>Um pouco mais sobre</span>
                  <?php
                    $term = get_term_by('id', $dados_query, 'area'); 
                    $name = $term->name;

                    $args = array(
                      'post_type' => 'vaga',
                      'tax_query' => array(
                        array(
                          'taxonomy' => 'area',
                          'field' => 'term_id',
                          'terms' => array($dados_query)
                        )
                      )
                    );
                    $the_query = new WP_Query($args);

                    if($term->parent != 0){
                      $termp = get_term_by('id', $term->parent, 'area');
                      $namep = $termp->name;
                      $descricaop = term_description($termp->term_id, 'area');
                      if ($descricaop != ''){
                        $descricao = 'A área <b>'.$name.'</b> pertence ao setor <b>'.$namep.'</b> e possui '.$the_query->found_posts.' nova(s) vaga(s) vinculada(s) a ela.<br><div class="text-center"><small>'.$descricaop.'</small></div>';
                      }else{
                        $descricao = 'A área <b>'.$name.'</b> pertence ao setor <b>'.$namep.'</b> e possui '.$the_query->found_posts.' nova(s) vaga(s) vinculada(s) a ela.';
                      }
                    }else{
                      $descricao = term_description($term->ID, 'area');
                    }
                  ?>
                  <h2>Sobre a área <?= $name; ?></h2>
                </header>
                <p class="lead text-center">
                  <?php
                    if($descricao != ''){
                      echo $descricao;
                    } else {
                      echo 'Nenhuma informação sobre a área foi encontrada neste momento :(';
                    }
                  ?>
                </p>
              </div>
            </div>
            <br>
          <?php endif; ?>
          <div class="row">
            <div class="form-group col-xs-12 col-sm-12">
              <input type="text" name="busca" class="form-control" placeholder="Filtro: Codigo, nome, descrição, nivel ou formação" value="<?= $busca; ?>">
            </div>
            <div class="form-group col-xs-12 col-sm-12">
              <select name="area" class="form-control">
                <?php

                  if (isset($_GET['area']) && $dados_query != '') echo '<option value="'.$dados_query.'">'.$term->name.' (Selecionado)</option>';
                  else echo '<option value="">Selecione uma área para filtrar</option>';

                  // Versão "cool"
                  $categories = get_terms(array(
                      'taxonomy' => 'area',
                      'parent'   => 0,
                      'orderby'  => 'name',
                      'order'    => 'ASC',
                      'hide_empty' => '0' // para mostrar tudo
                    )
                  );

                  foreach( $categories as $category ) { 
                    echo '<option disabled><b>'.$category->name.'</b></option>';
                    $subcats = get_terms(array( 
                        'taxonomy' => 'area',
                        'parent'   => $category->term_id,
                        'orderby' => 'name',
                        'order' => 'ASC',
                        'hide_empty' => '0' //para mostrar tudo
                    ));
                    foreach ($subcats as $sc) {
                        if($sc->term_id != $dados_query){
                          echo '<option value="'.$sc->term_id.'">'.$sc->name.'</option>';
                        }
                    }
                  }
    
                ?>
              </select>
            </div>
          </div>

          <div class="button-group">
            <div class="action-buttons">
              <button class="btn btn-primary">Novo filtro</button>
            </div>
          </div>

        </form>

      </div>

    </header>

    <?php if($dados_query != ''): ?> 
    <main>
      <section class="no-padding-top">
        <div class="container">
          <div class="row">
            <header class="section-header">
              <span>Vagas recentes</span>
              <h2>Vagas nessa área</h2>
            </header>
            <div class="row item-blocks-connected col-sm-12">

            <?php 

              if ($busca != ''){
                $metadata_args = array(
                  'relation'  => 'OR',
                  array(         
                    'key'     => 'codigo_id', 
                    'value'   => $busca, 
                    'compare' => 'LIKE',
                    'type'    => 'STRING'  
                  ),
                  array(         
                    'key'     => 'nomesistema_id', 
                    'value'   => $busca, 
                    'compare' => 'LIKE',
                    'type'    => 'STRING'  
                  ),
                  array(         
                    'key'     => 'textarea_id', 
                    'value'   => $busca, 
                    'compare' => 'LIKE',
                    'type'    => 'STRING'  
                  ),
                  array(         
                    'key'     => 'formacao_id', 
                    'value'   => $busca, 
                    'compare' => 'LIKE',
                    'type'    => 'STRING'  
                  ),
                  array(         
                    'key'     => 'nivelvaga_id', 
                    'value'   => $busca, 
                    'compare' => 'LIKE',
                    'type'    => 'STRING'  
                  )
                );
              }

              $taxonomy_args = array(
                array(
                  'taxonomy' => 'area',
                  'field' => 'term_id',
                  'terms' => array($dados_query)
                )
              );

              $args = array(
                'post_type'        => 'vaga',
                'meta_key'         => 'textarea_id',
                'meta_query'       => $metadata_args,
                'tax_query'        => $taxonomy_args,
                'orderby'          => 'date',
                'order'            => 'DESC',
                'posts_per_page'   => -1
              );

              $loop = new WP_Query( $args );
              if( $loop->have_posts() && $ctrl_loop == 0): 
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
              else:
                echo '<div class="container text-center"><h4>Ainda não há vagas para esta área ou não encontramos para sua filtragem :(</h4></div>';
              endif;
            ?>
            </div>
          </div>
        </div>
      </section>
    </main>
    <?php endif; ?>

<?php get_footer(); ?>