<?php
if($default_prev != '' && $default_next !=''){
    $output .= '<a id="'.$genopts['template'].'" href="javascript:;" class="prevNav-'.$sliderID.' xox-prevNav" style="color: '.$nav_color.'">'.$default_prev.'</a>'."\n";
    $output .= '<a id="'.$genopts['template'].'" href="javascript:;" class="nextNav-'.$sliderID.' xox-nextNav" style="color: '.$nav_color.'">'.$default_next.'</a>'."\n";
}
foreach($loops as $loop){ //Parsing the variables to the created template
    $output .= '<div class="item item-'.$sliderID.' '.$xtype.' '.$genopts['template'].'">'."\n";
    $output .= '<div class="canvas">'."\n";
    $output .= '<div class="img_holder">'."\n";
    $output .= '<img src="'.$loop['img'].'" alt="'.$loop['img'].'">'."\n";
    $output .= '</div>'."\n";
    $output .= '</div>'."\n";
    $output .= '<div class="caption">'."\n";
    $output .= '<h3>'.$loop['title'].'</h3>'."\n";
    $output .= '<p>'.$loop['text'].'</p>'."\n";
    //$output .= '<p>Price: '.$loop['price'].'</p>'."\n";
    $output .= '<a class="button read_more xox-buynow" href="'.$loop['url'].'">Buy Now</a>'."\n";
    $output .= '</div>'."\n";
    $output .= '</div>'."\n";
}
$output .= '<div class="navigation_holder">'."\n";
$output .= '<div class="item_pager item_pager-'.$sliderID.'"></div>'."\n";
$output .= '</div>'."\n";