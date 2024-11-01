<?php
function cmb2_render_switch( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
	$switch = '<div class="cmb2-switch">';
	$conditional_value =(isset($field->args['attributes']['data-conditional-value'])?'data-conditional-value="' .esc_attr($field->args['attributes']['data-conditional-value']).'"':'');
    $conditional_id =(isset($field->args['attributes']['data-conditional-id'])?' data-conditional-id="'.esc_attr($field->args['attributes']['data-conditional-id']).'"':'');
    $label_on =(isset($field->args['label'])?esc_attr($field->args['label']['on']):'On');
    $label_off =(isset($field->args['label'])?esc_attr($field->args['label']['off']):'Off');
    $switch .= '<input '.$conditional_value.$conditional_id.' type="radio" id="' . $field->args['_id'] . '1" value="yes"  '. ($escaped_value == 'yes' ? 'checked="checked"' : '') . ' name="' . esc_attr($field->args['_name']) . '" />
		<input '.$conditional_value.$conditional_id.' type="radio" id="' . $field->args['_id'] . '2" value="no" '. (($escaped_value == '' || $escaped_value == 'no') ? 'checked="checked"' : '') . ' name="' . esc_attr($field->args['_name']) . '" />
		<label for="' . $field->args['_id'] . '1" class="cmb2-enable '.($escaped_value == 'yes'?'selected':'').'"><span>'.$label_on.'</span></label>
		<label for="' . $field->args['_id'] . '2" class="cmb2-disable '.(($escaped_value == '' || $escaped_value == 'no')?'selected':'').'"><span>'.$label_off.'</span></label>';


	$switch .= '</div>';
	$switch .= $field_type_object->_desc( true );
	echo $switch;
}
add_action( 'cmb2_render_switch', 'cmb2_render_switch', 10, 5 );
