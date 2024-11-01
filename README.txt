=== X-tra Ordinary WooCommerce Product Carousel and Slider ===
Contributors: dedong
Donate link: http://xolluteon.press/2017/06/04/xox-woocommerce-slidercarousel-support/
Tags: woocommerce, sliders, carousel, products, product, category, premium
Requires at least: 4.0
Tested up to: 4.8
Stable tag: 3.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

XoX Woocommerce Slider/Carousel is useful plugin for displaying sliders consists of Products and Product Category.

== Description ==

**New Updates**

1. Updated default and vertical carousel template. Demo can be viewed here: [http://xolluteon.press/demo/carousels/carousel-default/](http://xolluteon.press/demo/carousels/carousel-default/)
2. Fixed function to support WordPress 4.8

**New Features**

1. New data sources:
	* **Latest Products.**  
	Will automatically collect your newest products added, it adds more speed to create a carousel or slider to promote your latest arrival products.
	* **Best Seller.**  
	  Will automatically built your slider with your most selling items.
	* **Single Products.**  
	  Add a more customized products list for your slider/carousel. This source let you chose products one by one for slider/carousel by typing product name.
2. New Template Format: Our new template format make it easier for you to customize your carousel or slider and make look more awesome.
3. A lot lighter plugin and faster load time *(depend on the image size)*.
4. Shop for a pre designed template from [our store][2] and upload it to your website through plugin page.

*We are providing support to convert your previous modified template to use the new template model for a donation per domain*
[Click here for more information][1]
[1]: http://xolluteon.press/2017/06/04/xox-woocommerce-slidercarousel-support/ "Special offer"
[2]: https://xolluteon.store "Store"

**Require WooCommerce to work properly**

Notes: We are transitioning from a one man developer toward a team. I'm building a team named Xolluteon Indonesia, which will be responsible for this plugin development. I am still (of course) in full charge of this plugin development.

XoX stands for X-tra Ordinary Solution, so the plugin was built to become an out of the box solution for your Web Store that use WooCommerce as it's framework.

XoX Woocommerce Slider/Carousel comes with these features:

*   Fluid and Responsive Design, means that the images and texts inside the slider or carousel will follow the theme responsiveness style.
*   10 Slider effects and 2 Carousel Scrolls.
*   Easy shortcode implementation (integrated with WordPress editor).
*   Additional Widget to add shortcode to dynamic widget.
*   Conflict free, the sliders or carousels created with the plugin are unique and can be implemented inside posts or pages without conflicting each other (note: except for implementing one slider/carousel multiple times in one page. EG: 1 slider used both inside the page and sidebar).
*   5 Starter slider and carousel template + the ability to create your own customized template.

Slider effects:
	
*   Normal/No Effect, changing images without any transition effect
*	Fade In
*	Fade Out
*	Scroll Horizontal
*	Scroll Vertical
*	Flip Horizontal
*	Flip Vertical
*	Shuffle
*	Tile Side
*	Tile Blind

Carousel Scrolls:

*   Normal: Horizontal Scrolling (From right to left).
*   Vertical: Scrolling up.
*   Vertical Down: Scrolling downward (under development)

== Installation ==

how to install the plugin and get it working.

1. Automatic way
	* From your plugin page on your wp-admin, select add new.
	* Type in "search" *Xox WooCommerce Carousel and Slider*
	* Click **Install**
2. Manual way
	* Extract the .zip file downloaded from wordpress.org
	* Upload the extracted `xox-woo-carousel` folder to your `/wp-content/plugins/` directory
	* Activate the plugin through the 'Plugins' menu in WordPress
3. You will find "XoX Slider & Carousel" in your wp-admin sidebar
4. Start creating your Slider or Carousel
5. Use it anywhere in your post, pages, or custom posts using the shortcode button in editor toolbar. Or,
6. Activate the "XoX WooCommerce Widget" through wp-admin->appearance->widgets, OR
7. Use anywhere in your .php template by using 
	* `<?php echo do_shortcode('[xoxslider name="slider-or-carousel-name"]'); ?>`

== Frequently Asked Questions ==

= How to create a custom theme for my slider or carousel =

Currently this is the steps:

1. On the plugin folder ("/wp-content/plugins/xox-woo-carousel") go to "../include/templates/[slider or carousel]",
2. Copy one of the template folder (EG: default) rename it to anything you like but using "-" as space replacer (EG: my-theme.php),
3. You will find 5 files: *layout.html, loop.html, nav.html, pagination.html, and style.css*
4. Upload the "my-theme" folder in to "/wp-content/plugins/xox-woo-carousel/include/templates/[slider or carousel]",
5. Open the slider/carousel you want to use this newly made theme,
6. On the "Slider/Carousel Theme" you will find your newly made theme listed in the radio button ("EG: My Theme"). Select the theme and save your Slider/Carousel.
7. To edit the theme:
	* On the sidebar "XoX Slider & Carousel" menu, find "Edit Theme"
	* Chose Carousel or Slider on the first select box and click "Select" button.
	* Now, chose your theme (in this example: "my-theme"), and click "Select button.
	* Now go and edit the files as how you need.

= Basic Usage =

1. Create new slider or carousel by going to "XoX Slider & Carousel -> Add New Slider/Carousel"
2. Set the parameters for the slider or carousel
3. Go to your post/page where you want this slider to be shown, add it using the shortcode button found in the editor toolbar.
4. Alternatively you can go to "Appearence -> Widgets" and add "XoX WooCommerce Widget" to your widget box, or
5. Use anywhere in your .php template by adding this code: `<?php echo do_shortcode('[xoxslider name="slider-or-carousel-name"]'); ?>`

== Screenshots ==

1. Add new slider through wp-admin sidebar
2. Inside the slider/carousel page
3. Add shortcode using Editor toolbox
4. Chose the slider/carousel to be used in the shortcode
5. Add the slider/carousel from widget
6. Custom widget for adding slider/carousel to dynamic WordPress widget
7. All slider and carousel put in a page without problem

== Changelog ==
= 3.0 =
* Added new options for slider/carousel data source.
* Revert engine back to use cycle2 jquery.
* Major updates on Meta Boxes.
* Store implementation.

= 2.3 =
* Fixed conflict new slider plugin swiper http://idangero.us/swiper.
* Used cloud image storage.

= 2.1 =
* Major updates in UI/UX.
* Added new slider plugin swiper http://idangero.us/swiper.
* A lot of new features that requested is available or still in development status.

= 1.7 =
* Restructured the query to works with WordPress ver 4.2 +.
* Added Theme editor.

= 1.0 =
* Added 5 slider effects.
* Added 2 Additional Slider themes and 1 Carousel Theme

= 0.5 =
* Basic functionality made.
* Default Framework

== Upgrade Notice ==

= 1.0 =
Published version for market, compatibility with (Chrome, Firefox, Opera, Safari).

= 0.5 =
Beta Release.

== Features list: ==

1. Fluid and Responsive Design, means that the images and texts inside the slider or carousel will follow the theme responsiveness style. 
2. 10 Slider effects and 2 Carousel Scrolls.
3. Easy shortcode implementation (integrated with WordPress editor).
4. Additional Widget to add shortcode to dynamic widget.
5. Conflict free, the sliders or carousels created with the plugin are unique and can be implemented inside posts or pages without conflicting each other (note: except for implementing one slider/carousel multiple times in one page. EG: 1 slider used both inside the page and sidebar).
6. 5 Starter slider and carousel template + the ability to create your own customized template.
7. Various data sources, ease you to roll on with the Slider/Carousel.
8. Editable Template Format: Our new template format make it easier for you to customize your carousel or slider and make look more awesome.
9. Light plugin and faster load time *(depend on the image size)*.
10. Shop for a pre designed template from [our store][2] and upload it to your website through plugin page.


== Additional Features: ==

* Changeable Navigation Images
* Ability to use "numeric" or "bullet" pagination
* Commitment of support and help.

== Arbitrary section ==