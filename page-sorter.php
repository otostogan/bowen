<?php
/**
* Template Name: ACF Template
*/
global $post;
get_header();
?>

<div class="promo">
    <div class="container">
        <div class="promo__description">
            <?php the_content(); ?>
        </div>
    </div>
</div>
<section class="sorter">
    <div class="container">
        <div class="sorter__top">           
            <div class="sorter__filter">
                <svg class="sorter__filter-mark" width="17" height="11" viewBox="0 0 17 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.02734 0.078125L8.02734 6.07812L14.0273 0.078125L16.0273 2.07812L8.02734 10.0781L0.0273438 2.07812L2.02734 0.078125Z" fill="#1E385B"/>
                </svg>

                <span class="sorter__filter-drop">
                    Select a Category
                </span>
                <ul class="sorter__filter-list ">
                    <?php
                        if(!is_page(10)){
                            ?>
                                <li>
                                    <a href="<?php echo get_permalink(10); ?>">
                                      View All
                                    </a>
                                </li>
                            <?php
                        }
                        $all_pages = ( new WP_Query() )->query( [ 
                            'post_type' => 'page', 
                            'posts_per_page' => -1 
                        ] );
                        $about_id = 10;
                        $about_childrens = get_page_children( $about_id, $all_pages );
                        foreach( $about_childrens as & $page ){
                            unset( 
                                $page->post_content, 
                                $page->post_date_gmt, 
                                $page->post_password, 
                                $page->post_modified_gmt, 
                                $page->post_content_filtered, 
                                $page->post_mime_type
                            );
                        }                    
                        foreach($about_childrens as $item){
                            ?>
                            
                                <li class="<?php if($post->ID === $item->ID){echo 'active';} ?>">
                                    <a href="<?php echo get_permalink($item->ID); ?>">
                                       <?php echo $item->post_title ?>
                                    </a>
                                </li>
                            <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
        <?php
            $perPage = get_field(4);            
            $items = get_field('3');

            $max_page = ceil( count($items) / $perPage);
            
            ?>
                <div class="sorter__content" data-max="<?php echo $max_page; ?>"  data-id="<?php echo $post->ID; ?>" data-page="1" data-perpage="<?php echo $perPage; ?>" data-all="<?php echo count($items); ?>">
            <?php

            foreach ($items as $item){
                $counter++;
                if($counter > $perPage){
                    break;
                }
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
                
                ?>
                    <div class="sorter__item <?php echo 'sorter__item-'.$counter ?>">
                        <div class="sorter__item-img wp-video-popup">
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
                                            document.querySelector("<?php echo '.sorter__item-'.$counter ?> .sorter__item-more").addEventListener('click', function(){
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
        ?>
        </div>
        <?php
            if(count($items) != $perPage and count($items) > $perPage){
                ?>
                    <div class="sorter__load">
                        <span>
                            LOAD MORE
                        </span>
                    </div>
                <?php
            }
        ?>
    </div>
</section>

<?php
get_footer();
?>