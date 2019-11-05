<?php

	global $s_informacoes;
	global $s_dados;

	function custom_enqueue(){
	    wp_enqueue_style('appstyle', get_template_directory_uri() . '/assets/css/app.css', array(), '1.0.0', 'all' );
	    wp_enqueue_style('customstyle', get_template_directory_uri() . '/assets/css/custom.css', array(), '1.0.0', 'all' );

	    wp_enqueue_style('oswald', 'http://fonts.googleapis.com/css?family=Oswald:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700');
	    wp_enqueue_style('raleway', 'http://fonts.googleapis.com/css?family=Raleway:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700');

	    wp_enqueue_script('appjs', get_template_directory_uri() . '/assets/js/app.min.js', array(), '1.0.0', 'true' );
	    wp_enqueue_script('customjs', get_template_directory_uri() . '/assets/js/custom.js', array(), '1.0.0', 'true' );
	    wp_enqueue_script('typedjs', get_template_directory_uri() . '/assets/js/typed.min.js', array(), '1.0.0', 'true' );
	}
	add_action('wp_enqueue_scripts', 'custom_enqueue');

	add_theme_support( 'post-thumbnails' );

	add_action( 'init', function() {
	    remove_post_type_support( 'grupo', 'editor' );
	    remove_post_type_support( 'grupo', 'thumbnail' );
	    remove_post_type_support( 'servico', 'thumbnail' );
	}, 99);

	function trampe_enqueue_scripts() {
		wp_localize_script('scripts', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php'), 'outro_valor' => 1234));
	}
	add_action('wp_enqueue_scripts', 'trampe_enqueue_scripts');

	function searchfilter($query) {
 
	    if ($query->is_search && !is_admin() ) {
	        $query->set('post_type',array('post','coluna','daily','opniao'));
	        $query->set('paged', ( get_query_var('paged') ) ? get_query_var('paged') : 1 );
      		$query->set('posts_per_page',10);
	    }
	 
		return $query;
	}
	add_filter('pre_get_posts','searchfilter');

	function get_titulo($s_informacoes = "", $s_dados = "") {
		if(is_home() || is_front_page()) {
			echo 'Busque seu trampo ideal e mude sua vida agora mesmo';
			echo ' - ';
			bloginfo('name');
		} elseif (is_author()) {
			$author = get_queried_object();
    		$author_id = $author->ID;
    		echo get_author_name($author_id);
			echo ' - ';
			bloginfo('name');
		} elseif (is_search()){
			echo 'Buscando por resultados em "';
    		echo get_search_query();
			echo '" - ';
			bloginfo('name');
		} elseif (is_category()){
			$categoriaid = get_queried_object();
    		$categorianame = get_the_category_by_ID($categoriaid->term_id);
    		echo 'Pagina da categoria ';
    		echo $categorianame;
			echo ' - ';
			bloginfo('name');
		} elseif(is_404()){
			echo 'Nada encontrado neste endereço :(';
			echo ' - ';
			bloginfo('name');
		} elseif(is_page('Busca')){
			
			if ($s_informacoes == "" && $s_dados == "")
				echo 'Busca';
			elseif ($s_informacoes != "" && $s_dados == "")
				echo 'Buscando por "'.$s_informacoes.'"';
			elseif ($s_informacoes == "" && $s_dados != "")
				echo 'Buscando em "'.$s_dados.'"';
			else
				echo 'Buscando por "'.$s_informacoes.'" em "'.$s_dados.'"';

			echo ' - ';
			bloginfo('name');
		}else {
			the_title();
			echo ' - ';
			bloginfo('name');
		}
	}

    register_activation_hook(   __FILE__ , 't5_flush_rewrite_on_init' );
    register_deactivation_hook( __FILE__ , 't5_flush_rewrite_on_init' );
    add_action( 'init', 't5_page_to_seite' );

    function t5_page_to_seite()
    {
        $GLOBALS['wp_rewrite']->pagination_base = 'pagina';
    }

    function t5_flush_rewrite_on_init()
    {
        add_action( 'init', 'flush_rewrite_rules', 11 );
    }

    $new_page_content = 'Cansado de se candidatar em vários sites de emprego e sempre desanimar? Venha descobrir agora mesmo que é possível conhecer e vivenciar as experiências positivas ao ter contato com uma plataforma que integra o compartilhamento de oportunidades com a transmissão de vários conhecimentos que realmente visam agregar a vida profissional e acadêmica. Aqui você terá vagas e conteúdo sobre muitas áreas que podem te interessar... São mais de 40 categorias para que você encontre o que procura, onde além da tradicional busca de vagas, você pode encontrar conteúdos que melhorem seu perfil profissional e até mesmo pessoal. Somos uma equipe multiprofissional capacitada e que seleciona com qualidade e maestria seus conteúdos. Descubra agora mesmo!';

    $lista = array();
    array_push($lista, array("anunciar", "Anunciar", "anunciar.php"));
    array_push($lista, array("area", "Área", "taxonomy-area.php"));
    array_push($lista, array("associar-se", "Associar-se", "associar.php"));
    array_push($lista, array("blog", "Blog", "blog.php"));
    array_push($lista, array("busca", "Busca", "search-vagas.php"));
    array_push($lista, array("cidade", "Cidade", "taxonomy-cidade.php"));
    array_push($lista, array("colaborar", "Colaborar", "colaborar.php"));
    array_push($lista, array("contato", "Contato", "contato.php"));
    array_push($lista, array("empresa", "Empresa", "taxonomy-empresa.php"));
    array_push($lista, array("estado", "Estado", "taxonomy-estado.php"));
    array_push($lista, array("home", "Home", "front-page.php"));
    array_push($lista, array("obrigado", "Obrigado", "email-recebido.php"));
    array_push($lista, array("perguntas", "Perguntas", "perguntas.php"));
    array_push($lista, array("privacidade", "Política de Privacidade", "privacidade.php"));
    array_push($lista, array("posts-da-categoria", "Posts da categoria", "posts-categoria.php"));
    array_push($lista, array("posts-do-autor", "Posts do autor", "posts-autor.php"));
    array_push($lista, array("servicos", "Serviços", "servico.php"));
    array_push($lista, array("sobre", "Sobre", "sobre.php"));
    array_push($lista, array("vagas-do-autor", "Vagas do autor", "vagas-autor.php"));
    array_push($lista, array("whatsapp", "Whatsapp", "lead-grupos.php"));

    foreach ($lista as $itemlista) {
		if (isset($_GET['activated']) && is_admin()){
	  
	  		$new_page_name = $itemlista[0];
		    $new_page_title = $itemlista[1];
		    $new_page_template = $itemlista[2];
		    	  
		    $page_check = get_page_by_title($new_page_title);
		    $new_page = array(
		        'post_type' => 'page',
		        'post_name' => $new_page_name,
		        'post_title' => $new_page_title,
		        'post_content' => $new_page_content,
		        'post_status' => 'publish',
		        'post_author' => 1,
		    );
		    if(!isset($page_check->ID)){
		        $new_page_id = wp_insert_post($new_page);
		        if(!empty($new_page_template)){
		            update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
		        }
		    }
		  
		}
	}

	$homepage = get_page_by_title('Home');
	if ($homepage){
	    update_option('page_on_front', $homepage->ID );
	    update_option('show_on_front', 'page' );
	}

	function criar_menu_header() {
		$menuname = 'Header Menu';
		$bpmenulocation = 'header_menu';
		// Does the menu exist already?
		$menu_exists = wp_get_nav_menu_object($menuname);

		// If it doesn't exist, let's create it.
		if(!$menu_exists){
		    $menu_id = wp_create_nav_menu($menuname);

		    // Set up default BuddyPress links and add them to the menu.
		    wp_update_nav_menu_item($menu_id, 0, array(
		        'menu-item-title' =>  __('Home'),
		        'menu-item-classes' => 'home',
		        'menu-item-url' => home_url( '/' ), 
		        'menu-item-status' => 'publish'));

		    wp_update_nav_menu_item($menu_id, 0, array(
		        'menu-item-title' =>  __('Activity'),
		        'menu-item-classes' => 'activity',
		        'menu-item-url' => home_url( '/activity/' ), 
		        'menu-item-status' => 'publish'));

		    wp_update_nav_menu_item($menu_id, 0, array(
		        'menu-item-title' =>  __('Members'),
		        'menu-item-classes' => 'members',
		        'menu-item-url' => home_url( '/members/' ), 
		        'menu-item-status' => 'publish'));

		    wp_update_nav_menu_item($menu_id, 0, array(
		        'menu-item-title' =>  __('Groups'),
		        'menu-item-classes' => 'groups',
		        'menu-item-url' => home_url( '/groups/' ), 
		        'menu-item-status' => 'publish'));

		    wp_update_nav_menu_item($menu_id, 0, array(
		        'menu-item-title' =>  __('Forums'),
		        'menu-item-classes' => 'forums',
		        'menu-item-url' => home_url( '/forums/' ), 
		        'menu-item-status' => 'publish'));

		    // Grab the theme locations and assign our newly-created menu
		    // to the BuddyPress menu location.
		    if(!has_nav_menu( $bpmenulocation ) ){
		        $locations = get_theme_mod('nav_menu_locations');
		        $locations[$bpmenulocation] = $menu_id;
		        set_theme_mod('nav_menu_locations', $locations );
		    }
		}
	}
	add_action('init', 'criar_menu_header');

	function registrar_vagas() {
		$descricao = 'Usado para listar as vagas do Trampo';
		$singular = 'Trampo';
		$plural = 'Trampos';

		$labels = array(
			'name' => $plural,
			'singular_name' => $singular,
			'view_item' => 'Ver ' . $singular,
			'edit_item' => 'Editar ' . $singular,
			'new_item' => 'Novo ' . $singular,
			'add_new_item' => 'Adicionar novo ' . $singular
		);

		$supports = array(
			'title',
			'editor',
			'thumbnail'
		);

		$args = array(
			'labels' => $labels,
			'description' => $descricao,
			'public' => true,
			'menu_icon' => 'dashicons-businessman',
			'supports' => $supports
		);

		register_post_type( 'vaga', $args);	
	}

	add_action('init', 'registrar_vagas');

	function taxonomia_cidade() {
		$singular = 'Cidade';
		$plural = 'Cidades';

		$labels = array(
			'name' => $plural,
			'singular_name' => $singular,
			'view_item' => 'Ver ' . $singular,
			'edit_item' => 'Editar ' . $singular,
			'new_item' => 'Nova ' . $singular,
			'add_new_item' => 'Adicionar nova ' . $singular
			);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'hierarchical' => true
			);

		register_taxonomy('cidade', 'vaga', $args);
	}

	add_action( 'init' , 'taxonomia_cidade' );

	function taxonomia_estado() {
		$singular = 'Estado';
		$plural = 'Estados';

		$labels = array(
			'name' => $plural,
			'singular_name' => $singular,
			'view_item' => 'Ver ' . $singular,
			'edit_item' => 'Editar ' . $singular,
			'new_item' => 'Novo ' . $singular,
			'add_new_item' => 'Adicionar novo ' . $singular
			);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'hierarchical' => true
			);

		register_taxonomy('estado', 'vaga', $args);
	}

	add_action( 'init' , 'taxonomia_estado' );

	function taxonomia_empresa() {
		$singular = 'Empresa';
		$plural = 'Empresas';

		$labels = array(
			'name' => $plural,
			'singular_name' => $singular,
			'view_item' => 'Ver ' . $singular,
			'edit_item' => 'Editar ' . $singular,
			'new_item' => 'Nova ' . $singular,
			'add_new_item' => 'Adicionar nova ' . $singular
			);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'hierarchical' => true
			);

		register_taxonomy('empresa', 'vaga', $args);
	}

	add_action( 'init' , 'taxonomia_empresa' );

	function taxonomia_area() {
		$singular = 'Área';
		$plural = 'Áreas';

		$labels = array(
			'name' => $plural,
			'singular_name' => $singular,
			'view_item' => 'Ver ' . $singular,
			'edit_item' => 'Editar ' . $singular,
			'new_item' => 'Nova ' . $singular,
			'add_new_item' => 'Adicionar nova ' . $singular
			);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'hierarchical' => true
			);

		register_taxonomy('area', 'vaga', $args);
	}
	add_action( 'init' , 'taxonomia_area' );

	function registrar_grupos() {
		$descricao = 'Usado para listar os grupos do Trampo';
		$singular = 'Grupo';
		$plural = 'Grupos';

		$labels = array(
			'name' => $plural,
			'singular_name' => $singular,
			'view_item' => 'Ver ' . $singular,
			'edit_item' => 'Editar ' . $singular,
			'new_item' => 'Novo ' . $singular,
			'add_new_item' => 'Adicionar novo ' . $singular
		);

		$supports = array(
			'title',
			'editor',
			'thumbnail'
		);

		$args = array(
			'labels' => $labels,
			'description' => $descricao,
			'public' => true,
			'menu_icon' => 'dashicons-groups',
			'supports' => $supports
		);

		register_post_type( 'grupo', $args);	
	}
	add_action('init', 'registrar_grupos');

	function taxonomia_estado_regiao() {
		$singular = 'Estado-região';
		$plural = 'Estado-regiões';

		$labels = array(
			'name' => $plural,
			'singular_name' => $singular,
			'view_item' => 'Ver ' . $singular,
			'edit_item' => 'Editar ' . $singular,
			'new_item' => 'Nova ' . $singular,
			'add_new_item' => 'Adicionar nova ' . $singular
			);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'hierarchical' => true
			);

		register_taxonomy('estado-regiao', 'grupo', $args);
	}
	add_action( 'init' , 'taxonomia_estado_regiao' );

	function registrar_servicos() {
		$descricao = 'Usado para listar os servicos do Trampo';
		$singular = 'Serviço';
		$plural = 'Serviços';

		$labels = array(
			'name' => $plural,
			'singular_name' => $singular,
			'view_item' => 'Ver ' . $singular,
			'edit_item' => 'Editar ' . $singular,
			'new_item' => 'Novo ' . $singular,
			'add_new_item' => 'Adicionar novo ' . $singular
		);

		$supports = array(
			'title',
			'editor',
			'thumbnail'
		);

		$args = array(
			'labels' => $labels,
			'description' => $descricao,
			'public' => true,
			'menu_icon' => 'dashicons-store',
			'supports' => $supports
		);

		register_post_type( 'servico', $args);	
	}
	add_action('init', 'registrar_servicos');

	function adicionar_meta_info_vagas() {
		add_meta_box(
			'informacoes_vaga',
			'Informações da Vaga',
			'informacoes_vaga_container',
			'vaga',
			'normal',
			'high'
		);
	}

	add_action('add_meta_boxes', 'adicionar_meta_info_vagas');

	function informacoes_vaga_container( $post ) { 
		$vagas_meta_data = get_post_meta( $post->ID ); ?>

		<style>
			.metabox {
				display: flex;
				justify-content: space-between;
			}

			.metabox-item {
				flex-basis: 30%;

			}

			.metabox-item label {
				font-weight: 700;
				display: block;
				margin: .5rem 0;

			}

			.input-addon-wrapper {
				height: 30px;
				display: flex;
				align-items: center;
			}

			.input-addon {
				display: block;
				border: 1px solid #CCC;
				border-bottom-left-radius: 5px;
				border-top-left-radius: 5px;
				height: 100%;
				width: 30px;
				text-align: center;
				line-height: 30px;
				box-sizing: border-box;
				background-color: #888;
				color: #FFF;
			}

			.metabox-input {
				width: 150px;
				height: 30px;
				border: 1px solid #CCC;
				margin: 0;
			}

		</style>
		<?php
			$numero_rand = 0;
			$string_codigo = "";
			for($i = 0; $i < 9 ; $i++){
				$numero_rand = rand(0,9);
				$string_codigo = $string_codigo.$numero_rand;
			}
			if ($vagas_meta_data['codigo_id'][0] == "")
				echo "<script>window.alert('Codigo da nova vaga: ".$string_codigo."');</script>";
		?>
		<p>
			<strong>Código unico da vaga</strong>: 

			<?php
				$codigo_final = "";
				if ($vagas_meta_data['codigo_id'][0] == ""){
					echo $string_codigo; 
					$codigo_final = $string_codigo;
				} else {
					echo $vagas_meta_data['codigo_id'][0];
					$codigo_final = $vagas_meta_data['codigo_id'][0];
				}
			?>

		</p>
		<div class="metabox-item" style="margin-top: 10px;">
			<label id="linkvaga-input-label" for="linkvaga-input">Email ou Link externo da vaga:</label>
			<input id="linkvaga-input" name="linkvaga_id" style="width: 100%" value="<?= $vagas_meta_data['linkvaga_id'][0]; ?>">
		</div>
		<div class="metabox-item" style="margin-top: 10px;">
			<label id="nomesistema-input-label" for="nomesistema-input">Identificação da vaga:</label>
			<input id="nomesistema-input" name="nomesistema_id" style="width: 100%" value="<?= $vagas_meta_data['nomesistema_id'][0]; ?>">
		</div>
		<div class="metabox-item" style="margin-top: 10px;">
			<label id="origemvaga-input-label" for="origemvaga-input">Fonte de Origem:</label>
			<input id="origemvaga-input" name="origemvaga_id" placeholder="(Email) ou (Nome do Site)" style="width: 100%" value="<?= $vagas_meta_data['origemvaga_id'][0]; ?>">
		</div>
		<script>
			var a = conta_char();
			function conta_char(){	
				valor = document.getElementById('textarea-input').value;
				tam = valor.length;
				document.getElementById('textarea-input-count').innerHTML = "Resumo chamativo ("+(500-tam)+" caracteres):";
			}
		</script>
		<div class="metabox-item" style="margin-top: 10px;">
			<label id="textarea-input-count" for="textarea-input">Resumo chamativo:</label>
			<textarea id="textarea-input" name="textarea_id" style="width: 100%" rows="4" onkeyUp="conta_char()" maxlength="500"><?= $vagas_meta_data['textarea_id'][0]; ?></textarea>
		</div>
		<div class="metabox-item" style="margin-top: 10px;">
			<label id="premium-vaga-label" for="premium-vaga-input">Premium:</label>
			<select style="width:100%" id="premium-vaga" class="metabox-input" name="premiumvaga_id">
				<?php
					if ($vagas_meta_data['premiumvaga_id'][0] == "")
						echo '<option value="">Selecione uma opção</option>';
					else
						echo '<option value="'.$vagas_meta_data['premiumvaga_id'][0].'">'.$vagas_meta_data['premiumvaga_id'][0].' (Selecionado)</option>'; 
				?>
				<option value="Não">Não</option>
				<option value="Sim">Sim</option>
			</select> 
		</div>

		<div class="metabox-item" style="margin-top: 10px;">
			<label for="preco-input">Salario:</label>
			<div class="input-addon-wrapper">
				<span class="input-addon">R$</span>
				<input style="width:100%" id="preco-input" class="metabox-input" type="text" name="salario_id"
				value="<?= $vagas_meta_data['salario_id'][0]; ?>">
			</div>
		</div>

		<div class="metabox-item" style="margin-top: 10px;">
			<label for="vagas-input">Nivel:</label>
			<select style="width:100%" id="vagas-input" class="metabox-input" name="nivelvaga_id">
				<?php
					if ($vagas_meta_data['nivelvaga_id'][0] == "")
						echo '<option value="">Selecione uma opção</option>';
					else
						echo '<option value="'.$vagas_meta_data['nivelvaga_id'][0].'">'.$vagas_meta_data['nivelvaga_id'][0].' (Selecionado)</option>'; 
				?>
				<option value="Júnior">Júnior</option>
				<option value="Pleno">Pleno</option>
				<option value="Sênior">Sênior</option>
				<option value="Trainee">Trainee</option>
				<option value="Master">Master</option>
			</select> 
		</div>

		<div class="metabox-item" style="margin-top: 10px;">
			<label for="banheiros-input">Formação:</label>
			<select style="width:100%" id="banheiros-input" class="metabox-input" name="formacao_id">
				<?php
					if ($vagas_meta_data['formacao_id'][0] == "")
						echo '<option value="">Selecione uma opção</option>';
					else
						echo '<option value="'.$vagas_meta_data['formacao_id'][0].'">'.$vagas_meta_data['formacao_id'][0].' (Selecionado)</option>'; 
				?>
				<option value="Ensino Fundamental">Ensino Fundamental</option>
				<option value="Ensino Médio">Ensino Médio</option>
				<option value="Ensino Superior">Ensino Superior</option>
				<option value="Mestrado/Doutorado">Mestrado/Doutorado</option>
			</select> 
		</div>

		<div class="metabox-item" style="margin-top: 10px;">
			<label for="quartos-input">Forma de contratação:</label>
			<select style="width:100%" id="quartos-input" class="metabox-input" name="tipo_id">
				<?php
					if ($vagas_meta_data['tipo_id'][0] == "")
						echo '<option value="">Selecione uma opção</option>';
					else
						echo '<option value="'.$vagas_meta_data['tipo_id'][0].'">'.$vagas_meta_data['tipo_id'][0].' (Selecionado)</option>'; 
				?>
				<option value="Efetivo">Efetivo</option>
				<option value="PJ">PJ</option>
				<option value="Temporário">Temporário</option>
				<option value="Aprendiz">Aprendiz</option>
				<option value="Estágio">Estágio</option>
				<option value="Freelancer">Freelancer</option>
			</select> 
		</div>

		<input type="hidden" name="codigo_id" value="<?= $codigo_final; ?>">
		<br>
		<p align="center" style="margin-bottom: 10px; a:hover{text-color: #000000;}"><a href="#submitdiv" style="box-shadow: 1px -1px -1px black;background-color: rgba(0,0,0,0.1); border: 1px black solid; border-radius: 3px; padding: 10px;">Ir para publicar</a></p>

	<?php

	}

	function salvar_meta_info( $post_id ) {
		if( isset($_POST['salario_id']) ) {
			update_post_meta( $post_id, 'salario_id', sanitize_text_field( $_POST['salario_id'] ) );
		}
		if( isset($_POST['nivelvaga_id']) ) {
			update_post_meta( $post_id, 'nivelvaga_id', sanitize_text_field( $_POST['nivelvaga_id'] ) );
		}
		if( isset($_POST['formacao_id']) ) {
			update_post_meta( $post_id, 'formacao_id', sanitize_text_field( $_POST['formacao_id'] ) );
		}
		if( isset($_POST['tipo_id']) ) {
			update_post_meta( $post_id, 'tipo_id', sanitize_text_field( $_POST['tipo_id'] ) );
		}
		if( isset($_POST['codigo_id']) ) {
			update_post_meta( $post_id, 'codigo_id', sanitize_text_field( $_POST['codigo_id'] ) );
		}
		if( isset($_POST['textarea_id']) ) {
			update_post_meta( $post_id, 'textarea_id', sanitize_text_field( $_POST['textarea_id'] ) );
		}
		if( isset($_POST['nomesistema_id']) ) {
			update_post_meta( $post_id, 'nomesistema_id', sanitize_text_field( $_POST['nomesistema_id'] ) );
		}
		if( isset($_POST['linkvaga_id']) ) {
			update_post_meta( $post_id, 'linkvaga_id', sanitize_text_field( $_POST['linkvaga_id'] ) );
		}
		if( isset($_POST['origemvaga_id']) ) {
			update_post_meta( $post_id, 'origemvaga_id', sanitize_text_field( $_POST['origemvaga_id'] ) );
		}
		if( isset($_POST['premiumvaga_id']) ) {
			update_post_meta( $post_id, 'premiumvaga_id', sanitize_text_field( $_POST['premiumvaga_id'] ) );
		}
	}

	add_action('save_post', 'salvar_meta_info');

	function adicionar_meta_info_grupo() {
		add_meta_box(
			'informacoes_grupo',
			'Informações do Grupo',
			'informacoes_grupo_container',
			'grupo',
			'normal',
			'high'
		);
	}
	add_action('add_meta_boxes', 'adicionar_meta_info_grupo');

	function informacoes_grupo_container( $post ) { 
		$grupos_meta_data = get_post_meta( $post->ID ); ?>

		<style>

			.metabox-item label {
				font-weight: 700;
				display: block;
				margin: .5rem 0;

			}

			.input-addon-wrapper {
				height: 30px;
				display: flex;
				align-items: center;
			}

			.input-addon {
				display: block;
				border: 1px solid #CCC;
				border-bottom-left-radius: 5px;
				border-top-left-radius: 5px;
				height: 100%;
				width: 30px;
				text-align: center;
				line-height: 30px;
				box-sizing: border-box;
				background-color: #fff;
				padding-top: 8px;
			}

			.metabox-input {
				width: 100vh;
				height: 30px;
				border: 1px solid #CCC;
				margin: 0;
			}

		</style>
		<div class="metabox">	
			<div class="metabox-item">
				<label for="grupo-nome-input">Nome do grupo:</label>
				<input id="grupo-nome-input" class="metabox-input" type="text" name="grupo_nome_id"
					value="<?= $grupos_meta_data['grupo_nome_id'][0]; ?>">
			</div>		
			<div class="metabox-item">
				<label for="link-input">Link do grupo:</label>
				<input id="link-input" class="metabox-input" type="text" name="grupo_id"
					value="<?= $grupos_meta_data['grupo_id'][0]; ?>">
			</div>
			<div class="metabox-item">
				<label for="quartos-input">Status do grupo:</label>
				<select id="quartos-input" class="metabox-input" name="disponibilidade_id">
					<?php
						if ($grupos_meta_data['disponibilidade_id'][0] == "")
							echo '<option value="null">Selecione a situação do grupo</option>';
						else
							echo '<option value="'.$grupos_meta_data['disponibilidade_id'][0].'">'.$grupos_meta_data['disponibilidade_id'][0].' (Selecionado)</option>'; 
					?>
					<option value="Disponivel" style="color:green">Disponivel</option>
					<option value="Cheio"  style="color:red">Cheio</option>
				</select>
			</div>
		</div>

	<?php

	}

	function salvar_meta_info_grupo( $post_id ) {
		if( isset($_POST['grupo_nome_id']) ) {
			update_post_meta( $post_id, 'grupo_nome_id', sanitize_text_field( $_POST['grupo_nome_id'] ) );
		}
		if( isset($_POST['grupo_id']) ) {
			update_post_meta( $post_id, 'grupo_id', sanitize_text_field( $_POST['grupo_id'] ) );
		}
		if( isset($_POST['disponibilidade_id']) ) {
			update_post_meta( $post_id, 'disponibilidade_id', sanitize_text_field( $_POST['disponibilidade_id'] ) );
		}
	}

	add_action('save_post', 'salvar_meta_info_grupo');

	function adicionar_meta_info_servico() {
		add_meta_box(
			'informacoes_servico',
			'Informações do Serviço',
			'informacoes_servico_container',
			'servico',
			'normal',
			'high'
		);
	}
	add_action('add_meta_boxes', 'adicionar_meta_info_servico');

	function informacoes_servico_container( $post ) { 
		$servicos_meta_data = get_post_meta( $post->ID ); ?>

		<style>

			.metabox-item label {
				font-weight: 700;
				display: block;
				margin: .5rem 0;

			}

			.input-addon-wrapper {
				height: 30px;
				display: flex;
				align-items: center;
			}

			.input-addon {
				display: block;
				border: 1px solid #CCC;
				border-bottom-left-radius: 5px;
				border-top-left-radius: 5px;
				height: 100%;
				width: 30px;
				text-align: center;
				line-height: 30px;
				box-sizing: border-box;
				background-color: #fff;
				padding-top: 8px;
			}

			.metabox-input {
				width: 100vh;
				height: 30px;
				border: 1px solid #CCC;
				margin: 0;
			}

		</style>
		<script>
			function conta_char_servico(){	
				valor = document.getElementById('servico-textarea-input').value;
				tam = valor.length;
				document.getElementById('servico-textarea-input-label').innerHTML = "Descrição ("+(150-tam)+" caracteres):";
			}
		</script>
		<div class="metabox">			
			<div class="metabox-item">
				<label for="link-input">Icone (Font Awesome):</label>
				<input id="link-input" class="metabox-input" type="text" name="servico_icone_id"
					value="<?= $servicos_meta_data['servico_icone_id'][0]; ?>">
			</div>
			<div class="metabox-item">
				<label for="link-input">Nome do serviço:</label>
				<input id="link-input" class="metabox-input" type="text" name="servico_nome_id"
					value="<?= $servicos_meta_data['servico_nome_id'][0]; ?>">
			</div>
			<div class="metabox-item">
				<label id="servico-textarea-input-label" for="servico-textarea-input">Descrição:</label>
				<textarea id="servico-textarea-input" name="servico_textarea_id" style="width: 100%" rows="3" onkeyUp="conta_char_servico()" maxlength="150"><?= $servicos_meta_data['servico_textarea_id'][0]; ?></textarea>
			</div>
		</div>

	<?php

	}

	function salvar_meta_info_servico( $post_id ) {
		if( isset($_POST['servico_icone_id']) ) {
			update_post_meta( $post_id, 'servico_icone_id', sanitize_text_field( $_POST['servico_icone_id'] ) );
		}
		if( isset($_POST['servico_nome_id']) ) {
			update_post_meta( $post_id, 'servico_nome_id', sanitize_text_field( $_POST['servico_nome_id'] ) );
		}
		if( isset($_POST['servico_textarea_id']) ) {
			update_post_meta( $post_id, 'servico_textarea_id', sanitize_text_field( $_POST['servico_textarea_id'] ) );
		}
	}

	add_action('save_post', 'salvar_meta_info_servico');

	function enviar_email($email, $titulo, $mensagem) {
			return wp_mail($email, $titulo, $mensagem);
	}

	function the_breadcrumb() {
			echo '<ol class="breadcrumb">';
		if (!is_home()) {
			echo '<li class="breadcrumb-item"><a href="';
			echo get_option('home');
			echo '">';
			echo '<i class="fa fa-home"></i> Home';
			echo "</a></li>";
			if (is_category() || is_single()) {
				echo '<li class="breadcrumb-item">';
				the_category(' </li><li> ');
				if (is_single()) {
					echo '</li><li class="breadcrumb-item-active">';
					the_title();
					echo '</li>';
				}
			} elseif (is_page()) {
				echo '<li class="breadcrumb-item-active">';
				echo the_title();
				echo '</li>';
			}
		}
		elseif (is_tag()) {single_tag_title();}
		elseif (is_day()) {echo'<li class="breadcrumb-item">Aquivo para '; the_time('F jS, Y'); echo'</li>';}
		elseif (is_month()) {echo'<li class="breadcrumb-item">Aquivo para '; the_time('F, Y'); echo'</li>';}
		elseif (is_year()) {echo'<li class="breadcrumb-item">Aquivo para '; the_time('Y'); echo'</li>';}
		elseif (is_author()) {echo'<li class="breadcrumb-item">Arquivo do Autor'; echo'</li>';}
		elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo '<li class="breadcrumb-item">Arquivo'; echo'</li>';}
		elseif (is_search()) {echo'<li class="breadcrumb-item">Resultados de busca'; echo'</li>';}
		echo '</ol>';
	}

    function cfw_add_user_social_links( $user_contact ) {

	    $user_contact['twitter']   = __('Twitter', 'textdomain');
	    $user_contact['facebook']  = __('Facebook', 'textdomain');
	    $user_contact['linkedin']  = __('LinkedIn', 'textdomain');
	    $user_contact['googleplus'] = __('Google Plus', 'textdomain');
	    $user_contact['instagram'] = __('Instagram', 'textdomain');
	    $user_contact['youtube']   = __('Youtube', 'textdomain');
	    $user_contact['skype']     = __('Skype', 'textdomain');
	    $user_contact['whatsapp']  = __('Whatsapp', 'textdomain');
	    return $user_contact;
	}
	add_filter('user_contactmethods', 'cfw_add_user_social_links');

	function tm_additional_profile_fields( $user ) {

	    $months 	= array( 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro' );
	    $default	= array( 'day' => 1, 'month' => 'Janeiro', 'year' => 1980, );
	   
	    $birth_date = wp_parse_args( get_the_author_meta('birth_date', $user->ID ), $default );
	    $funcao_user = get_the_author_meta('funcao_user', $user->ID );
	    $formacao_user = get_the_author_meta('formacao_user', $user->ID );
	    $cidade_user = get_the_author_meta('cidade_user', $user->ID );
	    $estado_user = get_the_author_meta('estado_user', $user->ID );

	    ?>
	    <h3>Informações Extras</h3>

	    <table class="form-table">
	   	 <tr>
	   		 <th><label for="birth-date-day">Data de nascimento</label></th>
	   		 <td>
	   			 <select id="birth-date-day" name="birth_date[day]"><?php
	   				 for ( $i = 1; $i <= 31; $i++ ) {
	   					 printf( '<option value="%1$s" %2$s>%1$s</option>', $i, selected( $birth_date['day'], $i, false ) );
	   				 }
	   			 ?></select>
	   			 <select id="birth-date-month" name="birth_date[month]"><?php
	   				 foreach ( $months as $month ) {
	   					 printf( '<option value="%1$s" %2$s>%1$s</option>', $month, selected( $birth_date['month'], $month, false ) );
	   				 }
	   			 ?></select>
	   			 <select id="birth-date-year" name="birth_date[year]"><?php
	   				 for ( $i = 1950; $i <= 2015; $i++ ) {
	   					 printf( '<option value="%1$s" %2$s>%1$s</option>', $i, selected( $birth_date['year'], $i, false ) );
	   				 }
	   			 ?></select>
	   		 </td>
	   	 </tr>
	   	 <tr>
	   		 <th><label for="funcao_user">Profissão</label></th>
	   		 <td>
	   			 <input id="funcao_user" type="text" name="funcao_user" style="width:50%" value="<?= $funcao_user; ?>">
	   		 </td>
	   	 </tr>
	   	 <tr>
	   		 <th><label for="formacao_user">Formação</label></th>
	   		 <td>
	   			 <input id="formacao_user" type="text" name="formacao_user" style="width:50%" value="<?= $formacao_user; ?>">
	   		 </td>
	   	 </tr>
	   	 <tr>
	   		 <th><label for="cidade_user">Cidade</label></th>
	   		 <td>
	   			 <input id="cidade_user" type="text" name="cidade_user" style="width:50%" value="<?= $cidade_user; ?>">
	   		 </td>
	   	 </tr>
	     <tr>
	   		 <th><label for="estado_user">Estado</label></th>
	   		 <td>
	   			 <input id="estado_user" type="text" name="estado_user" style="width:50%" value="<?= $estado_user; ?>">
	   		 </td>
	   	 </tr>
	    </table>
	    <?php
	}

	add_action( 'show_user_profile', 'tm_additional_profile_fields' );
	add_action( 'edit_user_profile', 'tm_additional_profile_fields' );

	function tm_save_profile_fields( $user_id ) {

	    if ( ! current_user_can( 'edit_user', $user_id ) ) {
	   	 return false;
	    }

	    update_usermeta( $user_id, 'birth_date', $_POST['birth_date'] );
	    update_usermeta( $user_id, 'funcao_user', $_POST['funcao_user'] );
	    update_usermeta( $user_id, 'formacao_user', $_POST['formacao_user'] );
	    update_usermeta( $user_id, 'cidade_user', $_POST['cidade_user'] );
	    update_usermeta( $user_id, 'estado_user', $_POST['estado_user'] );
	}

	add_action( 'personal_options_update', 'tm_save_profile_fields' );
	add_action( 'edit_user_profile_update', 'tm_save_profile_fields' );

	function tt_reading_time($postID) {
		 $content = get_post_field('post_content');
		 $word_count = str_word_count(strip_tags($content));
		 $char_count = mb_strlen(strip_tags($content), "UTF-8");
		 
		 $char_lmin=1200; $lmin = 60;
		 
		 $x = $char_count * $lmin;
		 $x = $x / $char_lmin;
		 
		 if ($char_count <= 1200) {
		 $tempo .= '< 1 min';
		 }
		 else {
		 if ($x > 3599) $tempo .= gmdate("H:i:s", $x) . ' min';
		 else $tempo .= gmdate("i:s", $x) . ' min';
		 }
		 return $tempo;
	}

	function scrapeImage($text) {
    	$pattern = '/src=[\'"]?([^\'" >]+)[\'" >]/';
    	preg_match($pattern, $text, $link);
    	$link = $link[1];
    	$link = urldecode($link);
    	return $link;
	}

	function createSlug($str, $delimiter = '-'){
    	$slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
    	return $slug;
  	}    

  	function tirarAcentos($string){
    	return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
  	}

  	function url(){
	    return sprintf(
	      "%s://%s%s",
	      isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
	      $_SERVER['SERVER_NAME'],
	      $_SERVER['REQUEST_URI']
	    );
  	}

  	function redirect($url) {
	    ob_start();
	    header('Location: '.$url);
	    ob_end_flush();
	    die();
  	}

  	function getPostViews($postID){
    	$count_key = 'post_views_count';
    	$count = get_post_meta($postID, $count_key, true);
	    if($count==''){
	        delete_post_meta($postID, $count_key);
	        add_post_meta($postID, $count_key, '0');
	        return "1";
	    }
		else if ($count == '1') {
			return "2";
		}
	    return $count;
	}

  	function setPostViews($postID) {
	    $count_key = 'post_views_count';
	    $count = get_post_meta($postID, $count_key, true);
	    if($count==''){
	        $count = 0;
	        delete_post_meta($postID, $count_key);
	        add_post_meta($postID, $count_key, '0');
	    }else{
	        $count++;
	        update_post_meta($postID, $count_key, $count);
	    }
	}
	// Remove issues with prefetching adding extra views
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

?>