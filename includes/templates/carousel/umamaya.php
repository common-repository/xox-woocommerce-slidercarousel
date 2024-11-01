<?php
//$output .= '<div class="carousel_holder">'."\n";
foreach($loops as $loop){

$output .= '<div class="text-center item">';
$output .= '<article class="product light">';
$output .= '<figure class="figure-hover-overlay">';
$output .= '<a href="'.$loop['url'].'" class="figure-href"></a>';
$output .= '<div class="product-new">new</div>';

	if( !empty($loop['reg_price']) && !empty($loop['sale_price'])){

		$precentage = ( ($loop['reg_price'] - $loop['sale_price']) / $loop['reg_price'] ) * 100;
$output .= '<div class="product-sale">'.substr($precentage, 0,3).'% <br> off</div>';
	}

$output .= '<a href="#" class="product-compare"><i class="fa fa-random"></i></a>';
$output .= '<a href="#" class="product-wishlist"><i class="fa fa-heart-o"></i></a>';
$output .= '<img class="img-responsive xox-img-uma" src="'.$loop['img'].'" alt="" title="">';
$output .= '</figure>';
$output .= '<div class="product-caption">';
$output .= '<div class="block-name">';
$output .= '<a href="'.$loop['url'].'" class="product-name">'.$loop['title'].'</a>';

	if( !empty($loop['reg_price']) && !empty($loop['sale_price'])){
$output .= '<p class="product-price"><span>¥'.number_format($loop['reg_price']).'</span> ¥'.number_format($loop['sale_price']).'</p>';
	}else{
$output .= '<p class="product-price">¥'.number_format($loop['reg_price']).$loop['price'].'</p>';
	}

$output .= '</div>';
$output .= '<div class="product-cart">';
$output .= '<a href="#"><i class="fa fa-shopping-cart"></i> </a>';
$output .= '</div>';
$output .= '<div class="product-rating">';
$output .= '<div class="stars">';
$output .= '<span class="star"></span><span class="star active"></span><span class="star active"></span><span class="star active"></span><span class="star active"></span>';
$output .= '</div>';
$output .= '<a href="#" class="review">8 Reviews</a>';
$output .= '</div>';
$output .= '<p class="description">'.substr($loop['text'], 0, 60).'</p>';
$output .= '</div>';
$output .= '</article>';
$output .= '</div>';

}
