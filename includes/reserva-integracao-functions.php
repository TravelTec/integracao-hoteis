<?php 

session_start();

/*

 * Add my new menu to the Admin Control Panel

 */ 

function integracaohoteis_custom_post_type() {
    register_post_type('integracaohoteis',
        array(
            'labels'      => array(
                'name'               => '',

                'singular_name'      => '',

                'menu_name'          => _x('Integração de hotéis', 'admin menu', 'booking'),

                'name_admin_bar'     => _x('Roomlist', 'add new on admin bar', 'booking'), 

                'add_new'            => '', 

                'add_new_item'       => '',

                'new_item'           => '',

                'edit_item'          => __('Editar propriedade', 'booking'),

                'view_item'          => __('Ver item', 'booking'),

                'all_items'          => '',

                'search_items'       => __('Buscar propriedade', 'booking'),

                'parent_item_colon'  => __('Propriedades:', 'booking'),

                'not_found'          => __('Nenhuma propriedade encontrada.', 'booking'),

                'not_found_in_trash' => __('Nenhuma propriedade encontrada.', 'booking')
            ), 
            'description'        => __('Description.', 'booking'), 
            'public'             => true, 
            'publicly_queryable' => true, 
            'show_ui'            => true,  
            'query_var'          => 'integracaohoteis', 
            'rewrite'            => array('slug' => 'integracaohoteis'), 
            'capability_type' => 'post', 
            'map_meta_cap' => true, 
            'has_archive'        => false, 
            'hierarchical'       => true, 
            'menu_position'      => 55, 
            'can_export' => true,
            'supports' => array('title','editor','excerpt','thumbnail')
        )
    ); 
}
add_action('init', 'integracaohoteis_custom_post_type'); 

