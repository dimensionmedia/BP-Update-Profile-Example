<?php


function bpupex_update_lat_lon( $user_id, $posted_field_ids, $errors ) {

	if ( empty( $errors ) ) {
	
		// safely get the address information
		
		$address = sanitize_text_field( $_POST['field_4'] );
		$address2 = sanitize_text_field( $_POST['field_5'] );
		$city = sanitize_text_field( $_POST['field_6'] );
		$state = sanitize_text_field( $_POST['field_7'] );
		$zip = sanitize_text_field( $_POST['field_8'] );
		
		if ( $address && $city && $state && $zip ) {
	
			$full_address = urlencode($address . ' ' . $address2 . ' ' . $city . ', ' . $state . ' ' . $zip);		
			
			$request_url = "http://maps.googleapis.com/maps/api/geocode/xml?address=".$full_address."&sensor=true";
			
			$xml = wp_remote_get( $request_url, array( 'timeout' => 120, 'sslverify' => false ) );
	
			$xml_response = simplexml_load_string($xml['body']);
					
			if ( $xml_response->status->__toString() == "OK" ) {
	
				$lat = $xml_response->result->geometry->location->lat->__toString();
				$lon = $xml_response->result->geometry->location->lng->__toString();
				
				xprofile_set_field_data ('Latitude', $user_id, $lat);
				xprofile_set_field_data ('Longitude', $user_id, $lon);
				
			}
		
		} else {
			
			// clear the fields
			
			xprofile_set_field_data ('Latitude', $user_id, false);
			xprofile_set_field_data ('Longitude', $user_id, false);
			
		}
		
	}
  

}
add_action( 'xprofile_updated_profile', 'bpupex_update_lat_lon', 10, 3 );


?>