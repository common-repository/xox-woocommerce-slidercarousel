<?php
foreach($loops as $loop){
    $output .= '<div id="'.$genopts['template'].'" class="item item-'.$sliderID.' '.$xtype.' '.$genopts['template'].'">'."\n";
    $output .= '<a href="'.$loop['url'].'">'."\n";
    $output .= '<img src="'.$loop['img'].'" alt="'.$loop['img'].'">'."\n";
    $output .= '</a>'."\n";
    $output .= "</div>\n";
}
$output .= '<div id="'.$genopts['template'].'" class="navigation_holder">'."\n";
$output .= '<a href="javascript:;" class="prevNav-'.$sliderID.'" style="color: '.$nav_color.'">'.$default_prev.'</a><div class="item_pager item_pager-'.$sliderID.'"></div><a href="javascript:;" class="nextNav-'.$sliderID.'" style="color: '.$nav_color.'">'.$default_next.'</a>'."\n";
$output .= '</div>'."\n";
