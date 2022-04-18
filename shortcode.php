<?php

defined( 'ABSPATH' ) or die(':)');


function alobaidi_video_popup_shortcode($atts){
	if( !empty($atts["url"]) ){
		$url = esc_url($atts["url"]);
	}else{
		$url = null;
	}

	if( !empty($atts["text"]) ){
		$text = $atts["text"];
	}else{
		if( !empty($atts["url"]) ){
			$text = esc_url($atts["url"]);
		}else{
			$text = null;
		}
	}

	if( !empty($atts["auto"]) ){
		if( strtolower($atts["auto"]) == 'no' or $atts["auto"] == "1"){
			$auto = "vp-s";
		}else{
			$auto = "vp-a";
		}
	}else{
		$auto = "vp-a";
	}

	if( !empty($atts["p"]) ){
		$p_before = '<p>';
		$p_after = '</p>';
	}else{
		$p_before = null;
		$p_after = null;
	}

	if( !empty($atts["n"]) ){
		$nofollow = ' rel="nofollow"';
	}else{
		$nofollow = null;
	}

	$filter1 = null;

	$filter2 = apply_filters('wpt_video_popup_shortcode_filter', 0);

	if($filter2 == 1){
		if( !empty($atts["rel"]) ){
			$rel = 1;
		}else{
			$rel = 0;
		}

		$filter1 = apply_filters('wpt_video_popup_attr_filter', $rel);
	}

	if( !empty($atts["url"]) ){
		$parse = parse_url($atts["url"]);
		if( strtolower($parse['host']) == 'soundcloud.com' ){
			if( $auto == 'vp-a' ){
				$sc_auto = '&vp_soundcloud_a=true';
			}else{
				$sc_auto = '&vp_soundcloud_a=false';
			}
			$embed_sc_url = home_url("/?vp_soundcloud=") . $atts["url"] . $sc_auto;
			$data_sc = ' data-soundcloud="1" data-soundcloud-url="'.esc_url($atts["url"]).'" data-embedsc="'.esc_url($embed_sc_url).'"';
			$url = '#';
		}else{
			$data_sc = null;
		}
	}else{
		$data_sc = null;
	}

	if( !empty($atts['wrap']) ){
		if( strtolower($atts['wrap']) == 'no' or $atts['wrap'] == '1' ){
			$dis_wrap = ' data-dwrap="1"';
		}else{
			$dis_wrap = null;
		}
	}else{
		$dis_wrap = null;
	}

	if( !empty($atts['rv']) and $atts['rv'] == '1' ){
		$rv_class = ' vp-dr';
	}else{
		$rv_class = null;
	}

	if( !empty($atts["w"]) ){
		$get_width = $atts["w"];
		$width_attr = ' data-width="'.esc_attr($get_width).'"';
	}else{
		$width_attr = null;
	}

	if( !empty($atts["h"]) ){
		$get_height = $atts["h"];
		$height_attr = ' data-height="'.esc_attr($get_height).'"';
	}else{
		$height_attr = null;
	}

	if( !empty($atts["title"]) ){
		$get_title = $atts["title"];
		$title_attr = ' title="'.esc_attr($get_title).'"';
	}else{
		$title_attr = null;
	}

	if( !empty($atts["co"]) ){
		$get_overlay_color = $atts["co"];
		$overlay_color_attr = ' data-overlay="'.esc_attr($get_overlay_color).'"';
	}else{
		$overlay_color_attr = null;
	}

	if( !empty($atts["dc"]) ){
		$dis_controls_attr = ' data-controls="1"';
	}else{
		$dis_controls_attr = null;
	}

	if( !empty($atts["di"]) ){
		$dis_info_attr = ' data-info="1"';
	}else{
		$dis_info_attr = null;
	}

	if( !empty($atts["iv"]) ){
		$dis_iv_attr = ' data-iv="1"';
	}else{
		$dis_iv_attr = null;
	}

	if( !empty($atts["img"]) ){
		$image_url = $atts["img"];
		$text = null;
		$text = '<img class="vp-img" src="'.$image_url.'">';
	}
	
	$hover = '<div class="sorter__item-hover">
                                <svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle opacity="0.7" cx="45" cy="45" r="45" fill="#02264D"/>
                                    <path d="M46 77.375C37.4136 77.375 29.1789 73.9641 23.1074 67.8926C17.0359 61.8211 13.625 53.5864 13.625 45C13.625 36.4136 17.0359 28.1789 23.1074 22.1074C29.1789 16.0359 37.4136 12.625 46 12.625C54.5864 12.625 62.8211 16.0359 68.8926 22.1074C74.9641 28.1789 78.375 36.4136 78.375 45C78.375 53.5864 74.9641 61.8211 68.8926 67.8926C62.8211 73.9641 54.5864 77.375 46 77.375ZM46 82C55.813 82 65.2241 78.1018 72.163 71.163C79.1018 64.2241 83 54.813 83 45C83 35.187 79.1018 25.7759 72.163 18.837C65.2241 11.8982 55.813 8 46 8C36.187 8 26.7759 11.8982 19.837 18.837C12.8982 25.7759 9 35.187 9 45C9 54.813 12.8982 64.2241 19.837 71.163C26.7759 78.1018 36.187 82 46 82Z" fill="white"/>
                                    <path d="M38.0034 31.3796C38.3816 31.1848 38.8063 31.0982 39.2306 31.1292C39.6549 31.1602 40.0625 31.3077 40.4084 31.5554L56.5959 43.1179C56.8956 43.3318 57.14 43.6142 57.3086 43.9416C57.4772 44.269 57.5651 44.632 57.5651 45.0002C57.5651 45.3685 57.4772 45.7315 57.3086 46.0589C57.14 46.3863 56.8956 46.6687 56.5959 46.8826L40.4084 58.4451C40.0626 58.6926 39.6552 58.84 39.2311 58.871C38.807 58.902 38.3826 58.8154 38.0045 58.6209C37.6264 58.4263 37.3092 58.1313 37.0879 57.7682C36.8666 57.4051 36.7497 56.988 36.75 56.5627V33.4377C36.7496 33.0126 36.8663 32.5956 37.0874 32.2325C37.3085 31.8694 37.6255 31.5743 38.0034 31.3796Z" fill="white"/>
                                </svg>
                            </div>';

	$media = '<a'.$filter1.' class="'.$auto.$rv_class.'" href="'.$url.'"'.$title_attr.$nofollow.$width_attr.$height_attr.$data_sc.$dis_wrap.$overlay_color_attr.$dis_controls_attr.$dis_info_attr.$dis_iv_attr.'>'.$hover.$text.'</a>';

	return $p_before.$media.$p_after;
}
add_shortcode('video_popup', 'alobaidi_video_popup_shortcode');