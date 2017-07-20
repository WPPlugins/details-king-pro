=== Details King Pro ===
Contributors: ashdurham
Donate link: http://durham.net.au/donate/
Tags: site details, global values, settings, dynamic, wysiwyg, file upload, date
Requires at least: 3.0.1
Tested up to: 3.7.1
Stable tag: 1.0
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Details King Pro allows you to create global values for your site as you need them

== Description ==

--

Stay up-to-date with the latest by following [@kingproplugins on Twitter](http://twitter.com/kingproplugins), [KingProPlugins on Facebook](http://facebook.com/kingproplugins) or [King Pro Plugins on Google+](https://plus.google.com/b/101488033905569308183/101488033905569308183/about)

--

Built as a continuation of the blog posts on [King Pro Plugins - Building a simple Wordpress Plugin](http://kingpro.me/article/tutorials/wordpress-plugin-basics-site-details-plugin-part-1/)

[Details King Pro](http://kingpro.me/plugins/details-king-pro/) creates an easy way to have global values that can be used site with either via the provided shortcode or 
via the PHP functions. Fields dynamically created by you can have a variety of values such as single textbox plain text value, block textarea plain text value, WYSIWYG content
value, file upload (such as a logo), or a date picker field.

--

If you have any suggestions or would like to see a feature in the plugin, please let me know in the support forum.

Any issues you are having, I'd also love to know, so again, please let me know using the support forum.

--

[Check out the King Pro Plugins range](http://kingpro.me/)


== Installation ==

1. Download and unzip the zip file onto your computer
2. Upload the 'details-king-pro' folder into the `/wp-content/plugins/` directory (alternatively, install the plugin from the plugin directory within the admin)
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Create your first field within the 'Details King Pro' section of the admin
5. Within the WYSIWYG editor, place the short code '[dkp k="your-field-key"]' or within the code, &lt;?php the_dkp_field('your-field-key'); ?&gt;

--

Having Trouble? Get support either on the support forums here or at [@kingproplugins on Twitter](http://twitter.com/kingproplugins), [KingProPlugins on Facebook](http://facebook.com/kingproplugins) or [King Pro Plugins on Google+](https://plus.google.com/b/101488033905569308183/101488033905569308183/about)

--

== Frequently Asked Questions ==

= After activating this plugin, my site has broken! Why? =

Nine times out of ten it will be due to your own scripts being added above the standard area where all the plugins are included. If you move your javascript files below the function, "wp_head()" in the "header.php" file of your theme, it should fix your problem.

--

Have a question thats not listed? Get support either on the support forums here or at [@kingproplugins on Twitter](http://twitter.com/kingproplugins), [KingProPlugins on Facebook](http://facebook.com/kingproplugins) or [King Pro Plugins on Google+](https://plus.google.com/b/101488033905569308183/101488033905569308183/about)

--

== How To Use ==

= Use Shortcodes =
Shortcodes can be used in any page or post on your site. By default:
`[dkp k="your-field-key"]`
If you would like to display an error if the key is not found:
`[dkp k="your-field-key" e=true]`
To add this into a template, just use the "do_shortcode" function:
`&lt;?php if (function_exists('dkp_func')) echo do_shortcode("[dkp k='your-field-key']"); ?&gt;`
Of course, why do that when you have functions you can use:
&lt;?php the_dkp_field($field_key, $error); ?&gt;
This will print the value right there, or if you need to use the variable prior to printing it, use:
&lt;?php $value = get_dkp_field($field_key, $error); ?&gt;

--

Having Trouble? Get support either on the support forums here or at [@kingproplugins on Twitter](http://twitter.com/kingproplugins), [KingProPlugins on Facebook](http://facebook.com/kingproplugins) or [King Pro Plugins on Google+](https://plus.google.com/b/101488033905569308183/101488033905569308183/about)

--

== Screenshots ==

1. Details King Pro types of possible fields
2. How easy it is to create a new field

== Changelog ==

= 1.0 =
* Initial

== Upgrade Notice ==

= 1.0 =
* Gotta start somewhere