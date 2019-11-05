<?php get_header(); ?>

    <main>
      <section>
        <div class="container text-center">

          <div id="step1">
            <h5>Passo 1 - Para continuar, por favor faça parte da nossa lista de amigos ;)</h5>
            <p>Ao entrar em nossa lista, você receberá diariamente diversas vagas próximas a você e postagens sobre carreira e muito mais para que você esteja informado sobre o que tem de mais atual em empregabilidade.</p>

            <form id="pfb-signup-submissionl" method="POST" onsubmit="return false;">
              <div class="sign-up-group">
                <div class="form-group">
                  <input type="text" name="nome-mailchimp" id="pfb-signup-box-fnamel" class="form-control" placeholder="Seu nome" required>
                </div>
                <div class="form-group">
                  <input type="text" name="sobrenome-mailchimp" id="pfb-signup-box-lnamel" class="form-control" placeholder="Sobrenome" required>
                </div>
                <div class="form-group">
                  <input type="email" name="email-mailchimp" id="pfb-signup-box-emaill" class="form-control" placeholder="seuemail@exemplo.com" required>
                </div>
              </div>
              <p><button id="pfb-signup-buttonl" type="submit" class="btn btn-primary"><i class="fa fa-thumbs-up"></i> Participar</button></p>
              <div id="pfb-signup-resultl"></div>
            </form>
            <hr>
            <h5>Caso deseje contribuir ou postar suas vagas nos nossos grupos parceiros clique logo abaixo :D</h5>
            <a href="http://trampo.xyz/colaborar" class="btn btn-success">Quero fazer parte <i class="fa fa-whatsapp"></i></a>
          </div>
          <div id="step2">
            <h5>Passo 2 - Já estamos chegando lá, agora por favor selecione o grupo da sua região e entre no grupo de vagas :)</h5>
            <div class="form-group">
              <label for="selecao-grupo">Selecione o grupo desejado:</label>
              <select id="selecao-grupo" class="form-control">
                <option>Selecione o grupo que deseja entrar</option>
                <?php
                  $categories = get_terms(array(
                      'taxonomy' => 'estado-regiao',
                      'parent'   => 0,
                      'orderby'  => 'name',
                      'order'    => 'DESC'
                    )
                  );

                  foreach( $categories as $category ) {
                    echo '<option disabled>'.$category->name.'</option>'; 
                    $args = array( 
                      'post_type' => 'grupo', 
                      'tax_query' => array( 
                        array( 
                          'taxonomy' => 'estado-regiao', 
                          'field' => 'slug', 
                          'terms' => $category->slug, 
                          'orderby' => 'name',
                          'order' => 'ASC'
                        ) 
                      ),
                      'orderby' => 'title'
                    );
                    $q = new WP_Query($args);
                    if ( $q->have_posts() ):
                        while ( $q->have_posts() ):
                          $q->the_post();
                          $meta_data = get_post_meta( $post->ID );
                          
                          if ($meta_data['disponibilidade_id'][0] == "Disponivel"){
                            $option = '<option value="'.$meta_data['grupo_id'][0].'" class="'.$meta_data['disponibilidade_id'][0].'">&mdash; '.$category->name.' - '.$meta_data['grupo_nome_id'][0].'</option>';
                            echo $option;
                          }
                      endwhile;
                    endif;
                  } 

                ?>
              </select>
              <a id="grupocheio" href="#" style="font-size: 12px;"></a>
            </div>
            <button id="entragrupo" href="#" class="btn btn-success">Selecionar Grupo <i class="fa fa-arrow-right"></i></button>
          </div>
          <div id="step3">
            <h5>Passo 3 - Parabéns, você faz parte do nossa lista, clique no botão logo abaixo da pagina para entrar no grupo :D</h5>
            <p>
              Aproveite e siga nossos administradores no linkedin
              <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="team-member">
                  <h5>Jéssica Bianca <small>Recrutadora de RH & Coach de Carreiras</small></h5>
                  <img width="200px" src="<?= get_template_directory_uri(); ?>/assets/img/jessica.jpg" alt="avatar">
                  <ul class="social-icons">
                    <li><a class="linkedin" href="https://www.linkedin.com/in/j%C3%A9ssica-bianca-71a455116/"><i class="fa fa-linkedin"></i></a></li>
                  </ul>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="team-member">
                  <h5>Alan Wesley <small>Front-end Developer & Divulgador de trampos em TI</small></h5>
                  <img width="200px" src="<?= get_template_directory_uri(); ?>/assets/img/alan.jpg" alt="avatar">
                  <ul class="social-icons">
                    <li><a class="linkedin" href="https://www.linkedin.com/in/alan-w-356b4430/"><i class="fa fa-linkedin"></i></a></li>
                  </ul>
                </div>
              </div>
            </p>
            <p>
              Curta nossa pagina no facebook, linkedin e no twitter também :)
              <div class="team-member">
                <div class="fb-like" data-href="https://www.facebook.com/trampo.xyz/" data-layout="button" data-action="like" data-size="small" data-show-faces="true"></div>
              </div>
              <div class="team-member">
                <script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: pt_BR</script>
                <script type="IN/FollowCompany" data-id="11797970"></script>
              </div>
              <div class="team-member">
                <a style="margin-top: 10px" href="https://www.twitter.com/trampo_xyz" class="twitter-follow-button" data-show-count="false">Siga @Trampo.Xyz</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
              </div>
              <p align="center">
                  <a id="btnlinkgrupo" target="_blank" href="#" class="btn btn-success"><i class="fa fa-whatsapp"></i>Entrar no grupo </a>
                </p>
            </p> 
          </div>
        </div>
       </section>
    </main>

<?php get_footer(); ?>