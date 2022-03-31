<?php
/**
* Template Name: ACF Template
*/
global $post;
get_header();
?>

<section class="sorter">
    <div class="container">
        <div class="sorter__top">
            <h1 class="sorter__top-title">
                <?php echo get_the_title(); ?>
            </h1>
            <div class="sorter__top-description">
                <?php the_content(); ?>
            </div>
            <div class="sorter__filter">
                <span class="sorter__filter-title">Select Category:</span>
                <ul class="sorter__filter-list">
                    <?php
                        if(!is_page(10)){
                            ?>
                                <li>
                                    <a href="<?php echo get_permalink(10); ?>">
                                      ACF Sorter
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
                
                ?>
                    <div class="sorter__item wp-video-popup">
                        <div class="sorter__item-img">
                            <img src="<?php echo $img; ?>" class="">
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