<?php wp_footer(); ?>

  <?php
    if(!in_array('wp-chatbot/wp-chatbot.php', apply_filters('active_plugins', get_option('active_plugins')))):
  ?>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v3.1';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
  <?php
    endif;
  ?>
  
  <footer class="site-footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-9">
          <h6>Outras vagas</h6>
          <ul class="footer-links">
            <?php

              $args = array(
                'post_type' => 'vaga',
                'posts_per_page' => 6,
                'orderby' => 'rand'
              );

              $loop = new WP_Query( $args );
              if( $loop->have_posts()):
                while( $loop->have_posts() ):
                  $loop->the_post();
                  $vagas_meta_data = get_post_meta( $post->ID );  
            ?>
              <li><a href="<?= the_permalink(); ?>"><?= the_title(); ?></a></li>
            <?php
                endwhile;
              endif;
            ?>
          </ul>
        </div>

        <div class="col-xs-6 col-md-3">
          <h6>Links</h6>
          <ul class="footer-links">
            <li><a href="<?= get_option('home').'/busca'; ?>">Ver vagas</a></li>
            <li><a href="<?= get_option('home').'/whatsapp'; ?>">Whatsapp</a></li>
            <?php 
              $count_blog = wp_count_posts('post')->publish;
              if ($count_blog > 0): 
            ?>
            <li>
              <a href="<?= get_option('home').'/blog'; ?>">Nosso blog</a>
            </li>
            <?php endif; ?>
            <li><a href="<?= get_option('home').'/contato'; ?>">Contato</a></li>
            <li><a href="<?= get_option('home').'/privacidade'; ?>">Privacidade</a></li>
          </ul>
        </div>

      </div>

      <hr>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-8 col-sm-6 col-xs-12">
          <p class="copyright-text">Copyright &copy; 2018-2019 Trampo.xyz - Desenvolvido por <a href="http://www.criejundiai.com.br">CrieJundiaí</a>.</p>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <ul class="social-icons">
            <li><a class="facebook" href="https://www.facebook.com/trampo.xyz/"><i class="fa fa-facebook"></i></a></li>
            <li><a class="twitter" href="https://www.twitter.com/trampo_xyz"><i class="fa fa-twitter"></i></a></li>
            <li><a class="linkedin" href="https://www.linkedin.com/company/trampo-xyz/"><i class="fa fa-linkedin"></i></a></li>
            <li><a class="instagram" href="https://www.instagram.com/trampo.xyz/"><i class="fa fa-instagram"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <?php if(is_singular(array('vaga','post')) || is_author() || is_category() || is_search() ||is_page(array('Home','Blog','Busca','Divulgador','Mobile','Vagas do autor','Posts do autor','Posts da categoria','Empresa','Cidade','Estado','Área'))): ?>
    <a id="scroll-up" href="#"><i class="ti-angle-up"></i></a>
  <?php endif; ?>

  </body>
</html>