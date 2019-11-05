<?php 

  if (isset($_GET['busca'])) $busca = $_GET['busca'];
  if (isset($_GET['categoriaid'])) $categoria = $_GET['categoriaid'];

  get_header(); 
?>

    <header class="page-header bg-img size-lg" style="background-image: url(<?= get_template_directory_uri(); ?>/assets/img/bg-banner1.jpeg);">
      <div class="container">
        <form action="#">
          <?php if (isset($_GET['categoriaid']) && $categoria != ''): ?>
            <div class="row">
              <div class="col-xs-12 col-sm-12">
                <header class="section-header">
                  <span>Detalhes sobre</span>
                  <?php 
                    $term = get_term_by('id', $categoria, 'category'); 
                    $name = $term->name;
                    $descricao = term_description($term->ID, 'category');
                  ?>
                  <h2>A categoria <?= $name; ?></h2>
                </header>
                <p class="lead text-center">
                  <?php
                    $args = array(
                      'post_type'        => 'post',
                      'category__in'     => array($categoria)
                    );
                    $loop = new WP_Query( $args );
                    echo 'A categoria <b>'.$name.'</b> possui <b>'.$loop->found_posts.'</b> novo(s) post(s) escrito(s) nesse momento em nossa plataforma<br>';

                    if($descricao != ''){
                      echo '<div class="text-center"><small>'.$descricao.'</small></div>';
                    } else {
                      echo '<div class="text-center"><small>Nenhuma informação sobre a categoria foi encontrada neste momento :(</small></div>';
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
              <select name="categoriaid" class="form-control">
                <?php
                  if (isset($_GET['categoriaid']) && $categoria != '') echo '<option value="'.$categoria.'">'.$name.' (Selecionado)</option>';
                  else echo '<option value="">Selecione uma categoria para filtrar</option>';

                  $taxonomies = get_terms( array(
                      'taxonomy' => 'category',
                      'exclude'   => 1,
                      'hide_empty' => false
                  ) );
                   
                  if ( !empty($taxonomies) ) :
                      foreach( $taxonomies as $category ) {
                        if ($categoria != $category->term_id) $categoria_esc .= '<option value="'.esc_attr($category->term_id).'">'.esc_attr( $category->name ).'</option>';
                      }
                      echo $categoria_esc;
                  endif;
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

    <?php if($categoria != ''): ?> 
    <main>
      <section class="no-padding-top">
        <div class="container">
          <div class="row">
            <header class="section-header">
              <span>Posts recentes</span>
              <h2>Posts da categoria</h2>
            </header>
            <div class="row item-blocks-connected col-sm-12">

            <?php 

              $args = array(
                'post_type'        => 'post',
                'orderby'          => 'date',
                'order'            => 'DESC',
                'category__in'     => array($categoria),
                's'                => $busca,
                'posts_per_page'   => -1
              );

              $loop = new WP_Query( $args );
              if( $loop->have_posts() && $ctrl_loop == 0): 
                  while( $loop->have_posts() ):
                    $loop->the_post(); 
            ?>

            <div class="col-xs-12">
              <a class="item-block" href="<?= the_permalink(); ?>">
                <header>
                  <div class="logo"><?php the_post_thumbnail(); ?></div> 
                  <div class="hgroup">
                    <h4><?php the_title(); ?></h4>
                    <h5>
                    <?php  
                      $categories = get_the_category();
                      $separator = ' ';
                      $output = '';
                      if ( ! empty( $categories ) ) {
                          foreach( $categories as $category ) {
                              $output .=  esc_html( $category->name );
                          }
                          echo $output;
                      }
                    ?>
                    </h5>
                  </div>
                </header>
              </a>
            </div>
            
            <?php
                endwhile;
              else:
                echo '<div class="container text-center"><h4>Não há nenhum post para está categoria ou não encontramos para sua filtragem :(</h4></div>';
              endif;
            ?>
            </div>
          </div>
        </div>
      </section>
    </main>
    <?php endif; ?> 

<?php get_footer(); ?>