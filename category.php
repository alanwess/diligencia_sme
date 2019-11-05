<?php 
  get_header(); 

  if (is_category()){
    $categoriaid = get_queried_object();
    $categorianame = get_the_category_by_ID($categoriaid->term_id);
    $categoriadesc = category_description($categoriaid->term_id);
  }

?>

    <header class="page-header bg-img size-lg" style="background-image: url(<?= get_template_directory_uri(); ?>/assets/img/bg-banner1.jpeg);">
      <div class="container">
        <div class="logo"><h1><i class="fa fa-archive"></i> <?= $categorianame; ?></h1></div>
        <hr>
        <p class="lead">
          <?php
             $args = array(
              'post_type'        => 'post',
              'category__in'     => array($categoriaid->term_id)
            );
            $loop = new WP_Query( $args );
            echo 'A categoria <b>'.$categorianame.'</b> possui <b>'.$loop->found_posts.'</b> novo(s) post(s) escrito(s) nesse momento em nossa plataforma<br>';

            if($categoriadesc != ''){
              echo $categoriadesc;
            } else {
              echo 'Nenhuma informação sobre a categoria foi encontrada neste momento :(';
            }
          ?>
        </p>
      </div>

    </header>

    <main>
      <section>
        <div class="container">

          <header class="section-header">
            <span>Ultimos Posts</span>
            <h2>Posts nessa categoria</h2>
          </header>
          
          <div class="row item-blocks-connected">

            <?php

              $args = array(
                'post_type' => 'post',
                'posts_per_page' => '10',
                'category__in' => array($categoriaid->term_id)
              );

              $loop = new WP_Query( $args );
              if( $loop->have_posts()):
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
                
                $url = 'http://trampo.xyz/';
                echo '<p class="text-center"><a class="btn btn-info" style="margin-top: 20px;" href="'.$url.'posts-da-categoria?categoriaid='.$categoriaid->term_id.'">Ver todos os posts</a></p>';
              else:
                echo '<div class="container text-center"><h4>Não foi encontrado nenhum post para essa categoria</h4></div>';
              endif;
            ?>
          </div>

        </div>
      </section>

      <section>
        <div class="container">
          <header>
            <h3>Comentários</h3>
            <small><font size="1px">(Mantido pelo Facebook)</font></small>
          </header>

          <div class="fb-comments" width="100%" data-href="<?= the_permalink(); ?>" data-numposts="5"></div>
          <br><br>
        </div>
      </section>
    </main>

<?php get_footer(); ?>  