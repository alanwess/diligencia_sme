<?php get_header(); ?>

    <main id="faq-result"> 
      <section>
        <div class="container text-center">
          <header class="section-header" style="margin-top: 20px;">
            <span>Divulgue suas vagas nos nossos grupos</span>
            <h2>Contribuir com os grupos</h2>
          </header>

          <h6 id="textcontatogrupo">Deseja colaborar no grupo postando suas vagas ou compartilhando vagas, participe agora ;)</h6>
          <button id="contatoformgrupo" class="btn btn-success">Participar Agora! <i class="fa fa-whatsapp"></i></button>

          <div id="formgrupo" class="form">
            <hr>
            <h5>Precisamos de algumas informações para continuar...</h5>
            <p>Por favor preencha as informações logo abaixo no formulário para que possamos te colocar nos grupos.</p>
            <form action="https://formspree.io/contato@trampe.xyz" method="POST">
              <div class="form-group">
                <div class="input-group input-group-sm">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" name="Nome" class="form-control" placeholder="Seu nome completo" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group input-group-sm">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="email" name="Email" class="form-control" placeholder="seuemail@exemplo.com" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group input-group-sm">
                  <span class="input-group-addon"><i class="fa fa-whatsapp"></i></span>
                  <input type="phone" name="Whatsapp" class="form-control" placeholder="Seu Whatsapp (Ex: 11 967534567)" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group input-group-sm">
                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                  <select name="Cidade-regiao-interesse" class="form-control">
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
                        $subcats = get_terms(array( 
                            'taxonomy' => 'estado-regiao',
                            'parent'   => $category->term_id,
                            'orderby' => 'name',
                            'order' => 'ASC'
                        ));
                        $option = "";
                        foreach ($subcats as $sc) {
                            $args = array( 
                              'post_type' => 'grupo', 
                              'tax_query' => array( 
                                array( 
                                  'taxonomy' => 'estado-regiao', 
                                  'field' => 'slug', 
                                  'terms' => $sc->slug, 
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
                                    $option = '<option value="'.$meta_data['grupo_nome_id'][0].'" class="'.$meta_data['disponibilidade_id'][0].'">&mdash; '.$sc->name.' - '.$meta_data['grupo_nome_id'][0].'</option>';
                                    echo $option;
                                  }
                              endwhile;
                            endif;
                        }

                      } 

                    ?>
                  </select>
                </div>
              </div>

              <input type="hidden" name="_next" value="https://trampo.xyz/obrigado" />
              <input type="hidden" name="_subject" value="Nova solicitação de colaboração" />
              <input type="hidden" name="_language" value="pt-BR" />

              <button type="submit" class="btn btn-success">Me coloque no grupo <i class="fa fa-whatsapp"></i></button> 
              <br>
              <p><font size="1px">Obs: Em até 24 horas te colocaremos no grupo desejado ;)</font></p>
            </form>
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