<?php
$output .= '<div id="'.$genopts['template'].'" class="cycle-overlay"></div>';
$output .= '<a id="'.$genopts['template'].'" href="javascript:;" class="prevNav-'.$sliderID.'" style="color: '.$nav_color.'">'.$default_prev.'</a>';
$output .= '<a id="'.$genopts['template'].'" href="javascript:;" class="nextNav-'.$sliderID.'" style="color: '.$nav_color.'">'.$default_next.'</a>';
foreach($loops as $loop){ //Parsing the variables to the created template
    $output .= '<div id="'.$genopts['template'].'" class="item item-'.$sliderID.' '.$xtype.'" data-title="'.$loop['title'].'" data-cycle-desc="'.$loop['text'].'">'."\n";
    $output .= '<img src="'.$loop['img'].'" alt="'.$loop['img'].'">'."\n";
//    $output .= '<div class="caption">'."\n";
//    $output .= '<h3>'.$loop['title'].'</h3>'."\n";
//    $output .= '<p>'.$loop['text'].'</p>'."\n";
//    $output .= '<p>Price: '.$loop['price'].'</p>'."\n";
//    $output .= '<a class="button read_more" href="'.$loop['url'].'">Start Shopping</a>'."\n";
//    $output .= '</div>'."\n";
    $output .= "</div>\n";
}
$output .= '<div id="'.$genopts['template'].'" class="navigation_holder">'."\n";
$output .= '<div class="item_pager item_pager-'.$sliderID.'"></div>'."\n";
$output .= '</div>'."\n";