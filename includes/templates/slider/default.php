<?php
foreach($loops as $loop){ //Parsing the variables to the created template
    $output .= '<div class="item item-'.$sliderID.' '.$xtype.' '.$genopts['template'].'">'."\n";
    $output .= '<img src="'.$loop['img'].'" alt="'.$loop['img'].'">'."\n";
    $output .= '<div class="caption">'."\n";
    $output .= '<h3>'.$loop['title'].'</h3>'."\n";
    $output .= '<p>'.$loop['text'].'</p>'."\n";
    //$output .= '<p>Price: '.$loop['price'].'</p>'."\n";
    $output .= '<a class="button read_more" href="'.$loop['url'].'">Start Shopping</a>'."\n";
    $output .= '</div>'."\n";
    $output .= '</div>'."\n";
}
$output .= '<div class="navigation_holder">'."\n";
$output .= '<a href="javascript:;" class="prevNav-'.$sliderID.'" style="color: '.$nav_color.'">'.$default_prev.'</a><div class="item_pager item_pager-'.$sliderID.'"></div><a href="javascript:;" class="nextNav-'.$sliderID.'" style="color: '.$nav_color.'">'.$default_next.'</a>'."\n";
$output .= '</div>'."\n";