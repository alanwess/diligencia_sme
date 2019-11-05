<?php 

  if (isset($_GET['busca'])) $busca = $_GET['busca'];
  if (isset($_GET['autorid'])) $autor = $_GET['autorid']; 

  get_header(); 
?>

    <header class="page-header bg-img size-lg" style="background-image: url(<?= get_template_directory_uri(); ?>/assets/img/bg-banner1.jpeg);">
      <div class="container">
        <form action="#">
          <?php if (isset($_GET['autorid']) && $autor != ''): ?>
            <div class="row">
              <div class="col-xs-12 col-sm-12">
                <header class="section-header">
                  <span>Um pouco sobre</span>
                  <?php 
                    $name = get_the_author_meta('display_name', $autor);
                  ?>
                  <h2>Sobre o autor <?= $name; ?></h2>
                </header>
                <p class="lead text-center">
                  <?php
                    $args = array(
                      'post_type'        => 'vaga',
                      'author__in'       => array($autor)
                    );
                    $loop = new WP_Query( $args );
                    echo 'O(A) autor(a) <b>'.$name.'</b> possui <b>'.$loop->found_posts.'</b> nova(s) vaga(s) atreladas(s) a ele(a) nesse momento em nossa plataforma<br>';

                    $descricao = get_the_author_meta('description',$autor);
                    if($descricao != ''){
                      echo '<div class="text-center"><small>'.$descricao.'</small></div>';
                    } else {
                      echo '<div class="text-center"><small>Nenhuma informação sobre a área foi encontrada neste momento :(</small></div>';
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
              <select name="autorid" class="form-control">              
                <?php
                  if (isset($_GET['autorid']) && $autor != '') echo '<option value="'.$autor.'">'.$name.' (Selecionado)</option>';
                  else echo '<option value="">Selecione um autor para filtrar</option>'; 

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
                    'exclude'      => array(),
                    'orderby'      => 'login',
                    'order'        => 'ASC',
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
                    if($user->ID != $autor)
                    {
                ?>

                <option value="<?= $user->ID; ?>"><?= $user->display_name; ?></option>

                <?php
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

    <?php if($autor != ''): ?> 
    <main>
      <section class="no-padding-top">
        <div class="container">
          <div class="row">
            <header class="section-header">
              <span>Vagas recentes</span>
              <h2>Vagas do autor</h2>
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

              $args = array(
                'post_type'        => 'vaga',
                'author__in'       => array($autor),
                'meta_key'         => 'textarea_id',
                'meta_query'       => $metadata_args,
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
                echo '<div class="container text-center"><h4>O autor ainda não postou uma vaga ou não encontramos para sua filtragem :(</h4></div>';
              endif;
            ?>
            </div>
          </div>
        </div>
      </section>
    </main>
    <?php endif; ?>

<?php get_footer(); ?>