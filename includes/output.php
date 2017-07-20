<?php
    function the_dkp_field($field, $error = false) {
        echo get_dkp_field($field, $error);
    }
    
    function get_dkp_field($field, $error = false) {
        $dkp_fields = get_option('dkp_output_fields');
        if (isset($dkp_fields[$field])) {
            return $dkp_fields[$field];
        } elseif ($error) {
            return $field." does not exist";
        }
    }

    // [dkp k="{FIELD_KEY}" e="FALSE"]
    function dkp_func( $atts ) {
            extract( shortcode_atts( array(
                    'k' => '',
                    'e' => false
            ), $atts ) );
            if (!empty($k))
                the_dkp_field($k, $e);
    }
    add_shortcode( 'dkp', 'dkp_func' );
?>