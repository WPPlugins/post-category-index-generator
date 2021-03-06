<?php
class cpvg_multiple_values_serialized{

    public function adminProperties() {
		$output_options1 = array(', '=>'Delimited by comma',
								 ' - '=>'Delimited by dash (with spaces)',
								 ' '=>'Delimited by space',
								 'ul'=>'Unordered List',
								 'ol'=>'Ordered List');

		return array('cpvg_multiple_values_serialized' => array('label' => 'Multiple values (Serialized)',
														   'options' => array($output_options1)));
    }

    public function processValue($value='NOT_SET',$output_options='',$additional_data) {
		if($value=='NOT_SET'){
			$values = array(cpvg_random_text_value(),cpvg_random_text_value(),cpvg_random_text_value());
		}else{
			$values = unserialize($value);
		}

		if(is_array($values)){
			//REQUIRED CODE TO DELIVER NON SANATIZED VALUES SAVED BY THE Content Types plugin by iambriansreed (WHEN USED)
			if($additional_data['content_types_plugin_data']){
				foreach($values as $idx => $value){
					$values[$idx] = $additional_data['content_types_plugin_data'][$value];
				}
			}
			switch($output_options[1]){
				case 'ul': return "<ul><li>".implode("</li><li>",$values)."</li></ul>";
				case 'ol': return "<ol><li>".implode("</li><li>",$values)."</li></ol>";
				default: return implode($output_options[1],$values);
			}
		}else{
			return $values; // NOT AN ARRAY
		}
	}
}
?>