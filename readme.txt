=== Hitchcock ===
Contributors: Anlino
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=anders%40andersnoren%2ese&lc=US&item_name=Free%20WordPress%20Themes%20from%20Anders%20Noren&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Requires at least: 4.4
Tested up to: 4.8
Stable tag: trunk
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html


== Installation ==

1. Upload the theme
2. Activate the theme

All theme specific options are handled through the WordPress Customizer.


== Social Links ==

To add social links to the sidebar on desktop and menu area on mobile/tablet, follow the instructions below.

1. Go to Administration Panel > Appearance > Menus. 
2. Click on "Create a new menu". Give your menu a name, like "Social menu", and click the "Create Menu" button to the right.
3. Add a "Custom Link" for each social network link you want to display. The theme will select the appropriate icon for the link automatically, based on the URL.
4. Under the "Menu Settings" title, check the checkbox labelled "Social links". This will instruct the theme to display your links in the social menu area. Click the "Save Menu" button.
5. Your social menu should now be visible on the site.


== Gallery Post Format ==

1. Go to Admin > Posts > Add New.
2. Select the "Gallery" post format in the Post Attributes box.
3. Click "Add Media" and upload the images you wish to display in the gallery.
4. Close the Media window and publish/update the post.
5. The images you uploaded should now be displayed in the post gallery.


== Licenses ==

Droid Serif font 
License: SIL Open Font License, 1.1 
Source: https://fonts.google.com/specimen/Droid+Serif

Montserrat font 
License: SIL Open Font License, 1.1 
Source: https://fonts.google.com/specimen/Montserrat

FontAwesome font 
License: SIL Open Font License, 1.1 
Source: http://www.fontawesome.io

DoubleTapToGo.js 
License: MIT License
Source: https://github.com/dachcom-digital/jquery-doubletaptogo

Flexslider.js 
License: GNU GPL v2 
Source: http://www.gnu.org/licenses/gpl-2.0.html

Images used in screenshot.png
License: Creative Commons Zero 
Source: http://www.unsplash.com

Included background image (images/bg.jpg)
License: Creative Commons Zero 
Source: http://www.unsplash.com


== Changelog ==

Version 1.11 (2018-01-31)
-------------------------
- Fixed accent color setting

Version 1.10 (2017-12-07)
-------------------------
- Fixed ordering issue in the Customizer class causing the accent color control to disappear in a puff of smoke

Version 1.09 (2017-12-04)
-------------------------
- Added a Customizer setting for always showing the post preview, and updated the style.css theme description accordingly
- Removed shorthand ternary conditionals, since they're not supported in versions of PHP older than 5.3

Version 1.08 (2017-12-03)
-------------------------
- Updated comments structure in functions.php
- Updated functions to be pluggable
- General code cleanup and readability improvements
- Updated closing element comments
- Restructured the related posts function to be more lean
- Fixed hover effect on related items on single

Version 1.07 (2017-11-23)
-------------------------
- Updated readme.txt to follow new guidelines, and incorporated the old changelog.txt into it
- Fixed a notice in the comments section of the theme
- Added a link to the demo site in the style.css theme description
- Fixed an issue where the theme checker mistook the numerical value supplied to _n() (as a named variable) for a text domain

Version 1.06 (2016-06-18)
-------------------------
- Added the new theme directory tags

Version 1.05 (2016-04-02)
------------------------- 
- Fixed respond input margins

Version 1.04 (2015-12-04)
------------------------- 
- Added Soundcloud to the social icons
- Fixed a floating bug with Jetpack infinite scroll on archive.php and search.php

Version 1.03 (2015-10-05)
------------------------- 
- Renamed en_US.pot to hitchcock.pot

Version 1.02 (2015-10-04)
------------------------- 
- Removed one instance of an incorrect text domain

Version 1.01 (2015-10-04)
------------------------- 
- Updated style.css with missing tags and text domain
- Moved comment-reply enqueueing to functions.php
- Removed title function from header.php (title tag support in functions.php)
- Replaced minified versions of doubletaptogo and flexslider with non-minified versions
- Added a .pot file

Version 1.0 (2015-08-15)
------------------------- 