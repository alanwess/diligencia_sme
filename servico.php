<?php get_header(); ?>

    <main>
      <section class="bg-alt">
        <div class="container">
          <header class="section-header">
            <h2>Veja os nossos serviços</h2>
            <p>Conheça todos os serviços oferecidos pela plataforma integrada Trampo.xyz</p>
          </header>

          <div class="category-grid">

            <?php

              $args = array(
                'post_type' => 'servico'
              );

              $loop = new WP_Query( $args );
              if( $loop->have_posts()):
                while( $loop->have_posts() ):
                  $loop->the_post();
                  $servico_meta_data = get_post_meta( $post->ID );  
            ?>

              <a href="<?= the_permalink(); ?>">
                <i class="<?= esc_attr($servico_meta_data['servico_icone_id'][0]); ?>"></i>
                <h6><?= esc_attr($servico_meta_data['servico_nome_id'][0]); ?></h6>
                <p style="word-wrap: break-word"><?= esc_attr($servico_meta_data['servico_textarea_id'][0]); ?></p>
              </a>

            <?php
                endwhile;
              else:
                echo '<h4>Nada encontrado para essa seção.</h4>';
              endif;
            ?>

          </div>

        </div>

        <div class="container text-center">
          <h6>Ficou com alguma dúvida ou curiosidade que possamos ajudar?</h6>
          <a class="btn btn-primary" href="contato">Solicite contato!</a>
        </div>

      </section>
    </main>

<?php get_footer(); ?>