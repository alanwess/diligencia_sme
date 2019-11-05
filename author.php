<?php 
  get_header(); 

  if (is_author()){
    $author = get_queried_object();
    $author_id = $author->ID;
  }

?>

    <header class="page-header bg-img" style="background-image: url(<?= get_template_directory_uri(); ?>/assets/img/bg-banner1.jpeg)">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-4">
            <img src="<?= scrapeImage(get_wp_user_avatar($post->post_author)); ?>" alt="" width="100%">
          </div>

          <div class="col-xs-12 col-sm-8 header-detail">
            <div class="hgroup">
              <h1><?= get_author_name($author_id);?></h1>
              <h3><?= get_the_author_meta('funcao_user',$author_id); ?></h3>
            </div>
            <hr>
            <p class="lead"><?= get_the_author_meta('description',$author_id); ?></p>

            <ul class="details cols-2">
              <li>
                <i class="fa fa-map-marker"></i>
                <span><?= get_the_author_meta('cidade_user',$author_id); ?> - <?= get_the_author_meta('estado_user',$author_id); ?></span>
              </li>

              <li>
                <i class="fa fa-graduation-cap"></i>
                <span><?= get_the_author_meta('formacao_user',$author_id); ?></span>
              </li>

              <li>
                <i class="fa fa-birthday-cake"></i>
                <span>
                  <?php 
                    if(!empty(get_the_author_meta('birth_date',$author_id))){
                      $aniversario = get_the_author_meta('birth_date',$author_id);
                      echo $aniversario["day"];
                      echo " de ";
                      echo $aniversario["month"];
                      echo " de ";
                      echo $aniversario["year"]; 
                    }
                  ?>  
                  </span>
              </li>

              <li>
                <i class="fa fa-envelope"></i>
                <a href="mailto:<?= get_the_author_meta('email',$author_id); ?>"><?= get_the_author_meta('email',$author_id); ?></a>
              </li>
            </ul>
          </div>
        </div>

        <div class="button-group">
          <ul class="social-icons">
            <?php

              if(!empty(get_the_author_meta('facebook',$author_id))) echo '<li><a class="facebook" href="'.get_the_author_meta('facebook',$author_id).'"><i class="fa fa-facebook"></i></a></li>';

              if(!empty(get_the_author_meta('twitter',$author_id))) echo '<li><a class="twitter" href="'.get_the_author_meta('twitter',$author_id).'"><i class="fa fa-twitter"></i></a></li>';

              if(!empty(get_the_author_meta('linkedin',$author_id))) echo '<li><a class="linkedin" href="'.get_the_author_meta('linkedin',$author_id).'"><i class="fa fa-linkedin"></i></a></li>';
              
              if(!empty(get_the_author_meta('googleplus',$author_id))) echo '<li><a class="google-plus" href="'.get_the_author_meta('googleplus',$author_id).'"><i class="fa fa-google-plus"></i></a></li>';
              
              if(!empty(get_the_author_meta('instagram',$author_id))) echo '<li><a class="instagram" href="'.get_the_author_meta('instagram',$author_id).'"><i class="fa fa-instagram"></i></a></li>';
              
              if(!empty(get_the_author_meta('youtube',$author_id))) echo '<li><a class="youtube" href="'.get_the_author_meta('youtube',$author_id).'"><i class="fa fa-youtube"></i></a></li>';

            ?>
          </ul>

          <div class="action-buttons">
            <a class="btn btn-gray" href="mailto:<?= get_the_author_meta('email',$author_id); ?>"><i class="fa fa-envelope"></i> Enviar email</a>
            <?php 

              if(!empty(get_the_author_meta('skype',$author_id))) echo '<button class="btn btn-info" data-toggle="modal" data-target="#modal-contact" onclick="location.href=\'skype:'.get_the_author_meta('skype',$author_id).'?chat\'"><i class="fa fa-skype"></i> Chamar no skype</button>';

              if(!empty(get_the_author_meta('whatsapp',$author_id))) echo '<button class="btn btn-success" data-toggle="modal" data-target="#modal-contact" onclick="location.href=\'https://api.whatsapp.com/send?phone=55'.get_the_author_meta('whatsapp',$author_id).'&text=Ol%C3%A1 '.get_author_name($author_id).'?! Peguei seu contato no site do *trampo.xyz*, podemos conversar?\'"><i class="fa fa-whatsapp"></i> Chamar no whatsapp</button>';

            ?>
          </div>
        </div>
      </div>
    </header>

    <main>

      <section>
        <div class="container">

          <header class="section-header">
            <span>Ultimas Vagas</span>
            <h2>Vagas do redator</h2>
          </header>
          
          <div class="row item-blocks-connected">

            <?php

              $args = array(
                'post_type' => 'vaga',
                'posts_per_page' => '5',
                'author__in' => array($author_id)
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
                echo '<p class="text-center"><a class="btn btn-info" style="margin-top: 20px;" href="vagas-do-autor?autorid='.$author_id.'">Ver todos os trampos</a></p>';
              else:
                echo '<div class="container text-center"><h4>O redator ainda não postou uma vaga</h4></div>';
              endif;
            ?>
          </div>

        </div>
      </section>

      <?php 

        $args = array( 'post_type' => 'post', 'author__in' => array($author_id));
        $loop = new WP_Query( $args );
        if ($loop->post_count > 0): 
      ?>
      <section>
        <div class="container">

          <header class="section-header">
            <span>Ultimos Posts</span>
            <h2>Posts do Redator</h2>
          </header>
          
          <div class="row item-blocks-connected">

            <?php

              $args = array(
                'post_type' => 'post',
                'posts_per_page' => '5',
                'author__in' => array($author_id)
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
                echo '<p class="text-center"><a class="btn btn-info" style="margin-top: 20px;" href="posts-do-autor?autorid='.$author_id.'">Ver todos os posts</a></p>';
              else:
                echo '<div class="container text-center"><h4>O redator ainda não fez um post</h4></div>';
              endif;
            ?>
          </div>

        </div>
      </section>
      <?php endif; ?>

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