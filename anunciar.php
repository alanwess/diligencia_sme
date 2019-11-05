<?php get_header(); ?>

    <main id="faq-result">
      <section>
        <div class="container text-center">
          <header class="section-header" style="margin-top: 20px;">
            <span>Anuncie suas vagas gratuitamente agora</span>
            <h2>Anunciar Vaga</h2>
          </header>

          <h6 id="textcontatovaga">Está interessado em um local para divulgar suas vagas 100% gratuitamente? Clique no botão logo abaixo e prossiga ;)</h6>
          <button id="contatoformvaga" class="btn btn-primary">Verificando login...</button>
          <div id="linkedinbtn" class="form col-xs-12">
            <h6>Para continuar o cadastro da vaga, por favor faça o login em seu linkedin para que possamos garantir sua autenticidade e veracidade sobre a vaga a ser postada</h6>
            <script type="in/Login"></script>
            <?php

              $useragent=$_SERVER['HTTP_USER_AGENT'];

              if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))):

            ?>
            <p>Após autorizar, clique em iniciar cadastro da vaga ;).</p>
            <a href="#" onclick="window.location.reload()" class="btn btn-primary">Iniciar cadastro <i class="fa fa-pencil"></i></a>
            <?php endif ?>
          </div>

          <div id="formcard" class="form col-xs-12">
            <hr/>
            <h5>Confira as informações do seu card e continue com o cadastro da vaga</h5>
            <header class="background-img">
              <div class="block-update-card col-xs-12" style="margin-bottom: 40px">
                <a class="pull-left" href="#">
                  <img id="profile-img" width="100px" class="media-object update-card-MDimentions" src="https://trampo.xyz/wp-content/uploads/2018/08/user.png" alt="..." style="border-bottom-right-radius: 10px; border-top-left-radius: 8px;">
                </a>
                <div class="media-body update-card-body">
                  <h4 style="color: #ffffff;">Provido por <img src="https://trampo.xyz/wp-content/uploads/2018/08/LinkedIn-Logo-R.png" width="20px"></h4>
                  <h4><b id="profile-name">Usuário</b></h4>
                  <p id="profile-headline">Headline do usuário</p>
                  <div class="card-action-pellet pull-right">
                    <a id="profile-link" target="_blank"><i class="fa fa-link"></i></a>
                    <?php

                      $useragent=$_SERVER['HTTP_USER_AGENT'];

                      if(!preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)&&!preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))):

                    ?>
                    <a href="#" onclick="logout()"><i class="fa fa-sign-out"></i></a>
                    <?php endif ?>
                  </div>
                </div>
              </div>
              <hr>
            </header>
          </div>
          <div id="formvaga">
              <h5><br>Precisamos de mais algumas informações para continuar...</h5>
              <p>Por favor preencha as informações logo abaixo no formulário para que possamos fazer a inserção da vaga em nosso sistema.</p>
              <form action="https://formspree.io/contato@trampe.xyz" method="POST">
                <div class="form-group">
                  <div class="input-group input-group-sm ">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input id="profile-name-text" type="text" name="Nome" class="form-control" disabled>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-sm ">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input id="profile-email-text" type="email" name="Email" class="form-control" disabled>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-sm ">
                    <span class="input-group-addon"><i class="fa fa-whatsapp"></i></span>
                    <input type="phone" name="Whatsapp" class="form-control" placeholder="Seu Whatsapp (Ex: 11 967534567)" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-sm ">
                    <span class="input-group-addon"><i class="fa fa-building"></i></span>
                    <input type="text" name="Empresa" class="form-control" placeholder="Empresa anunciante" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-sm ">
                    <span class="input-group-addon"><i class="fa fa-link"></i></span>
                    <input type="phone" name="Destino_url" class="form-control" placeholder="Email de destino ou URL para envio do CV" required>
                  </div>
                </div>
                <div class="form-group ">
                  <textarea name="Descricao-chamativa" class="form-control" placeholder="Uma breve descrição sobre o trampo" maxlength="500" required></textarea>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                    <input type="text" name="Cidade-estado" class="form-control" placeholder="Cidade/Estado" required>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                    <input type="text" name="Salario" class="form-control" placeholder="Informe o valor ou à combinar" required>
                    <span class="input-group-addon">R$</span>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
                    <select name="Tipo" class="form-control selectpicker">
                      <option value="">Selecione o tipo de vaga</option>
                      <option value="Efetivo">Efetivo</option>
                      <option value="PJ">PJ</option>
                      <option value="Temporario">Temporário</option>
                      <option value="Aprendiz">Aprendiz</option>
                      <option value="Estagio">Estágio</option>
                      <option value="Freelancer">Freelancer</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-level-up"></i></span>
                    <select name="Senioridade" class="form-control selectpicker">
                      <option value="">Selecione a senioridade</option>
                      <option value="Júnior">Júnior</option>
                      <option value="Pleno">Pleno</option>
                      <option value="Sênior">Sênior</option>
                      <option value="Trainee">Trainee</option>
                      <option value="Master">Master</option>
                    </select>
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

                <h6>Agora, informe os detalhes da vaga (Essas informações aparecerão no nosso site)</h6>
                <textarea name="conteudo-vaga" class="summernote-editor" required></textarea>

                <input type="hidden" id="profile-name-hidden" name="NomeUser" value="" />
                <input type="hidden" id="profile-email-hidden" name="EmailUser" value="" />
                <input type="hidden" id="profile-headline-hidden" name="Headline" value="" />
                <input type="hidden" id="profile-loc-hidden" name="LocUser" value="" />
                <input type="hidden" id="profile-url-hidden" name="LinkedinURL" value="" />

                <input type="hidden" name="_next" value="https://trampo.xyz/obrigado" />
                <input type="hidden" name="_subject" value="Nova solicitação de anuncio" />
                <input type="hidden" name="_language" value="pt-BR" />

                <button type="submit" class="btn btn-primary">Enviar vaga <i class="fa fa-save"></i></button> 
                <br>
                <p><font size="1px">Obs: Ao enviar a vaga, estaremos a avaliando e inserindo em nosso sistema. Em até 24 horas te daremos um retorno via E-mail</font></p>
              </form>
            </div>
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

    <script type="text/javascript" src="//platform.linkedin.com/in.js">
      api_key: 77k6k1i3efin5r
      authorize: true
      onLoad: onLinkedInLoad
      scope: r_basicprofile r_emailaddress
      lang: pt_BR
    </script>

    <script type="text/javascript">
      function onLinkedInLoad() {
          $("#contatoformvaga").html('Anunciar Agora! <i class="fa fa-check"></i>');
          $('a[id*=li_ui_li_gen_]').css({marginBottom:'20px'}).html('<img src="https://trampo.xyz/wp-content/uploads/2018/08/connect-linkedin.png" height="31" width="200" border="0" />');
          IN.Event.on(IN, "auth", getProfileData);
      }
      
      function getProfileData() {
          IN.API.Profile("me").fields("id", "first-name", "last-name", "headline", "location", "picture-url", "public-profile-url", "email-address").result(displayProfileData).error(onError);
      }

      function displayProfileData(data){
          var user = data.values[0];
          var pictureUrl = user.pictureUrl;
          $("#profile-img").attr('src',pictureUrl);
          var fullName = user.firstName + ' ' + user.lastName;
          $("#profile-name").html(fullName);
          $("#profile-name-text").attr('value',fullName);
          $("#profile-name-hidden").attr('value',fullName);
          var headline = user.headline;
          $("#profile-headline").html(headline);
          $("#profile-headline-hidden").attr('value',headline);
          var emailAddress = user.emailAddress;
          $("#profile-email-text").attr('value',emailAddress);
          $("#profile-email-hidden").attr('value',emailAddress);
          var location = user.location.name;
          $("#profile-loc-hidden").attr('value',location);
          var publicProfileUrl = user.publicProfileUrl;
          $("#profile-url-hidden").attr('value',publicProfileUrl);
          $("#profile-link").attr('href',publicProfileUrl);
          $("#textcontatovaga").hide();
          $("#contatoformvaga").hide();
          $("#linkedinbtn").hide();
          $("#formcard").show();
          $("#formvaga").show();
      }

      function onError(error) {
          console.log(error);
      }
      
      function logout(){
          IN.User.logout(removeProfileData);
          window.location.reload();
      }
      
      function removeProfileData(){
          document.getElementById('profileData').remove();
      }
    </script>

<?php get_footer(); ?>