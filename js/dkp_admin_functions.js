jQuery(document).ready(function($) {
    
    $(".toggle_detail").click(function() {
        var detail = $(this).attr('id').replace('view_', '');
        if ($(this).is(':checked')) {
            // Toggle on
            $("."+detail+"_display").fadeIn();
        } else {
            // Toggle off
            $("."+detail+"_display").fadeOut();
        }
    });
    
    $(".dkp_datepick").datepicker({ dateFormat: "dd/mm/yy" });
    
    $("#dkp_save_field").click(function() {
        var name = $("#dkp_field_to_add").val();
        $("#dkp_field_to_add").val('');
        var type = $("#dkp_field_type").val();
        $("#dkp_field_type").val('');
        
        var json = JSON.stringify({'name':name, 'type':type});
        
        $("#dkp_fields").append("<input type='hidden' name='dkp_fields[]' value='"+json+"' id='dkp_"+name.toLowerCase().replace(' ', '_')+"' />");
        
        if (type == 'text') {
            $("#dkp_output_fields").append("<tr><td class='field_name'>"+name+"</td><td class='field_key_display'>"+name.toLowerCase().replace(' ', '_')+"</td><td class='shortcode_display'>[dkp k='"+name.toLowerCase().replace(' ', '_')+"']</td><td class='php_code_display'>&lt;?php the_dkp_field('"+name.toLowerCase().replace(' ', '_')+"'); ?&gt;</td><td class='field'><input type='text' name='dkp_output_fields["+name.toLowerCase().replace(' ', '_')+"]' value='' /></td><td class='delete_field'><a class='dkp_delete_field' data-field='dkp_"+name.toLowerCase().replace(' ', '_')+"'>X</a></td></tr>");
        } else if (type == 'textarea') {
            $("#dkp_output_fields").append("<tr><td class='field_name'>"+name+"</td><td class='field_key_display'>"+name.toLowerCase().replace(' ', '_')+"</td><td class='shortcode_display'>[dkp k='"+name.toLowerCase().replace(' ', '_')+"']</td><td class='php_code_display'>&lt;?php the_dkp_field('"+name.toLowerCase().replace(' ', '_')+"'); ?&gt;</td><td class='field'><textarea name='dkp_output_fields["+name.toLowerCase().replace(' ', '_')+"]'></textarea></td><td class='delete_field'><a class='dkp_delete_field' data-field='dkp_"+name.toLowerCase().replace(' ', '_')+"'>X</a></td></tr>");
        } else if (type == 'wysiwyg') {
            $("#dkp_output_fields").append("<tr><td class='field_name'>"+name+"</td><td class='field_key_display'>"+name.toLowerCase().replace(' ', '_')+"</td><td class='shortcode_display'>[dkp k='"+name.toLowerCase().replace(' ', '_')+"']</td><td class='php_code_display'>&lt;?php the_dkp_field('"+name.toLowerCase().replace(' ', '_')+"'); ?&gt;</td><td class='field'><span>Save Settings to render the WYSIWYG Editor</span></td><td class='delete_field'><a class='dkp_delete_field' data-field='dkp_"+name.toLowerCase().replace(' ', '_')+"'>X</a></td></tr>");
        } else if (type == 'file') {
            var file_output = "<tr><td class='field_name'>"+name+"</td><td class='field_key_display'>"+name.toLowerCase().replace(' ', '_')+"</td><td class='shortcode_display'>[dkp k='"+name.toLowerCase().replace(' ', '_')+"']</td><td class='php_code_display'>&lt;?php the_dkp_field('"+name.toLowerCase().replace(' ', '_')+"'); ?&gt;</td><td class='field'><input id='dkp_"+name.toLowerCase().replace(' ', '_')+"_uploader' type='text' size='36' name='dkp_output_fields["+name.toLowerCase().replace(' ', '_')+"]' value='' />";
            file_output += "<input id='dkp_"+name.toLowerCase().replace(' ', '_')+"_uploader_button' class='button' type='button' value='Upload File' />";
            file_output += "<script type='text/javascript'>\n\
                        var dkp_"+name.toLowerCase().replace(' ', '_')+"_uploader;\n\
                        jQuery('#dkp_"+name.toLowerCase().replace(' ', '_')+"_uploader_button').click(function(e) {\n\
                            e.preventDefault();\n\
                            if (dkp_"+name.toLowerCase().replace(' ', '_')+"_uploader) {\n\
                                dkp_"+name.toLowerCase().replace(' ', '_')+"_uploader.open();\n\
                                return;\n\
                            }\n\
                            dkp_"+name.toLowerCase().replace(' ', '_')+"_uploader = wp.media.frames.file_frame = wp.media({\n\
                                title: 'Choose File',\n\
                                button: {\n\
                                    text: 'Choose File'\n\
                                },\n\
                                multiple: false\n\
                            });\n\
                            dkp_"+name.toLowerCase().replace(' ', '_')+"_uploader.on('select', function() {\n\
                                attachment = dkp_"+name.toLowerCase().replace(' ', '_')+"_uploader.state().get('selection').first().toJSON();\n\
                                var url = '';\n\
                                console.log(attachment);\n\
                                url = attachment['url'];\n\
                                jQuery('#dkp_"+name.toLowerCase().replace(' ', '_')+"_uploader').val(url);\n\
                            });\n\
                            dkp_"+name.toLowerCase().replace(' ', '_')+"_uploader.open();\n\
                        });\n\
                    </script>";
            file_output += "</td><td class='delete_field'><a class='dkp_delete_field' data-field='dkp_"+name.toLowerCase().replace(' ', '_')+"'>X</a></td></tr>";
            $("#dkp_output_fields").append(file_output);
        } else if (type == 'date') {
            var date = "<tr><td class='field_name'>"+name+"</td><td class='field_key_display'>"+name.toLowerCase().replace(' ', '_')+"</td><td class='shortcode_display'>[dkp k='"+name.toLowerCase().replace(' ', '_')+"']</td><td class='php_code_display'>&lt;?php the_dkp_field('"+name.toLowerCase().replace(' ', '_')+"'); ?&gt;</td><td class='field'><input type='text' class='dkp_datepick' readonly name='dkp_output_fields["+name.toLowerCase().replace(' ', '_')+"]' value='' /></td><td class='delete_field'><a class='dkp_delete_field' data-field='dkp_"+name.toLowerCase().replace(' ', '_')+"'>X</a>";
            date += "<script type='text/javascript'>\n\
                    jQuery('.dkp_datepick').datepicker('destroy');\n\
                    jQuery('.dkp_datepick').datepicker({ dateFormat: 'dd/mm/yy' });\n\
                </script></td></tr>";
            $("#dkp_output_fields").append(date);
        }
    });
    
    $("body").on("click", ".dkp_delete_field", function() {
        if (confirm('Are you sure you want to delete this field? This is not reversible.')) {
            var field = $(this).data('field');
            $(this).parents('tr').remove();
            $("#"+field).remove();
        }
    });
});