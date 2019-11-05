<?php get_header(); ?>

    <main id="faq-result">
      <section>
        <div class="container text-center">
          <header class="section-header" style="margin-top: 20px;">
            <span>Tenha um perfil para seu portfólio</span>
            <h2>Fazer parte do catálogo de Recrutadores</h2>
          </header>

          <h6 id="textcontatoportfolio">Deseja ter um perfil público em nossa plataforma? Então não deixe de se inscrever agora mesmo e crie seu portfólio de recrutador ;) (Beta)</h6>
          <button id="contatoformportfolio" class="btn btn-info">Criar Agora! <i class="fa fa-user"></i></button>

          <div id="formportfolio" class="form">
            <hr>
            <h5>Precisamos de algumas informações para continuar...</h5>
            <p>Por favor preencha as informações logo abaixo no formulário para que possamos colocar você nos grupos.</p>
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
                  <span class="input-group-addon"><i class="fa fa-flask"></i></span>
                  <input type="text" name="Funcao" class="form-control" placeholder="Função desempenhada" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group input-group-sm">
                  <span class="input-group-addon"><i class="fa fa-graduation-cap"></i></span>
                  <select name="Formacao" class="form-control selectpicker">
                    <option value="">Selecione a formação</option>
                    <option value="Ensino Fundamental">Ensino Fundamental</option>
                    <option value="Ensino Médio">Ensino Médio</option>
                    <option value="Ensino Superior">Ensino Superior</option>
                    <option value="Mestrado/Doutorado">Mestrado/Doutorado</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group input-group-sm">
                  <span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span>
                  <input type="date" class="form-control" name="Data-nascimento" value="01/04/2005" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group input-group-sm">
                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                  <input type="text" class="form-control" name="Cidade-estado" placeholder="Cidade - Estado" required>
                </div>
              </div>
              <div class="form-group">
                <textarea name="Descricao-sobre" class="form-control" placeholder="Um pouco sobre você" maxlength="500" required></textarea>
              </div>

              <input type="hidden" name="_next" value="https://trampo.xyz/obrigado" />
              <input type="hidden" name="_subject" value="Nova solicitação de associação" />
              <input type="hidden" name="_language" value="pt-BR" />

              <button type="submit" class="btn btn-info">Enviar perfil <i class="fa fa-user"></i></button> 
              <br>
              <p><font size="1px">Obs: Ao enviar o perfil, estaremos avaliando e inserindo em nosso sistema. Em até 24 horas te daremos um retorno via E-mail</font></p>
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