<?php
global $post;
if(get_field('cash', $post)){
    echo get_field('cash', $post);
}else{
    $posts = get_posts(array(
        'post_type'			=> 'post',
        'posts_per_page'	=> 9999,
        'meta_key'			=> 'именительный_падеж',
        'orderby'			=> 'meta_value',
        'order'				=> 'ASC'
    ));

    $lastSimbol = '';
    $i = 0;

    foreach( $posts as $post ){ setup_postdata($post);
        $ip = get_field('именительный_падеж', $post->ID);
        mb_internal_encoding("UTF-8");

        if($lastSimbol != mb_substr($ip,0,1)){
            if($lastSimbol !== ''){
                echo '</div>';
                $i++;
            }

            if($i % 3 == 0){
                echo '<div class="cb"></div>';
            }
            $lastSimbol = mb_substr($ip,0,1);
            echo '<div class="noCompetitor-items__container col-sm-4 col-xs-6 text-justify cityCnt" style="margin-bottom: 20px;">';
            echo '<strong class="text-center simbolll">'.$lastSimbol.'</strong>';
            echo '<div class="porto-separator"><div class="divider divider-small align_center solid "><hr class="simbolSep"></div></div>';
        }else{
            echo ', ';
        }

        setup_postdata( $post );

        echo '<a class="cityLink" href="'.get_page_link($post->ID).'">'.$ip.'</a>';
    }
}