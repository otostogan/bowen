<?php

add_action('wp_enqueue_scripts', 'bowen_scripts');

function bowen_scripts(){
    wp_enqueue_style('bowen-css', get_template_directory_uri() . '/assets/css/style.min.css');
    wp_enqueue_script('bowen-js', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), null, true);

    wp_localize_script(
        'bowen-js',
        'bowen_ajax',
        array('ajax_url'=> admin_url('admin-ajax.php'))
    );
}

add_theme_support( 'menus' );

add_action( 'wp_ajax_load', 'load' ); 
add_action( 'wp_ajax_nopriv_load', 'load' ); 
 
function load(){
    $allI = $_POST['allI'];
    $perP = $_POST['perP'];
    $page = $_POST['page'];
    $pageID = $_POST['pageID'];


    $items = get_field('3', $pageID);

    $output = array_slice($items, $perP * $page);

    foreach($output as $item){
        $ulr = '[wp-video-popup video="' . $item[1] . '"]';
                
        // Get thumbNail from Video
        $yturl = $item[1];
        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $yturl, $matches);

        $video_id = $matches[1];

        // Get Thumbnail
        $file_headers = get_headers( 'http://img.youtube.com/vi/' . $video_id . '/maxresdefault.jpg' );
        $is_404 = $file_headers[0] == 'HTTP/1.0 404 Not Found' || false !== strpos( $file_headers[0], '404 Not Found' );
        $video_thumbnail_url = $is_404 ? 'http://img.youtube.com/vi/' . $youtube_id . '/maxresdefault.jpg' : 'http://img.youtube.com/vi/' . $video_id . '/hqdefault.jpg';

        if(empty($item[2])){
            $img = $video_thumbnail_url;
        }else{
            $img = $item[2];
        }
        $counter++;
        if($counter > $perP){
            break;
        }
        ?>
            <div class="sorter__item">
                <div class="sorter__item-img">
                    <img src="<?php echo $img; ?>" class="wp-video-popup">
                    <?php echo do_shortcode($ulr); ?>
                </div>
                <div class="sorter__item-content">
                    <div class="sorter__item-title">
                        <?php echo $item[3]; ?>
                    </div>
                    <div class="sorter__item-desc">
                        <?php echo $item[4]; ?>
                    </div>
                </div>
            </div>                                                                                  
        <?php
    }

    // var_dump($output);

	die; 
}

?>