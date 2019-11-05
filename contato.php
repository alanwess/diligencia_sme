<?php get_header(); ?>

    <main>
      <section>
        <div class="container">
          <div id="contact-map" style="height: 500px"></div>

          <br><br>

          <div class="row">
            <div class="col-sm-12 col-md-8">
              <h4>Nos contate</h4>
              <form action="https://formspree.io/trampo.xyz@gmail.com" method="POST">
                <div class="form-group">
                  <input name="Nome" type="text" class="form-control input-lg" placeholder="Nome" required>
                </div>

                <div class="form-group">
                  <input name="_replyto" type="email" class="form-control input-lg" placeholder="Email" required>
                </div>

                <div class="form-group">
                  <textarea name="Mensagem" class="form-control" rows="5" placeholder="Mensagem" required></textarea>
                </div>

                <input type="hidden" name="_next" value="https://trampo.xyz/obrigado" />
                <input type="hidden" name="_subject" value="Nova solicitação de contato" />
                <input type="hidden" name="_language" value="pt-BR" />
                
                <button type="submit" class="btn btn-primary">Enviar</button>
              </form>
            </div>

            <div class="col-sm-12 col-md-4">
              <h4>Informação</h4>
              <div class="highlighted-block">
                <dl class="icon-holder">
                  <dt><i class="fa fa-building"></i></dt>
                  <dd>Estamos no Google Campus</dd>

                  <dt><i class="fa fa-map-marker"></i></dt>
                  <dd>Rua Coronel Oscar Porto, 70 - Paraíso, São Paulo - SP</dd>

                  <!--<dt><i class="fa fa-whatsapp"></i></dt>
                  <dd>(+55) 11 974647322</dd>-->

                  <dt><i class="fa fa-envelope"></i></dt>
                  <dd><a href="mailto:contato@trampe.xyz">contato@trampe.xyz</a></dd>
                </dl>
              </div>

              <br>

              <ul class="social-icons size-sm text-center">
                <li><a class="facebook" href="https://www.facebook.com/trampo.xyz/"><i class="fa fa-facebook"></i></a></li>
                <li><a class="twitter" href="https://www.twitter.com/Trampo_xyz"><i class="fa fa-twitter"></i></a></li>
                <li><a class="linkedin" href="https://www.linkedin.com/company/trampo-xyz/"><i class="fa fa-linkedin"></i></a></li>
                <li><a class="instagram" href="https://www.instagram.com/trampo.xyz/"><i class="fa fa-instagram"></i></a></li>
              </ul>

            </div>
          </div>

        </div>
      </section>
    </main>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBy5_lcNGiVIqZM4ZpKO-PyjbfedJR-MlU&sensor=false&callback=initMap" async defer></script>

<?php get_footer(); ?>