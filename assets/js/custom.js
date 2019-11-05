"use strict";

function initMap() {
  var mapDiv = document.getElementById('contact-map');
  var map = new google.maps.Map(mapDiv, {
    center: {lat: -23.570578, lng: -46.649886},
    zoom: 14
  });

  var marker = new google.maps.Marker({
    position: {lat: -23.570578, lng: -46.649886},
    map: map
  });

  var infowindow = new google.maps.InfoWindow({
    content: "<strong>Estamos no Google Campus</strong><br>Rua Coronel Oscar Porto, 70 - Paraíso, São Paulo - SP"
  });

  marker.addListener('click', function() {
    infowindow.open(map, marker);
  });

  infowindow.open(map,marker);

  map.set('styles', [{"featureType":"landscape","stylers":[{"hue":"#FFBB00"},{"saturation":43.400000000000006},{"lightness":37.599999999999994},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#FFC200"},{"saturation":-61.8},{"lightness":45.599999999999994},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":51.19999999999999},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":52},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#0078FF"},{"saturation":-13.200000000000003},{"lightness":2.4000000000000057},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#00FF6A"},{"saturation":-1.0989010989011234},{"lightness":11.200000000000017},{"gamma":1}]}]);
}

$(function(){
  $(".fastslogan").typed({
      strings: ["Temos novas vagas nesse momento... <br> Não fique sem<mark>trampo!</mark>"],
      typeSpeed: 0.5,
      backSpeed: 0.3,
      backDelay: 500,
      startDelay: 1000,
      loop: true
  });
            
  $("#contatoformgrupo").click(function(){ 
    $("#textcontatogrupo").hide();
    $("#contatoformgrupo").hide();
    $("#formgrupo").show();
  });

  $('#pfb-signup-submission').submit(function(event) {
    event.preventDefault();

    // Get data from form and store it
    var pfbSignupFNAME = 'Querido';
    var pfbSignupLNAME = 'Visitante';
    var pfbSignupEMAIL = $('#pfb-signup-box-email').val();

    // Create JSON variable of retreived data
    var pfbSignupData = {
      'firstname': pfbSignupFNAME,
      'lastname': pfbSignupLNAME,
      'email': pfbSignupEMAIL
    };

    // Send data to PHP script via .ajax() of jQuery
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: 'https://trampo.xyz/mailchimpsignup',
      data: pfbSignupData,
      beforeSend: function(){
         $("#pfb-signup-button").html('Inscrevendo...');
      },
      success: function (results) {
        $('#pfb-signup-box-email').attr('disabled',true);
        console.log(results);
        $("#pfb-signup-button").html('Inscrito <i class="fa fa-check"></i>');
        $('#pfb-signup-button').attr('disabled',true);
      },
      error: function (results) {
        window.alert('Nos desculpe, ocorreu um erro ao tentar te adicionar na lista de amigos :(');
        console.log(results);
      }
    });
  });

  $('#pfb-signup-submissionl').submit(function(event) {
    event.preventDefault();

    if($("#pfb-signup-buttonl").text() == "Continuar"){
      $('#step1').hide();
      $('#step2').show();
    }else{
      // Get data from form and store it
      var pfbSignupFNAME = $('#pfb-signup-box-fnamel').val();
      var pfbSignupLNAME = $('#pfb-signup-box-lnamel').val();
      var pfbSignupEMAIL = $('#pfb-signup-box-emaill').val();

      // Create JSON variable of retreived data
      var pfbSignupData = { 
        'firstname': pfbSignupFNAME,
        'lastname': pfbSignupLNAME,
        'email': pfbSignupEMAIL
      };

      // Send data to PHP script via .ajax() of jQuery
      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '<?php echo get_template_directory_uri()."/mailchimpsignup.php"; ?>',
        data: pfbSignupData,
        beforeSend: function(){
          $("#pfb-signup-buttonl").text('Adicionando...');
        },
        success: function (results) {
          $('#pfb-signup-box-fnamel').hide();
          $('#pfb-signup-box-lnamel').hide();
          $('#pfb-signup-box-emaill').hide();
          $('#pfb-signup-resultl').text('Você foi adicionado a nossa lista, estaremos prosseguindo.');
          console.log(results);
          $("#pfb-signup-buttonl").text('Continuar');
        },
        error: function (results) {
          $('#pfb-signup-resultl').html('<p>Nos desculpe, ocorreu um erro ao tentar te adicionar na lista de amigos :(</p>');
          console.log(results);
        }
      });
    }
  });

  $(document).ready(function() {
     $('#selecao-grupo').change(function() {
       $("#entragrupo").show();
       $("#grupocheio").text(">> Relatar grupo cheio para o grupo selecionado <<");
     }); 
  });

  $("#grupocheio").click(function(){ 
      var nomegp = $('#selecao-grupo').find(":selected").text();

      var Datainfo = {
        'nomegp': nomegp
      };

      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '<?php echo get_template_directory_uri()."/relatar_gpcheio.php"; ?>',
        data: Datainfo,
        beforeSend: function(){
           $("#grupocheio").html('<p>Relatando grupo cheio... </p>');
        },
        success: function (results) {
          console.log(results);
          if(results.sucess == "true")
            $("#grupocheio").html('<p>Grupo cheio relatado com sucesso! Escolha outro disponivel e continue... </p>');
          else 
            $('#grupocheio').html('<p>Nos desculpe, ocorreu um erro ao relatar o grupo! Escolha outro grupo disponivel e continue :(</p>');

        },
        error: function (results) {
          console.log(results);
          $('#grupocheio').html('<p>Nos desculpe, ocorreu um erro ao relatar o grupo! Escolha outro grupo disponivel e continue :(</p>');
        }
      });
  });

  var linkgp = "";
  $("#entragrupo").click(function(){ 
      linkgp = $('#selecao-grupo').val();
      $("#btnlinkgrupo").attr('href',linkgp);
      $('#step2').hide();
      $('#step3').show();
  });

  $("#btnlinkgrupo").click(function(){
      window.open(linkgp,'_blank');
  });


});