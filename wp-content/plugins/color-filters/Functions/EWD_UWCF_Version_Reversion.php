<?php 
function EWD_UWCF_Version_Reversion() {
	if (get_option("EWD_UWCF_Trial_Happening") != "Yes" or time() < get_option("EWD_UWCF_Trial_Expiry_Time")) {return;}

	$Fields_Array = array('name', 'image', 'price', 'rating', 'add_to_cart', 'colors', 'sizes');

	$wc_attribute_table_name = $wpdb->prefix . "woocommerce_attribute_taxonomies";
    $attribute_taxonomies = $wpdb->get_results( "SELECT * FROM $wc_attribute_table_name order by attribute_name ASC;" );

    foreach ($attribute_taxonomies as $attribute_taxonomy) {
    	update_option("EWD_UWCF_" . $attribute_taxonomy->attribute_name . "_Enabled", "No");

    	$Fields_Array[] = $attribute_taxonomy->attribute_name;
    }

    update_option("EWD_UWCF_Fields_Array", $Fields_Array);
}
add_action('admin_init', 'EWD_UWCF_Version_Reversion');

?>