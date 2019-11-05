<?php get_header(); ?>

    <main id="faq-result">
      <section>
        <div class="container text-center">
          <header class="section-header" style="margin-top: 20px;">
            <span>Tire suas duvidas agora</span>
            <h2>Dúvidas frequentes</h2>
          </header>

          <?php 
            if ( have_posts() ) : 
              while ( have_posts() ) : 
                the_post();
                the_content();
              endwhile; 
            else: 
          ?>
            <p>Não foi encontrado nenhum conteúdo nesse momento.</p>
          <?php endif; ?>
        </div>

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