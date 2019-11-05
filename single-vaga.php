<?php 
    get_header();  

      if( have_posts() ):
        while( have_posts() ):
          the_post();
          setPostViews(get_the_ID());
          $vagas_meta_data = get_post_meta( $post->ID );
          $link_facebook = get_the_permalink();
          $id_vaga = $post->ID;
?>

      <header class="page-header bg-img size-lg" style="background-image: url(<?= get_template_directory_uri(); ?>/assets/img/bg-banner1.jpeg)">
        <div class="container">
          <div class="header-detail">
            <div class="logo"><?php the_post_thumbnail(); ?></div> 
            <div class="hgroup">
              <h1 style="word-wrap: break-word"><?= esc_attr( $vagas_meta_data['nomesistema_id'][0] ); ?></h1>
              <h3>
                <?php 
                  $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
                  $terms1 = wp_get_post_terms( $post->ID, 'empresa', $args );
                  $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
                  $terms2 = wp_get_post_terms( $post->ID, 'cidade', $args );
                  $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
                  $terms3 = wp_get_post_terms( $post->ID, 'estado', $args );

                  echo '<a href="https://trampo.xyz/empresa/?empresa='.createSlug(tirarAcentos($terms1[0]->term_id)).'">'.$terms1[0]->name.'</a> - <a href="https://trampo.xyz/cidade/?cidade='.createSlug(tirarAcentos($terms2[0]->term_id)).'">'.$terms2[0]->name.'</a>/<a href="https://trampo.xyz/estado/?estado='.createSlug(tirarAcentos($terms3[0]->term_id)).'">'.$terms3[0]->name.'</a>';
                  
                  if ($vagas_meta_data['premiumvaga_id'][0] == "Sim") echo ' - <i class="fa fa-star" style="color: yellow;"></i> (Vaga Patrocinada)'; 

                  $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
                  $terms4 = wp_get_post_terms( $post->ID, 'area', $args );
                ?>    
              </h3>
            </div>
            <time>
              <?php 
                if($vagas_meta_data['origemvaga_id'][0] == '')
                  echo 'Área: <a href="https://trampo.xyz/area/?area='.createSlug(tirarAcentos($terms4[0]->term_id)).'">'.$terms4[0]->name.'</a> - Via Trampo.xyz'; 
                else
                  echo 'Área: <a href="https://trampo.xyz/area/?area='.createSlug(tirarAcentos($terms4[0]->term_id)).'">'.$terms4[0]->name.'</a> - Via '.$vagas_meta_data['origemvaga_id'][0];
              ?>
            </time>
            <hr>
            <p class="lead" style="word-wrap: break-word"><?= esc_attr( $vagas_meta_data['textarea_id'][0] ); ?></p>

            <ul class="details cols-2">

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
                <i class="fa fa-briefcase"></i>
                <span><?= esc_attr( $vagas_meta_data['tipo_id'][0] ); ?></span>
              </li>

              <li>
                <i class="fa fa-level-up"></i>
                <span><?= esc_attr( $vagas_meta_data['nivelvaga_id'][0] ); ?></span>
              </li>

              <li>
                <i class="fa fa-graduation-cap"></i>
                <span><?= esc_attr( $vagas_meta_data['formacao_id'][0] ); ?></span>
              </li>
            </ul>

            <div class="button-group">
              <ul class="social-icons">
                <li class="title">Compartilhar no</li>
                <?php

                  $useragent=$_SERVER['HTTP_USER_AGENT'];

                  if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))):

                ?>
                <li><a class="whatsapp" href="whatsapp://send?text=*<?php the_title(); ?>*<?php if($vagas_meta_data['textarea_id'][0] == '') echo esc_attr($vagas_meta_data['textarea_id'][0] ); else echo esc_attr(' - '.$vagas_meta_data['textarea_id'][0] );?> - <?= the_permalink(); ?>"><i class="fa fa-whatsapp"></i></a></li>
                <?php else: ?>
                <li><a class="pinterest" href="http://pinterest.com/pin/create/button/?url=<?= the_permalink(); ?>&media=<?= get_the_post_thumbnail_url($post->ID,'full'); ?>"><i class="fa fa-pinterest"></i></a></li>
                <?php endif; ?>
                <li><a class="facebook" href="http://www.facebook.com/sharer.php?u=<?= the_permalink(); ?>"><i class="fa fa-facebook"></i></a></li>
                <li><a class="twitter" href="http://twitter.com/share?url=<?= the_permalink(); ?>&text=<?php the_title(); ?>"><i class="fa fa-twitter"></i></a></li>
                <li><a class="linkedin" href="javascript:void(0)" onclick="window.open( 'http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>', 'sharer', 'toolbar=0, status=0, width=626, height=436');return false;" title="<?php the_title(); ?>"><i class="fa fa-linkedin"></i></a></li>
                <?php

                  $useragent=$_SERVER['HTTP_USER_AGENT'];

                  if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))):

                ?>
                <li><a class="git" href="mailto:?subject=Trampo.xyz: <?php the_title(); ?>&body=<?= esc_attr( $vagas_meta_data['textarea_id'][0] ); ?>%0D%0A %0D%0A Disponível em: <?= the_permalink(); ?>"><i class="fa fa-envelope"></i></a></li>
                <?php else: ?>
                <li><a class="google-plus" href="https://plus.google.com/share?url=<?= the_permalink(); ?>"><i class="fa fa-google-plus"></i></a></li>
                <li><a class="git" href="mailto:?subject=Trampo.xyz: <?php the_title(); ?>&body=<?= esc_attr( $vagas_meta_data['textarea_id'][0] ); ?>%0D%0A %0D%0A Disponível em: <?= the_permalink(); ?>"><i class="fa fa-envelope"></i></a></li>
                <?php endif; ?>
              </ul>
            </div>
          </div>
        </div>
      </header>

      <div class="text-center">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- Pre-content -->
		<ins class="adsbygoogle"
		     style="display:block"
		     data-ad-client="ca-pub-4807449657289752"
		     data-ad-slot="2327796935"
		     data-ad-format="auto"
		     data-full-width-responsive="true"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
      </div>

      <main>
        <section>
          <div class="container">
            <div class="row">
              <div class="col-md-8 col-lg-9">
                <h1><?php the_title(); ?></h1>
                <br>
                <h3>Detalhes do trampo:</h3>
                <h5>Codigo do trampo: <?= esc_attr( $vagas_meta_data['codigo_id'][0] ); ?></h5>
                <style type="text/css">
                  .content-vaga{
                    word-wrap: break-word;
                    color: #7e8890 !important; 
                  }

                  .content-vaga p{
                    font-family: Open Sans, sans-serif !important; 
                    font-size: 15px !important;
                    color: #7e8890 !important;
                    line-height: 28px !important;
                  }

                  .content-vaga span{
                    font-family: Open Sans, sans-serif !important; 
                    font-size: 15px !important;
                    color: #7e8890 !important;
                    line-height: 28px !important;
                  }

                  .content-vaga li{
                    font-family: Open Sans, sans-serif !important; 
                    font-size: 15px !important;
                    color: #7e8890 !important;
                    line-height: 28px !important;
                  }
                </style>
                <div class="content-vaga"><?php 
                  $conteudo = get_the_content();
                  $conteudo = str_replace('Trampe.xyz', 'Trampo.xyz', $conteudo); 
                  $conteudo = str_replace('•', '<br>•', $conteudo); 
                  echo $conteudo;
                ?></div>
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- Pos-content -->
				<ins class="adsbygoogle"
				     style="display:block"
				     data-ad-client="ca-pub-4807449657289752"
				     data-ad-slot="6946054010"
				     data-ad-format="auto"
				     data-full-width-responsive="true"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
                <div id="candidatar">  
                  <br>
                  <?php
                    $link = "";
                    if($vagas_meta_data['origemvaga_id'][0] == "Email" || $vagas_meta_data['origemvaga_id'][0] == "email" || $vagas_meta_data['origemvaga_id'][0] == "E-mail" || $vagas_meta_data['origemvaga_id'][0] == "e-mail"){
                  ?>
                    <h6>Para se candidatar envie um email para <?= $vagas_meta_data['linkvaga_id'][0]; ?> com o título da vaga</h6>
                  <?php
                    } else {
                      $link = $vagas_meta_data['linkvaga_id'][0];
                  ?>
                    <h6>Clique no botão abaixo para acessar a vaga e se candidatar...</h6>
                    <a class="btn btn-primary" href="<?= $link; ?>">Me candidatar! <i class="fa fa-arrow-right"></i></a>
                  <?php
                    }
                  ?>
                </div>
                <div class="post-meta col-md-12" style="margin-bottom: 30px">
                  <form action="/busca"">
                    <h3><i class="fa fa-bookmark"></i> Encontre resultados similares</h3>
                    <div class="form-group col-md-4">
                      <input type="text" name="informacoes" class="form-control" style="border-radius: 3px" placeholder="<?= esc_attr($vagas_meta_data['nomesistema_id'][0]); ?>" required>
                    </div>
                    <div class="form-group col-md-4">
                      <input type="text" name="dados" class="form-control" style="border-radius: 3px" placeholder="<?= $terms2[0]->name; ?>" required>
                    </div>
                    <div class="form-group col-md-4">
                      <button class="btn btn-primary" style="width: 100%"><i class="fa fa-search"></i> Encontrar</button>
                    </div>
                  </form>
                </div>
                <ul class="post-meta">
                  <li>
                    <h5><i class="fa fa-link"></i> Links relacionados da vaga</h5>
                  </li>
                  <li>
                    <strong>Empresa: </strong>
                    <?= '<a href="https://trampo.xyz/empresa/?empresa='.createSlug(tirarAcentos($terms1[0]->term_id)).'">'.$terms1[0]->name.'</a>'; ?>
                  </li>
                  <li>
                    <strong>Área: </strong>
                    <?= '<a href="https://trampo.xyz/area/?area='.createSlug(tirarAcentos($terms4[0]->term_id)).'">'.$terms4[0]->name.'</a>'; ?>
                  </li>
                  <li>
                    <strong>Cidade: </strong>
                    <?= '<a href="https://trampo.xyz/cidade/?cidade='.createSlug(tirarAcentos($terms2[0]->term_id)).'">'.$terms2[0]->name.'</a>'; ?>
                  </li>
                  <li>
                    <strong>Estado: </strong>
                    <?= '<a href="https://trampo.xyz/estado/?estado='.createSlug(tirarAcentos($terms3[0]->term_id)).'">'.$terms3[0]->name.'</a>'; ?>
                  </li>
                  <li>
                    <strong>Redator: </strong>
                    <?= '<a href="'.get_author_posts_url(get_the_author_meta( 'ID' )).'">'.get_the_author().'</a>'; ?>
                  </li>
                </ul> 
                <hr>
                <header>
                  <h3>Comentários</h3>
                  <small><font size="1px">(Mantido pelo Facebook)</font></small>
                </header>

                <div class="fb-comments" width="100%" data-href="<?= $link_facebook; ?>" data-numposts="5"></div>
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
                  <h6 id="vagasrelacionadas" class="widget-title">Vagas relacionadas</h6>
                  <div class="widget-body item-blocks-connected"> 
                  <?php

                    $metadata_args = array(
                      'relation'  => 'OR',
                      array(         
                        'key'     => 'nomesistema_id', 
                        'value'   => $vagas_meta_data['nomesistema_id'][0], 
                        'compare' => 'LIKE',
                        'type'    => 'STRING'  
                      ),
                      array(         
                        'key'     => 'textarea_id', 
                        'value'   => $vagas_meta_data['textarea_id'][0], 
                        'compare' => 'LIKE',
                        'type'    => 'STRING'  
                      ),
                      array(         
                        'key'     => 'formacao_id', 
                        'value'   => $vagas_meta_data['formacao_id'][0], 
                        'compare' => 'LIKE',
                        'type'    => 'STRING'  
                      ),
                      array(         
                        'key'     => 'nivelvaga_id', 
                        'value'   => $vagas_meta_data['nivelvaga_id'][0], 
                        'compare' => 'LIKE',
                        'type'    => 'STRING'  
                      )
                    );

                    $taxonomy_args = array(
                      'relation' => 'OR',
                      array(
                        'taxonomy' => 'cidade',
                        'field' => 'slug',
                        'terms' => array(createSlug(tirarAcentos($terms2[0]->name)))
                      ),
                      array(
                        'taxonomy' => 'empresa',
                        'field' => 'slug',
                        'terms' => array(createSlug(tirarAcentos($terms1[0]->name)))
                      ),
                      array(
                        'taxonomy' => 'area',
                        'field' => 'slug',
                        'terms' => array(createSlug(tirarAcentos($terms4[0]->name)))
                      )
                    );

                    $args = array(
                      'post_type'        => 'vaga',
                      'meta_key'         => 'nomesistema_id',
                      'meta_query'       => $metadata_args,
                      'tax_query'        => $taxonomy_args,
                      'posts_per_page'   => 6
                    );

                    $loop = new WP_Query( $args );

                    if ($loop->post_count <= 1){

                      $args = array(
                        'post_type'        => 'vaga',
                        'orderby'         => 'date',
                        'order'           => 'desc',
                        'posts_per_page'   => 6
                      );

                      $loop = new WP_Query( $args );
                      echo '<script>$("#vagasrelacionadas").html("Vagas recentes");</script>';
                    } 

                    if( $loop->have_posts()): 
                      $count_anuncio = 0;
                      while( $loop->have_posts() ):
                        $loop->the_post();
                        $search_meta_data = get_post_meta( $post->ID );
                        if($post->ID != $id_vaga):
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
                        endif;
                      endwhile;
                    endif;
                  ?>  
                  </div>
                </div>

                <div class="widget">
                  <h6 class="widget-title">Curta nossa pagina</h6>
                  <ul class="widget-body media-list">
                   <div class="fb-page" data-href="https://www.facebook.com/trampo.xyz/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/trampo.xyz/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/trampo.xyz/">Trampo</a></blockquote></div>
                  </ul>
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
      
      <div class="modal fade" id="banner-servicos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog banner">
          <div class="modal-content banner-conteudo">
            <div class="modal-header banner-cabecalho">
              <button type="button" class="close" style="color: #ffffff !important;" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><i class="fa fa-close"></i></span></button>
            </div>
            <div class="modal-body text-center">
              <div class="modal-body text-center">
                <form id="pfb-signup-submission" action="#">
                <h3>Está procurando recolocação ou querendo mudar de emprego?</h3>
                <input style="margin-bottom: 4px; border-radius: 3px;" id="pfb-signup-box-nome" type="text" class="form-control input-lg" placeholder="Nos deixe seu nome" required>
                <input style="margin-bottom: 4px; border-radius: 3px;" id="pfb-signup-box-email" type="email" class="form-control input-lg" placeholder="Deixe seu email" required>
                <input style="margin-bottom: 10px; border-radius: 3px;" id="pfb-signup-box-whatsapp" type="text" class="form-control input-lg" placeholder="E seu whatsapp" required>
                <button id="pfb-signup-button" type="submit" style="margin-bottom: 4px; display: block; margin: 0 auto;" class="btn btn-success btn-lg">Quero mais vagas!!!</button>
                <small style="margin-bottom: 4px"><font size="1px">Separamos várias vagas e temas que vão te interessar ;)</font></small>
                </form>                 
              </div>
            </div>
          </div>
        </div>
      </div>

      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
      <script>

        $(window).ready(function(){
          setTimeout(function(){
                 $('#banner-servicos').modal('show');
             }, 5000);
          });

        $(document).ready(function(){
          $('#pfb-signup-box-whatsapp').mask('(00) 00000 - 0000');
        });
     
        $('#pfb-signup-submission').submit(function(event) {
          event.preventDefault();

          var pfbSignupFNAME = $('#pfb-signup-box-nome').val();
          var pfbSignupLNAME = $('#pfb-signup-box-whatsapp').val();
          var pfbSignupEMAIL = $('#pfb-signup-box-email').val();

          var pfbSignupData = {
            'firstname': pfbSignupFNAME,
            'lastname': pfbSignupLNAME,
            'email': pfbSignupEMAIL
          };

          $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '<?php echo get_template_directory_uri()."/mailchimpsignup.php"; ?>',
            data: pfbSignupData,
            beforeSend: function(){
               $("#pfb-signup-button").html('Solicitando...');
            },
            success: function (results) {
              $('#pfb-signup-box-nome').attr('disabled',true);
              $('#pfb-signup-box-email').attr('disabled',true);
              $('#pfb-signup-box-whatsapp').attr('disabled',true);
              console.log(results);
              $("#pfb-signup-button").html('<i class="fa fa-check"></i> Recebido');
              $('#pfb-signup-button').attr('disabled',true);
            },
            error: function (results) {
              window.alert('Nos desculpe, ocorreu um erro ao tentar te adicionar na lista de amigos :(');
              console.log(results);
            }
          });
        });

      </script>

<?php
        endwhile;
      endif;

    get_footer(); 
?>