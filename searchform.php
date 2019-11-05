<?php
	/**
	Template Name: Search Form
	**/
?>

<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
    <input class="form-control" type="text" id="s" name="s" value="<?php echo get_search_query() ?>" placeholder="Digite algo para pesquisar" >
    <div class="text-center" style="padding-top: 20px">
    	<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>Buscar</button>
	</div>
</form>