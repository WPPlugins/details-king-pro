<div class="wrap">
    <?php screen_icon(); ?>
    <h2>Details King Pro</h2>
    
    <div class="kpp_block filled">
        <h2><?= __("Connect", 'dkptext') ?></h2>
        <div id="kpp_social">
            <div class="kpp_social facebook"><a href="https://www.facebook.com/KingProPlugins" target="_blank"><i class="icon-facebook"></i> <span class="kpp_width"><span class="kpp_opacity"><?= __("Facebook", 'dkptext') ?></span></span></a></div>
            <div class="kpp_social twitter"><a href="https://twitter.com/KingProPlugins" target="_blank"><i class="icon-twitter"></i> <span class="kpp_width"><span class="kpp_opacity"><?= __("Twitter", 'dkptext') ?></span></span></a></div>
            <div class="kpp_social google"><a href="https://plus.google.com/b/101488033905569308183/101488033905569308183/about" target="_blank"><i class="icon-google-plus"></i> <span class="kpp_width"><span class="kpp_opacity"><?= __("Google+", 'dkptext') ?></span></span></a></div>
        </div>
        <h4><?= __("Found an issue? Post your issue on the", 'dkptext') ?> <a href="http://wordpress.org/support/plugin/details-king-pro" target="_blank"><?= __("support forums", 'dkptext') ?></a>. <?= __("If you would prefer, please email your concern to", 'dkptext') ?> <a href="mailto:plugins@kingpro.me">plugins@kingpro.me</a></h4>   
    </div>
    
    <div class="dkp_tabs">
        <a class="dkp_detail_settings active"><?= __("Detail Settings", 'dkptext') ?></a>
        <a class="dkp_howto"><?= __("How-To", 'dkptext') ?></a>
        <a class="dkp_faq"><?= __("FAQ", 'dkptext') ?></a>
    </div>
    
    <?php if (isset($_GET['settings-updated']) && $_GET['settings-updated'] === 'true') : ?>
    <div class="updated dkp_notice">
        <p><?= __( "Settings have been saved", 'dkptext' ); ?></p>
    </div>
    <?php elseif (isset($_GET['settings-updated']) && $_GET['settings-updated'] === 'false') : ?>
    <div class="error dkp_notice">
        <p><?= __( "Settings have <strong>NOT</strong> been saved. Please try again.", 'dkptext' ); ?></p>
    </div>
    <?php endif; ?>
    
    <div class="dkp_sections">
        <form method="post" action="options.php">
            <?php settings_fields('dkp-options'); ?>
            <?php do_settings_sections('dkp-options'); ?>
            
            <?php /******* DETAIL SETTINGS *******/ ?>
            <div id="dkp_detail_settings" class="dkp_section active">
                <?php submit_button(__('Save Settings', 'dkptext'), 'primary', 'submit', false, array('id'=>'dkp_detail_settings_top_submit')); ?>
                
                <h4>Your Fields</h4>
                <div id='toggle_details'>
                    <div><input id='view_field_key' class='toggle_detail' type='checkbox' value='1' /> View Field Keys</div>
                    <div><input id='view_shortcode' class='toggle_detail' type='checkbox' value='1' /> View Shortcodes</div>
                    <div><input id='view_php_code' class='toggle_detail' type='checkbox' value='1' /> View PHP Codes</div>
                </div>
                <table id="dkp_output_fields" class='form-table' style="width: 100%;">
                    <tr>
                        <th></th>
                        <th class='field_key_display'>Field Key</th>
                        <th class='shortcode_display'>Shortcode</th>
                        <th class='php_code_display'>PHP Code</th>
                        <th></th>
                        <th></th>
                    </tr>
                <?php
                    $fields = get_option('dkp_fields');
                    $values = get_option('dkp_output_fields');
                    foreach ($fields as $field) :
                        $field_data = json_decode($field);
                ?>
                    <tr>
                        <td class='field_name'><?= $field_data->name ?></td>
                        <td class='field_key_display'><?= strtolower(str_replace(' ', '_', $field_data->name)) ?></td>
                        <td class='shortcode_display'>[dkp k="<?= strtolower(str_replace(' ', '_', $field_data->name)) ?>"]</td>
                        <td class='php_code_display'>&lt;?php the_dkp_field("<?= strtolower(str_replace(' ', '_', $field_data->name)) ?>"); ?&gt;</td>
                        <td class='field'>
                    <?php switch ($field_data->type) : 
                        case 'text':
                            echo '<input type="text" name="dkp_output_fields['.strtolower(str_replace(' ', '_', $field_data->name)).']" value="'.$values[strtolower(str_replace(' ', '_', $field_data->name))].'" />';
                            break;

                        case 'textarea':
                            echo '<textarea name="dkp_output_fields['.strtolower(str_replace(' ', '_', $field_data->name)).']">'.$values[strtolower(str_replace(' ', '_', $field_data->name))].'</textarea>';
                            break;

                        case 'wysiwyg':
                            wp_editor($values[strtolower(str_replace(' ', '_', $field_data->name))],'dkp_output_fields['.strtolower(str_replace(' ', '_', $field_data->name)).']');
                            break;

                        case 'file':
                            echo '<input id="dkp_'.strtolower(str_replace(' ', '_', $field_data->name)).'_uploader" type="text" size="36" name="dkp_output_fields['.strtolower(str_replace(' ', '_', $field_data->name)).']" value="'.$values[strtolower(str_replace(' ', '_', $field_data->name))].'" />';
                            echo '<input id="dkp_'.strtolower(str_replace(' ', '_', $field_data->name)).'_uploader_button" class="button" type="button" value="Upload File" />';
                            echo '<script type="text/javascript">
                                var dkp_'.strtolower(str_replace(' ', '_', $field_data->name)).'_uploader;
                                jQuery("#dkp_'.strtolower(str_replace(' ', '_', $field_data->name)).'_uploader_button").click(function(e) {
                                    e.preventDefault();

                                    if (dkp_'.strtolower(str_replace(' ', '_', $field_data->name)).'_uploader) {
                                        dkp_'.strtolower(str_replace(' ', '_', $field_data->name)).'_uploader.open();
                                        return;
                                    }

                                    dkp_'.strtolower(str_replace(' ', '_', $field_data->name)).'_uploader = wp.media.frames.file_frame = wp.media({
                                        title: "Choose File",
                                        button: {
                                            text: "Choose File"
                                        },
                                        multiple: false
                                    });

                                    dkp_'.strtolower(str_replace(' ', '_', $field_data->name)).'_uploader.on("select", function() {
                                        attachment = dkp_'.strtolower(str_replace(' ', '_', $field_data->name)).'_uploader.state().get("selection").first().toJSON();
                                        var url = "";
                                        console.log(attachment);
                                        url = attachment["url"];
                                        jQuery("#dkp_'.strtolower(str_replace(' ', '_', $field_data->name)).'_uploader").val(url);
                                    });

                                    dkp_'.strtolower(str_replace(' ', '_', $field_data->name)).'_uploader.open();
                                });
                            </script>';
                            break;

                        case 'date':
                            echo '<input type="text" class="dkp_datepick" readonly name="dkp_output_fields['.strtolower(str_replace(' ', '_', $field_data->name)).']" value="'.$values[strtolower(str_replace(' ', '_', $field_data->name))].'" />';
                            break;
                    endswitch; ?>
                        </td>
                        <td class='delete_field'><a class="dkp_delete_field" data-field="dkp_<?= strtolower(str_replace(' ', '_', $field_data->name)) ?>">X</a></td>
                    </tr>
                <?php endforeach ?>
                </table>

                <?php submit_button(__('Save Settings', 'dkptext'), 'primary', 'submit', false, array('id'=>'dkp_detail_settings_bottom_submit')); ?>
                
                <hr />
                
                <h4>Add fields that you require</h4>
                <div id="dkp_fields">

                <?php
                    $fields = get_option('dkp_fields');
                    foreach ($fields as $field) :
                        $field_data = json_decode($field);
                ?>

                <input type="hidden" name="dkp_fields[]" value='<?= $field ?>' id='dkp_<?= strtolower(str_replace(' ', '_', $field_data->name)) ?>' />

                <?php endforeach ?>

                </div>

                <div id="dkp_add_field">
                    <label>Add Field</label>
                    <input type="text" id="dkp_field_to_add" />
                    <select id="dkp_field_type">
                        <option>-- SELECT FIELD TYPE --</option>
                        <option value="text">Text</option>
                        <option value="textarea">Textarea</option>
                        <option value="wysiwyg">Wysiwyg</option>
                        <option value="file">File</option>
                        <option value="date">Date</option>
                    </select>
                    <input type="button" class="button button-secondary" id="dkp_save_field" value="Add Field" />
                </div>
            </div>

            <?php /****** HOW-TO ******/ ?>
            <div id="dkp_howto" class="dkp_section">
                <h2><?= __("How To", 'dkptext' ); ?></h2>
                <h3><?= __("Use Shortcodes", 'dkptext' ); ?></h3>
                <p><?= __("Shortcodes can be used in any page or post on your site. By default", 'dkptext' ); ?>:</p>
                <pre>[dkp k='your-field-key']</pre>
                <p><?= __("If you would like to display an error if the key is not found:", 'dkptext' ); ?>:</p>
                <pre>[dkp k='your-field-key' e=true]</pre>
                <p><?= __("To add this into a template, just use the \"do_shortcode\" function", 'dkptext' ); ?>:</p>
                <pre>&lt;?php 
            if (function_exists('dkp_func'))
                echo do_shortcode("[dkp k='your-field-key']");
        ?&gt;</pre>
                <p><?= __("Of course, why do that when you have functions you can use:", 'dkptext' ); ?></p>
                <pre>&lt;?php the_dkp_field($field_key, $error); ?&gt;</pre>
                <p><?= __("This will print the value right there, or if you need to use the variable prior to printing it, use:", 'dkptext' ); ?></p>
                <pre>&lt;?php $value = get_dkp_field($field_key, $error); ?&gt;</pre>
            </div>

            <?php /****** FAQ ******/ ?>
            <div id="dkp_faq" class="dkp_section">
                <h2><?= __("FAQ", 'dkptext' ); ?></h2>
                <h4><?= __("Q. After activating this plugin, my site has broken! Why?", 'dkptext' ); ?></h4>
                <p><?= __("Nine times out of ten it will be due to your own scripts being added above the standard area where all the plugins are included. ", 'dkptext' ); ?>
                    <?= __("If you move your javascript files below the function, \"wp_head()\" in the \"header.php\" file of your theme, it should fix your problem.", 'dkptext' ); ?></p>
                <h4><?= __("Found an issue? Post your issue on the", 'dkptext' ); ?> <a href="http://wordpress.org/support/plugin/details-king-pro" target="_blank"><?= __("support forums", 'dkptext' ); ?></a>. <?= __("If you would prefer, please email your concern to", 'dkptext' ); ?> <a href="mailto:plugins@kingpro.me">plugins@kingpro.me</a></h4>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    jQuery('.dkp_tabs a').click(function() {
        jQuery(this).parent().children('a.active').removeClass('active');
        jQuery('.dkp_sections').find('div.dkp_section.active').removeClass('active');
        
        var active = jQuery(this).attr('class');
        jQuery(this).addClass('active');
        jQuery("#"+active).addClass('active');
    });
</script>