function integracao_scripts_booking_js() {  
 
    wp_enqueue_style( 'icon-products-wc', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css?ver=5.7');
    wp_enqueue_style( 'style-products-wc', plugins_url( '/assets/css/stylewoocommerce.css', __FILE__ )); 

    wp_enqueue_style( 'style-bookinghotels', plugins_url( '/assets/css/style.css', __FILE__ )); 
    wp_enqueue_style( 'style-admin', plugins_url( '/assets/css/admin.css', __FILE__ )); 
    wp_enqueue_style( 'style-admin-menu', plugins_url( '/assets/css/admin-menu.css', __FILE__ )); 
    wp_enqueue_style( 'style-admin-skin', plugins_url( '/assets/css/admin-skin.css', __FILE__ )); 
    wp_enqueue_style( 'style-admin-support', plugins_url( '/assets/css/admin-support.css', __FILE__ )); 
    wp_enqueue_style( 'style-admin-toolbar', plugins_url( '/assets/css/admin-toolbar.css', __FILE__ )); 
    wp_enqueue_style( 'style-calendar', plugins_url( '/assets/css/calendar.css', __FILE__ )); 
    wp_enqueue_style( 'style-chosen', plugins_url( '/assets/css/chosen.css', __FILE__ )); 
    wp_enqueue_style( 'style-listing', plugins_url( '/assets/css/listing-table.css', __FILE__ ));
    wp_enqueue_style( 'style-modal', plugins_url( '/assets/css/modal.css', __FILE__ )); 
    wp_enqueue_style( 'style-print', plugins_url( '/assets/css/print.css', __FILE__ ));  
    wp_enqueue_style( 'style-settings', plugins_url( '/assets/css/settings-page.css', __FILE__ )); 
    wp_enqueue_style( 'style-skin', plugins_url( '/assets/css/skin.css', __FILE__ )); 
    wp_enqueue_style( 'style-table', plugins_url( '/assets/css/table.css', __FILE__ )); 
    wp_enqueue_style( 'style-timeline', plugins_url( '/assets/css/timeline.css', __FILE__ )); 
    wp_enqueue_style( 'style-timeline-skin', plugins_url( '/assets/css/timeline-skin.css', __FILE__ )); 
    wp_enqueue_style( 'style-traditional', plugins_url( '/assets/css/traditional.css', __FILE__ )); 
    wp_enqueue_style( 'style-colorpicker', plugins_url( '/assets/css/colorpicker.css', __FILE__ )); 

    wp_enqueue_script( 'jquery-products', plugins_url( '/assets/js/jquery-3.1.1.min.js', __FILE__ )); 
    wp_enqueue_script( 'datetimepicker-products-wc', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js');
    wp_enqueue_script( 'moment-products-wc', plugins_url( '/assets/js/moment.js', __FILE__ ));
    wp_enqueue_script( 'mask-products-wc', plugins_url( '/assets/js/mask.js', __FILE__ ));
    wp_enqueue_script( 'scripts-products-wc', plugins_url( '/assets/js/scriptswoocommerce.js', __FILE__ ));
    wp_enqueue_script( 'scripts-colorpicker', plugins_url( '/assets/js/colorpicker.js', __FILE__ ));
}

add_action('admin_init','integracao_scripts_booking_js', 1);   

function integracaohoteis_recomm_css(){ 
        wp_enqueue_style('style-integracaohoteis', plugin_dir_url(__FILE__).'assets/css/style_site.css');  
    wp_enqueue_style( 'style-datepicker', 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css'); 
    wp_enqueue_style( 'style-fotorama', 'https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css'); 

        wp_enqueue_script('integracaohoteis-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js');
        wp_enqueue_script('integracaohoteis-sweetalert', 'https://unpkg.com/sweetalert/dist/sweetalert.min.js'); 
    wp_enqueue_script( 'scripts-moment', 'https://cdn.jsdelivr.net/momentjs/latest/moment.min.js');
    wp_enqueue_script( 'scripts-datepicker', 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js'); 
    wp_enqueue_script( 'scripts-fotorama', 'https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js');

    wp_enqueue_script('woocommerce-ajax-add-to-cart', plugin_dir_url(__FILE__) . 'assets/js/ajax-add-to-cart.js', array('jquery'), '', true); 


        wp_register_script('lintegracaohoteis-scripts', plugin_dir_url(__FILE__).'assets/js/scripts_site_ttbooking.js'); 
    wp_localize_script( 'lintegracaohoteis-scripts', 'my_ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'nonce' => wp_create_nonce('ajax-nonce') ) );

   wp_enqueue_script( 'lintegracaohoteis-scripts' );
    }
add_action('wp_head' , 'integracaohoteis_recomm_css' );    

function integracaohoteis_create_localizacao_taxonomies(){ 
    $labels = array(

        'name'              => _x('Localização', 'taxonomy general name', 'booking'),

        'singular_name'     => _x('Localização', 'taxonomy singular name', 'booking'),

        'search_items'      => __('Buscar Localização', 'booking'),

        'all_items'         => __('Todas as localizações', 'booking'),

        'parent_item'       => __('Localização Pai', 'booking'),

        'parent_item_colon' => __('Localização Pai', 'booking'),

        'edit_item'         => __('Editar localização', 'booking'),

        'update_item'       => __('Editar localização', 'booking'),

        'add_new_item'      => __('Nova localização', 'booking'),

        'new_item_name'     => __('Nome nova localização', 'booking'),

        'menu_name'         => __('Localização', 'booking'),

    );



    $args = array(

        'hierarchical'      => true,

        'labels'            => $labels,

        'show_ui'           => true,

        'show_in_rest'       => false,

        'show_admin_column' => true,

            'menu_position'      => 200,

        'rewrite'           => array('slug' => 'localizacao_integracao', 'hierarchical' => true),

    );



    register_taxonomy('localizacao_integracao', array('integracaohoteis'), $args);

}
add_action('init', 'integracaohoteis_create_localizacao_taxonomies', 10, 2);  


function integracaohoteis_create_termos_taxonomies(){ 
    $labels = array(

        'name'              => _x('Termos de reserva', 'taxonomy general name', 'booking'),

        'singular_name'     => _x('Termos de reserva', 'taxonomy singular name', 'booking'),

        'search_items'      => __('Buscar termos', 'booking'),

        'all_items'         => __('Todos os termos', 'booking'),

        'parent_item'       => __('Termo Pai', 'booking'),

        'parent_item_colon' => __('Termo Pai', 'booking'),

        'edit_item'         => __('Editar termo', 'booking'),

        'update_item'       => __('Editar termo', 'booking'),

        'add_new_item'      => __('Novo termo', 'booking'),

        'new_item_name'     => __('Nome novo termo', 'booking'),

        'menu_name'         => __('Termos de reserva', 'booking'),

    );



    $args = array(

        'hierarchical'      => true,

        'labels'            => $labels,

        'show_ui'           => true,

        'show_in_rest'       => false,

        'show_admin_column' => true,

            'menu_position'      => 200,

        'rewrite'           => array('slug' => 'termos_integracao', 'hierarchical' => true),

    );



    register_taxonomy('termos_integracao', array('integracaohoteis'), $args);

}
add_action('init', 'integracaohoteis_create_termos_taxonomies', 10, 2);   

 

add_action('admin_menu', 'integracao_add_page_termos');

function integracao_add_page_termos(){

     add_submenu_page(
                     'edit.php?post_type=integracaohoteis', //$parent_slug
                     'Roomlist',  //$page_title
                     'Roomlist',        //$menu_title
                     'manage_options',           //$capability
                     'post-new',//$menu_slug
                     'integracao_render_add_page_termos',//$function
                     0
     );

}

//add_submenu_page callback function

function integracao_render_add_page_termos() {

    require plugin_dir_path(dirname(__FILE__)) . 'includes/backend/submenu/themes.php';

}
 
add_action('wp_ajax_my_action', 'my_action_callback');

function my_action_callback() {
    global $wpdb; // this is how you get access to the database

    $term = $_POST['destino'];
    $data_inicial = explode("-", $_POST['data_inicio']);
    $slug = strtolower(str_replace(" ", "-", $_POST['destino']));

    $tip_cat_desc = get_term_by('name', $term, 'product_cat');
    $tip_cat_id = $tip_cat_desc->term_id;

    if (!empty($tip_cat_id)) { 
        wp_delete_term( $tip_cat_id, 'product_cat' );
    }

    wp_insert_term(
        $term, // the term 
        'product_cat', // the Woocommerce product category taxonomy
        array( // (optional)
            'description'=> 'Pesquisa realizada para a propriedade '.$_POST['destino'].' no período de '.str_replace("-", "/", $_POST['data_inicio']).' a '.str_replace("-", "/", $_POST['data_final']).'.', // (optional)
            'slug' => $slug 
        )
    ); 

    echo $slug;

    die(); // this is required to return a proper result


}

function Generate_Featured_Image( $image_url, $post_id  ){
    $upload_dir = wp_upload_dir();
    $image_data = file_get_contents($image_url);
    $filename = basename($image_url);
    if(wp_mkdir_p($upload_dir['path']))     $file = $upload_dir['path'] . '/' . $filename;
    else                                    $file = $upload_dir['basedir'] . '/' . $filename;
    file_put_contents($file, $image_data);

    $wp_filetype = wp_check_filetype($filename, null );
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name($filename),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attach_id = wp_insert_attachment( $attachment, $file, $post_id );
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
    $res1= wp_update_attachment_metadata( $attach_id, $attach_data );
    $res2= set_post_thumbnail( $post_id, $attach_id );
}

function generate_sku($length = 3) {
    return substr(str_shuffle("0123456789"), 0, $length);
} 

add_action('wp_ajax_my_actiondados', 'my_actiondados_callback');

function my_actiondados_callback() { 

    $response = json_decode(str_replace("%s;", "\"", $_POST['resposta']), true); 

    $tag = generate_sku();

    for ($i=0; $i < count($response); $i++) {  

        $descritivo = '<h4>Informação adicional </h4> <table class="woocommerce-product-attributes shop_attributes">
            <tbody><tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--attribute_pa_fornecedor">
            <th class="woocommerce-product-attributes-item__label">Fornecedor</th>
            <td class="woocommerce-product-attributes-item__value"><p>'.$response[$i]["fornecedor"].'</p>
</td>
        </tr>
            <tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--attribute_pa_acomodacao">
            <th class="woocommerce-product-attributes-item__label">Acomodação</th>
            <td class="woocommerce-product-attributes-item__value"><p>'.$response[$i]["acomodacao"].'</p>
</td>
        </tr>
            <tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--attribute_pa_tipo">
            <th class="woocommerce-product-attributes-item__label">Tipo</th>
            <td class="woocommerce-product-attributes-item__value"><p>'.$response[$i]["tipo"].'</p>
</td>
        </tr>
            <tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--attribute_pa_hospedes">
            <th class="woocommerce-product-attributes-item__label">Hospedes</th>
            <td class="woocommerce-product-attributes-item__value"><p>'.$response[$i]["pax"].'</p>
</td>
        </tr>
            <tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--attribute_pa_regime">
            <th class="woocommerce-product-attributes-item__label">Regime</th>
            <td class="woocommerce-product-attributes-item__value"><p>'.$response[$i]["regime"].'</p>
</td>
        </tr>
            <tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--attribute_pa_checkin">
            <th class="woocommerce-product-attributes-item__label">Checkin</th>
            <td class="woocommerce-product-attributes-item__value"><p>'.str_replace("-", "/", $response[$i]["checkin"]).'</p>
</td>
        </tr>
            <tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--attribute_pa_checkout">
            <th class="woocommerce-product-attributes-item__label">Checkout</th>
            <td class="woocommerce-product-attributes-item__value"><p>'.str_replace("-", "/", $response[$i]["checkout"]).'</p>
</td>
        </tr>
            <tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--attribute_pa_diarias">
            <th class="woocommerce-product-attributes-item__label">Diárias</th>
            <td class="woocommerce-product-attributes-item__value"><p>'.$response[$i]["diarias"].'</p>
</td>
        </tr>
    </tbody></table>';

        $post = array( 
            'post_content' => (empty($response[$i]["descricao"]) ? $descritivo : $response[$i]["descricao"].''.$descritivo),
            'post_status' => "publish",
            'post_title' => $response[$i]["nome"],
            'post_parent' => '',
            'post_type' => "product",
        );

        //Create post
        $post_id = wp_insert_post( $post, $wp_error ); 

        wp_set_object_terms( $post_id, $_POST['slug'], 'product_cat' );
        wp_set_object_terms( $post_id, 'simple', 'product_type');
 
        wp_set_object_terms($post_id, $tag, 'product_tag');

        Generate_Featured_Image( str_replace("%u;", "/", $response[$i]["foto"]),   $post_id );
             
        update_post_meta( $post_id, '_visibility', 'visible' );
        update_post_meta( $post_id, '_stock_status', 'instock');
        update_post_meta( $post_id, 'total_sales', '0');
        update_post_meta( $post_id, '_downloadable', 'yes');
        update_post_meta( $post_id, '_virtual', 'yes');
        update_post_meta( $post_id, '_regular_price', intval($response[$i]["preco"]) );
        update_post_meta( $post_id, '_sale_price', intval($response[$i]["preco"]) );
        update_post_meta( $post_id, '_purchase_note', "" );
        update_post_meta( $post_id, '_featured', "no" );
        update_post_meta( $post_id, '_weight', "" );
        update_post_meta( $post_id, '_length', "" );
        update_post_meta( $post_id, '_width', "" );
        update_post_meta( $post_id, '_height', "" );
        update_post_meta( $post_id, '_sku', $tag.'-0'.$i);
        update_post_meta( $post_id, '_product_attributes', array($tag));
        update_post_meta( $post_id, '_sale_price_dates_from', "" );
        update_post_meta( $post_id, '_sale_price_dates_to', "" );
        update_post_meta( $post_id, '_price', intval($response[$i]["preco"]) );
        update_post_meta( $post_id, '_sold_individually', "" );
        update_post_meta( $post_id, '_manage_stock', "no" );
        update_post_meta( $post_id, '_backorders', "no" );
        update_post_meta( $post_id, '_stock', "" ); 
    }

    echo $tag;

    die(); // this is required to return a proper result


}

add_action('init', 'wp_create_wpforms');

function wp_create_wpforms() {  

    $args = array(
        'name'        => "motor-de-reservas",
        'post_type'   => 'wpforms',
        'post_status' => 'publish',
        'numberposts' => 1
    );
    $my_posts = get_posts($args); 

    if (empty($my_posts[0]->post_title)) {   

        $post = array(
                'post_title'   => 'Motor de reservas',
                'post_status'  => 'publish',
                'post_type'    => 'wpforms',
                'post_content' => '{"fields":{"1":{"id":"1","type":"text","label":"Destino","description":"","required":"1","size":"medium","placeholder":"","limit_count":"1","limit_mode":"characters","default_value":"","css":"destino","input_mask":""},"2":{"id":"2","type":"text","label":"Check-in - Check-out","description":"","required":"1","size":"medium","placeholder":"","limit_count":"1","limit_mode":"characters","default_value":"","css":"datas","input_mask":""},"3":{"id":"3","type":"number","label":"Adultos","description":"","required":"1","size":"small","placeholder":"","default_value":"2","css":"qtd_adt wpforms-one-third wpforms-first"},"4":{"id":"4","type":"number","label":"Crian\u00e7as","description":"","size":"small","placeholder":"","default_value":"0","css":"qtd_chd wpforms-one-third"},"6":{"id":"6","type":"number","label":"Quartos","description":"","size":"small","placeholder":"","default_value":"1","css":"wpforms-one-third qtd_qts"}},"id":"891","field_id":7,"settings":{"form_title":"Motor de reservas","form_desc":"","form_class":"","submit_text":"Enviar","submit_text_processing":"Enviando...","submit_class":"","antispam":"1","notification_enable":"0","notifications":{"1":{"email":"{admin_email}","subject":"Nova entrada em Motor de reservas","sender_name":"Localhost","sender_address":"{admin_email}","replyto":"","message":"{all_fields}"}},"confirmations":{"1":{"type":"message","message":"","message_scroll":"1","page":"384","redirect":""}}},"meta":{"template":"blank"}}',
            );

        //Create post
        $post_id = wp_insert_post( $post, $wp_error );
    } 
}

add_action('init', 'wp_create_inputs_motor');

function wp_create_inputs_motor() {   

        $propriedade = $atts['propriedade'];

        $tipo_propriedade = [];
   
           $cat_terms = get_terms(
                   array('tipo_propriedades_integracao'),
                   array(
                           'hide_empty'    => false,
                           'orderby'       => 'name',
                           'order'         => 'ASC',
                           'number'        => 50 //specify yours
                       )
               );
   
   if( $cat_terms ){
   
       foreach( $cat_terms as $term ) { 
   
           $propriedades[] = array("tipo_propriedade" => $term->slug);
   
   }
   }   

   for ($i=0; $i < count($propriedades); $i++) { 
       if ($propriedade == $propriedades[$i]["tipo_propriedade"]) { 
           $tipo_motor = $propriedades[$i]["tipo_propriedade"];
       }
   }

        $localizacao = [];
   
           $cat_terms = get_terms(
                   array('localizacao_integracao'),
                   array(
                           'hide_empty'    => false,
                           'orderby'       => 'name',
                           'order'         => 'ASC',
                           'number'        => 50 //specify yours
                       )
               );
   
   if( $cat_terms ){
   
       foreach( $cat_terms as $term ) { 
   
           $locais[] = array("name_local" => $term->name, "name_hotel" => "", "id" => "", "destination" => "");
   
   }
   }   

   $dados = get_option( 'config_ttbookingintegracao' ); 
                for ($i=0; $i < 21; $i++) { 
                  if(!empty($dados['hotel_trend_nh'.$i])){
                    $hotelaria[] = array("name_local" => "", "name_hotel" => $dados['hotel_trend_nh'.$i], "id" => $dados['id_hotel_trend_nh'.$i], "destination" => $dados['destination_hotel_trend_nh'.$i]);
                  }
                }   

                if (empty($locais)) {
                  $total = $hotelaria;
                }else if (empty($hotelaria)) {
                  $total = $locais;
                }else{
                  $total = array_merge($locais, $hotelaria); 
                } 


                echo "<input type='hidden' id='destinos_motor' value='".json_encode($total)."'>
                <input type='hidden' name='destino_pesquisa' id='destino_pesquisa' value=''>
          <input type='hidden' name='id_hotel' id='id_hotel' value=''>
          <input type='hidden' name='id_destination_hotel' id='id_destination_hotel' value=''>
          <input type='hidden' name='destino_hotel' id='destino_hotel' value=''>"; 
}

session_write_close();