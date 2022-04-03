<?php

add_action('wp_enqueue_scripts', 'bowen_scripts');

function bowen_scripts(){
    wp_enqueue_style('bowen-css', get_template_directory_uri() . '/assets/css/style.min.css');
    wp_enqueue_script('menu-js', get_template_directory_uri() . '/assets/js/menu.js', array('jquery'), null, true);

    if ( is_page_template('page-sorter.php') ) {
        wp_enqueue_script('bowen-js', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), null, true);
    }
    wp_localize_script(
        'bowen-js',
        'bowen_ajax',
        array('ajax_url'=> admin_url('admin-ajax.php'))
    );
}

add_theme_support( 'menus' );
add_theme_support( 'custom-logo' );

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

        $ulr = '[video_popup url="' . $item[1] . '"  img="' . $img .'" wrap="1"]';

        $counter++;
        if($counter > $perP){
            break;
        }
        ?>
           <div class="sorter__item <?php echo 'sorter__item-'. ($counter + $perP); ?>">
                <div class="sorter__item-img wp-video-popup">
                    <div class="sorter__item-hover">
                        <svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle opacity="0.7" cx="45" cy="45" r="45" fill="#02264D"/>
                            <path d="M46 77.375C37.4136 77.375 29.1789 73.9641 23.1074 67.8926C17.0359 61.8211 13.625 53.5864 13.625 45C13.625 36.4136 17.0359 28.1789 23.1074 22.1074C29.1789 16.0359 37.4136 12.625 46 12.625C54.5864 12.625 62.8211 16.0359 68.8926 22.1074C74.9641 28.1789 78.375 36.4136 78.375 45C78.375 53.5864 74.9641 61.8211 68.8926 67.8926C62.8211 73.9641 54.5864 77.375 46 77.375ZM46 82C55.813 82 65.2241 78.1018 72.163 71.163C79.1018 64.2241 83 54.813 83 45C83 35.187 79.1018 25.7759 72.163 18.837C65.2241 11.8982 55.813 8 46 8C36.187 8 26.7759 11.8982 19.837 18.837C12.8982 25.7759 9 35.187 9 45C9 54.813 12.8982 64.2241 19.837 71.163C26.7759 78.1018 36.187 82 46 82Z" fill="white"/>
                            <path d="M38.0034 31.3796C38.3816 31.1848 38.8063 31.0982 39.2306 31.1292C39.6549 31.1602 40.0625 31.3077 40.4084 31.5554L56.5959 43.1179C56.8956 43.3318 57.14 43.6142 57.3086 43.9416C57.4772 44.269 57.5651 44.632 57.5651 45.0002C57.5651 45.3685 57.4772 45.7315 57.3086 46.0589C57.14 46.3863 56.8956 46.6687 56.5959 46.8826L40.4084 58.4451C40.0626 58.6926 39.6552 58.84 39.2311 58.871C38.807 58.902 38.3826 58.8154 38.0045 58.6209C37.6264 58.4263 37.3092 58.1313 37.0879 57.7682C36.8666 57.4051 36.7497 56.988 36.75 56.5627V33.4377C36.7496 33.0126 36.8663 32.5956 37.0874 32.2325C37.3085 31.8694 37.6255 31.5743 38.0034 31.3796Z" fill="white"/>
                        </svg>
                    </div>
                    <?php echo do_shortcode($ulr); ?>
                </div>
                <div class="sorter__item-content">
                    <div class="sorter__item-title">
                        <?php echo $item[3]; ?>
                    </div>
                    <div class="sorter__item-desc">
                        <?php echo getWordsFromString($item[4], 25); ?>
                    </div>
                    <?php
                        $str=explode(" ",$item[4]);
                        if(count($str) > 25){
                            ?>
                                <div class="sorter__item-desc hide">
                                    <?php echo $item[4]; ?>
                                </div>

                            <?php
                        }
                    ?>
                    <?php
                        $_strArr=explode(" ",$item[4]);
                        if(count($_strArr) > 25){
                            ?>
                                <div class="sorter__item-more">
                                    <span>
                                        <svg width="60" height="61" viewBox="0 0 60 61" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_315_125)">
                                            <path d="M29.9997 0.830078C38.2838 0.830078 45.784 4.18816 51.2129 9.61708C56.6418 15.046 59.9999 22.5461 59.9999 30.8303C59.9999 39.1144 56.6418 46.6145 51.2129 52.0435C45.784 57.4724 38.2838 60.8305 29.9997 60.8305C21.7156 60.8305 14.2154 57.4724 8.78651 52.0435C3.35759 46.6145 -0.000488281 39.1144 -0.000488281 30.8303C-0.000488281 22.5461 3.35759 15.046 8.78651 9.61708C14.2154 4.18816 21.7156 0.830078 29.9997 0.830078ZM50.5191 10.3105C45.2678 5.05925 38.013 1.8111 29.9997 1.8111C21.9864 1.8111 14.7312 5.05925 9.48034 10.3105C4.22906 15.5618 0.980917 22.8166 0.980917 30.8299C0.980917 38.8432 4.22906 46.0983 9.48034 51.3492C14.7316 56.6005 21.9864 59.8487 29.9997 59.8487C38.013 59.8487 45.2682 56.6005 50.5191 51.3492C55.7703 46.098 59.0185 38.8432 59.0185 30.8299C59.0185 22.8166 55.7703 15.5614 50.5191 10.3105Z" fill="#01A4BC"/>
                                            <path d="M37.0876 30.2167H17.0845V31.4431H37.0876V34.0359L42.9156 30.8299L37.0876 27.6244V30.2167Z" fill="#01A4BC"/>
                                            </g>
                                            <defs>
                                            <clipPath id="clip0_315_125">
                                            <rect width="60" height="60" fill="white" transform="translate(0 0.830078)"/>
                                            </clipPath>
                                            </defs>
                                        </svg>
                                    </span>
                                    <p>Read More</p>
                                </div>
                                <script>
                                    document.querySelector("<?php echo '.sorter__item-'. ($counter + $perP); ?> .sorter__item-more").addEventListener('click', function(){
                                        const item = this;
                                        item.classList.toggle('active');
                                        item.parentElement.querySelectorAll('.sorter__item-desc').forEach((item)=>{
                                            if(item.classList.contains('hide')){
                                                item.classList.remove('hide');
                                            }else{
                                                item.classList.add('hide');
                                            }
                                        });
                                        if(item.classList.contains('active')){
                                            item.querySelector('p').textContent = 'Read less';
                                        }else{
                                            item.querySelector('p').textContent = 'Read more';
                                        }
                                    });
                                </script>
                            <?php
                        }
                    ?>
                </div>
            </div>                                                                               
        <?php
    }

    // var_dump($output);

	die; 
}

function getWordsFromString($str,$word_count){
	$new_str=$str;
	$_strArr=explode(" ",$str);
	$_tempArr=array();
	if(count($_strArr)>$word_count) 
	{
		foreach ($_strArr as $key=> $value) {
			$_tempArr[]=$value; 
			if($key==$word_count-1)
			{
				$new_str=implode(" ",$_tempArr).' ...';
			}
		}   
	}
	return $new_str;
}

?>