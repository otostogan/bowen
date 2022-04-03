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
	<?php
        $custom_logo__url = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' ); 

    ?>
    <header class="header <?= $class; ?>">
        <div class="header-desctop">
            <div class="container">
                <div class="header__wrapper">
                    <div class="header__logo">
                        <a href="<?php echo home_url( '/' ); ?>">
                            <img src="<?php echo $custom_logo__url[0];  ?>" alt="header__logo-img">
                        </a>
                    </div>
                    <div class="header__right">
                        <div class="header__content">
                            <div class="header__menu">
                                <nav>
                                    <?php
                                        wp_nav_menu([
                                            'theme_location' => 'ACF Sorter',
                                            'container'=> false,
                                            'menu_class'     => 'first__floor visible'

                                        ]);
                                    ?>
                                    
                                </nav>
                            </div>
                        </div>
                        <div class="header__button">
                                <a href="<?php echo $field['button']['url']; ?>"
                                   target="<?php echo $field['button']['target']; ?>">
                                    <?php echo 'Donate' ?>
                                </a>
                        </div>
                        <div class="header__search">
                            <div class="header__search--icon">
                                <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.5649 14.125L10.6727 11.2276M12.2755 7.35526C12.2755 8.80872 11.6981 10.2026 10.6703 11.2304C9.64259 12.2581 8.24866 12.8355 6.7952 12.8355C5.34175 12.8355 3.94782 12.2581 2.92007 11.2304C1.89232 10.2026 1.31494 8.80872 1.31494 7.35526C1.31494 5.90181 1.89232 4.50788 2.92007 3.48013C3.94782 2.45238 5.34175 1.875 6.7952 1.875C8.24866 1.875 9.64259 2.45238 10.6703 3.48013C11.6981 4.50788 12.2755 5.90181 12.2755 7.35526Z" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                                <label>
                                    <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
                                    <input type="search" autocomplete="off" class="search-field" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>"  name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
                                </label>
                                <button type="submit" class="search-submit btn-search" >
                                    <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.5649 14.125L10.6727 11.2276M12.2755 7.35526C12.2755 8.80872 11.6981 10.2026 10.6703 11.2304C9.64259 12.2581 8.24866 12.8355 6.7952 12.8355C5.34175 12.8355 3.94782 12.2581 2.92007 11.2304C1.89232 10.2026 1.31494 8.80872 1.31494 7.35526C1.31494 5.90181 1.89232 4.50788 2.92007 3.48013C3.94782 2.45238 5.34175 1.875 6.7952 1.875C8.24866 1.875 9.64259 2.45238 10.6703 3.48013C11.6981 4.50788 12.2755 5.90181 12.2755 7.35526Z" stroke="#02A4BC" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                    <?php echo esc_attr_x( 'Search', 'submit button' ) ?>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-mobile">
            <div class="container">
                <div class="header-mobile__wrapper">
                    <div class="header-mobile__logo">
                        <a href="<?php echo home_url( '/' ); ?>">
                            <?php echo wp_get_attachment_image( $field['logo']['desctop_logo'], 'full' ) ?>
                        </a>
                    </div>
                    <div class="header-mobile__right">
                        <div class="header-mobile__search">
                            <div class="header-mobile__search--icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <div class="header-mobile__search--content">
                                <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.40011 1.24545L8.99929 7.92439L15.5985 1.26569C15.7284 1.13188 15.8844 1.02682 16.0565 0.957149C16.2286 0.887474 16.4131 0.854701 16.5984 0.860902C16.9619 0.884712 17.3044 1.04162 17.562 1.30233C17.8196 1.56304 17.9747 1.90972 17.9982 2.27765C18 2.45855 17.9655 2.63794 17.8967 2.80493C17.828 2.97193 17.7264 3.12305 17.5982 3.24913L10.979 9.96855L17.5982 16.688C17.8582 16.943 18.0022 17.2952 17.9982 17.6595C17.9747 18.0274 17.8196 18.3741 17.562 18.6348C17.3044 18.8955 16.9619 19.0524 16.5984 19.0762C16.4131 19.0824 16.2286 19.0496 16.0565 18.98C15.8844 18.9103 15.7284 18.8052 15.5985 18.6714L8.99929 12.0127L2.42011 18.6714C2.29018 18.8052 2.13423 18.9103 1.96212 18.98C1.79002 19.0496 1.6055 19.0824 1.42023 19.0762C1.04992 19.0567 0.699873 18.899 0.437667 18.6337C0.175461 18.3683 0.0196848 18.014 0.000409305 17.6392C-0.00140008 17.4583 0.0331173 17.2789 0.101868 17.1119C0.170618 16.9449 0.272169 16.7938 0.40036 16.6677L7.01954 9.96855L0.380362 3.24913C0.255781 3.12135 0.157926 2.96946 0.0926439 2.80255C0.027362 2.63563 -0.0040076 2.45711 0.000409305 2.27765C0.0239351 1.90972 0.178969 1.56304 0.436564 1.30233C0.694159 1.04162 1.0367 0.884712 1.40024 0.860902C1.58406 0.852066 1.76771 0.88165 1.93973 0.94781C2.11176 1.01397 2.26848 1.11529 2.40011 1.24545Z" fill="#FFFFFF"/>
                                </svg>
                                <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                                    <div class="search-group">
                                        <label for="search-field">
                                            <span class="screen-reader-text">Search</span>
                                            <input type="search" id="search-field-mobile-top" placeholder="Search"
                                                   value="<?php echo get_search_query() ?>" name="s">
                                        </label>
                                        <button type="submit">
                                            <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.5649 14.125L10.6727 11.2276M12.2755 7.35526C12.2755 8.80872 11.6981 10.2026 10.6703 11.2304C9.64259 12.2581 8.24866 12.8355 6.7952 12.8355C5.34175 12.8355 3.94782 12.2581 2.92007 11.2304C1.89232 10.2026 1.31494 8.80872 1.31494 7.35526C1.31494 5.90181 1.89232 4.50788 2.92007 3.48013C3.94782 2.45238 5.34175 1.875 6.7952 1.875C8.24866 1.875 9.64259 2.45238 10.6703 3.48013C11.6981 4.50788 12.2755 5.90181 12.2755 7.35526Z" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="header-mobile__nav">
                            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" id="nav-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
