<?php

add_action( 'init', 'create_post_type_partners' );

function create_post_type_partners() {
	$labels = array(
		'name'               => _x( 'Parceiros', 'post type general name' ),
		'singular_name'      => _x( 'Parceiro', 'post type singular name' ),
		'add_new'            => _x( 'Incluir Parceiro', 'book' ),
		'add_new_item'       => __( 'Incluir Novo Parceiro' ),
		'edit_item'          => __( 'Alterar Parceiro' ),
		'new_item'           => __( 'Novo Parceiro' ),
		'all_items'          => __( 'Todos os Parceiros' ),
		'view_item'          => __( 'Ver Parceiro' ),
		'search_items'       => __( 'Procurar Parceiros' ),
		'not_found'          => __( 'Nenhum registro encontrado' ),
		'not_found_in_trash' => __( 'Nenhum registro encontrado na lixeira' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Parceiros'
	);

	$args = array(
		'labels'        => $labels,
		'description'   => 'Gerencia os Parceiros',
		'public'        => true,
		'supports'      => array( 'title', 'thumbnail' ),
		'has_archive'   => true,
	);

	register_post_type( 'bravo_partners', $args);
}

?>