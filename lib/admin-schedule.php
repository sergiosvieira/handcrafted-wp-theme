<?php

function create_post_type() {
	$labels = array(
		'name'               => _x( 'Agendas', 'post type general name' ),
		'singular_name'      => _x( 'Agenda', 'post type singular name' ),
		'add_new'            => _x( 'Incluir Agenda', 'book' ),
		'add_new_item'       => __( 'Incluir Nova Agenda' ),
		'edit_item'          => __( 'Alterar Agenda' ),
		'new_item'           => __( 'Nova Agenda' ),
		'all_items'          => __( 'Todas as Agendas' ),
		'view_item'          => __( 'Ver Agenda' ),
		'search_items'       => __( 'Procurar Agendas' ),
		'not_found'          => __( 'Nenhum registro encontrado' ),
		'not_found_in_trash' => __( 'Nenhum registro encontrado na lixeira' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Agendas'
	);

	$args = array(
		'labels'        => $labels,
		'description'   => 'Gerencia a agenda de eventos',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'comments' ),
		'has_archive'   => true,
	);

	register_post_type( 'bravo_schedule', $args);
}

function schedule_box() {
    add_meta_box( 
        'schedule_box',
        __( 'Data do Evento', 'myplugin_textdomain' ),
        'schedule_box_content',
        'bravo_schedule'
    );
}

function schedule_box_content( $post ) {	//$nonce = wp_create_nonce( 'schedule_box_content_nonce' );
	wp_nonce_field( plugin_basename( __FILE__ ), 'schedule_box_content_nonce' );

	$date = get_post_meta( get_the_ID(), 'date', true );

	echo '<label for="schedule_date"></label>';
	echo '<input type="text" id="date" name="date" placeholder="Digite a data do evento" value="' . $date . '" />';
}

function schedule_box_save( $post_id ) {
	if (count($_POST) == 0)
	{
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
	return;

	if ( !wp_verify_nonce( $_POST['schedule_box_content_nonce'], plugin_basename( __FILE__ ) ) )
	{
		return;	
	}
	
	if ( 'page' == $_POST['post_type'] ) 
	{
		if ( !current_user_can( 'edit_page', $post_id ) )
		{
			return;	
		}
	} 
	else 
	{
		if ( !current_user_can( 'edit_post', $post_id ) )
		{
			return;	
		}
	}

	$date = $_POST['date'];
	update_post_meta( $post_id, 'date', $date );
}

add_action( 'save_post', 'schedule_box_save' );
add_action( 'add_meta_boxes', 'schedule_box' );

add_action( 'init', 'create_post_type' );

?>