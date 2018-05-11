<div id="descrrr">
    <div class="container">
        <div class="clearfix white-container">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
                $cat = get_parent_cat($post);
                if($cat){
                    $h1 = get_field('h1', 'category_'.$cat);
                    $text = get_field('text', 'category_'.$cat);
                    $ip = get_field('именительный_падеж', $post->ID);
                    $rp = get_field('предложный_падеж', $post->ID);
                    ?>
                    <h1><?php echo replaceTempl($h1, $ip, $rp); ?></h1>
                    <?php echo replaceTempl($text, $ip, $rp); ?>
                    <?php
                }
            endwhile; endif; ?>
        </div>
    </div>
</div>