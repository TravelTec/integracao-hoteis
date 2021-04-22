<?php 
get_header(); 

$dados = explode("/", $_SERVER['REQUEST_URI']);

$categoria = $dados[1];
$slug = $dados[2];
$descricao_slug = ucwords(str_replace("-", " ", $dados[2]));
if (!empty($dados[3])) {
	$descricao_slug = ucwords(str_replace("-", " ", $dados[2])).' — '.ucwords(str_replace("-", " ", $dados[3]));
	$slug = $dados[3];
}


$cat_terms = get_terms(
                array('categoria_apto'),
                array(
                        'hide_empty'    => false,
                        'orderby'       => 'name',
                        'order'         => 'ASC',
                        'number'        => 6 //specify yours
                    )
            ); 

        $args = array(
                'post_type'             => 'ttbooking',
                'posts_per_page'        => 10, //specify yours
                'post_status'           => 'publish',
                'tax_query'             => array(
                                            array(
                                                'taxonomy' => $categoria,
                                                'field'    => 'slug',
                                                'terms'    => $slug,
                                            ),
                                        ),
                'ignore_sticky_posts'   => true //caller_get_posts is deprecated since 3.1
            );
        $_posts = new WP_Query( $args );  
?>

<!-- Blog Section with Sidebar -->

<style type="text/css"> 
	.page-builder { margin: 0px; padding: 0; } 
	.attachment-post-thumbnail{    display: block;
    max-width: 100%;
    height: 250px;}
</style> 

<div class="page-builder"> 
	<div class="page-title-section" style="display: block !important;">		
			<div class="overlay">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="page-title">
								<h1><?= $descricao_slug; ?></h1>					</div>
						</div>
						<div class="col-md-6">
							<ul class="page-breadcrumb">
								<li><a href="https://wp02.montenegroev.com.br">Início</a> &nbsp; / &nbsp;</li><li class="active"><?= $descricao_slug; ?></li>					</ul>
						</div>
					</div>
				</div>	
			</div>
		</div> 

	<div class="container"> 

		<div class="row">

			<br><br>

			<?php   
    

        if( $_posts->have_posts() ) :
            while( $_posts->have_posts() ) : $_posts->the_post();  
            ?>
            <div class="col-lg-4 col-12">
            	<div class="panel panel-default">
				  <div class="panel-body" style="padding: 0">
				  	<?=the_post_thumbnail();?>
				  	<br>
				    <h3 style="padding: 0px 15px"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				    <div style="height: 250px;padding: 0px 15px"><?php the_excerpt( __( 'Read More' , 'appointment' ) ); ?></div>
				  </div>
				  <div class="panel-footer">
				  	<a href="<?php the_permalink(); ?>" class="more-link">Veja mais »</a>
				  </div>
				</div>
            </div>
            
            <?php
            endwhile;
        endif;
        wp_reset_postdata(); //important 
			?>
		</div>

	</div>

	<br><br>

</div> 

<!-- /Blog Section with Sidebar -->

<?php get_footer(); ?>