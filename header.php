<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
		<?php
			if(get_field('1')){
				the_field('1');
			}else{
				bloginfo('name'); echo " | "; bloginfo('description');
			}
		?>
	</title>
	<meta name="description" content="<?php if(get_field('2')){the_field('2');}else{echo "Some Descr";} ?>"/>
	<?php 
	
	wp_head();
	?>
</head>

<body>
	<header>
		<div class="container">
			<h1>
				Header
			</h1>
			<div class="menu">
				<?php
					wp_nav_menu( [
						'menu'            => 'ACF Sorter',
						'container'       => false,
						'container_class' => 'header__nav',
						'menu_class'      => 'header__nav-menu',
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
						'depth'           => 0,
						'walker'          => '',
					] );
				?>
			</div>
		</div>
	</header>
