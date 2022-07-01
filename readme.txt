=== Hitchcock ===
Contributors: Anlino
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=anders%40andersnoren%2ese&lc=US&item_name=Free%20WordPress%20Themes%20from%20Anders%20Noren&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Requires at least: 4.5
Tested up to: 6.0
Requires PHP: 5.4
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

FontAwesome Code
License: MIT License, https://opensource.org/licenses/MIT
Source: https://www.fontawesome.io

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

Version 2.2.1 (2022-07-01)
-------------------------
- Improved fonts.css enqueue for child themes.

Version 2.2 (2022-06-29)
-------------------------
- Switched from the Google Fonts CDN to font files included in the theme folder.
- Removed the "Disable Google Fonts" Customizer setting, since it's no longer needed.
- Bumped "Tested up to" to 6.0.

Version 2.1 (2022-04-13)
-------------------------
- Feature: Added two widget areas to the footer, with styles.
- Feature: Added a Customizer option for disabling Google Fonts.
- Fixed layout of nested alignwide/alignfull blocks.
- Remove the top/bottom margin of first/last elements in certain block containers.
- Moved the Customizer accent color setting to the `colors` Customizer panel.
- Fixed order of CSS sections.
- Added "Tested up to" and "Requires PHP" to style.css and readme.txt.
- Updated URLs to andersnoren.se to omit the www part.

Version 2.0.2 (2020-05-10)
-------------------------
- Fixed the name attribute in `searchform.php` resulting in broken search strings.

Version 2.0.1 (2020-05-09)
-------------------------
- Fixed style issues with gallery format and the Jetpack Infinite Scroll loader.

Version 2.0.0 (2020-05-08)
-------------------------
- Increased "Tested up to" to 5.4.1.
- Increased "Requires at least" to 4.5, since Hitchcock uses `custom_logo`.
- Added the new `assets` folder, and moved images, styles and JavaScript to it.
- Renamed the editor stylesheets.
- Changed the screenshot to the `jpg` format, reducing file size by more than 600 KB.
- Removed license.txt.
- Added unique IDs to the search form and search field.
- CSS: Cleanup (indentation, comment headings, etc).
- CSS: Adjusted reset.
- CSS: Added the new Element Base section, and made base styles more global, less specific.
- CSS: Increased contrast of the light gray color, removed the medium gray color.
- Moved the `Hitchcock_Customize` class to `/inc/classes/class-hitchcock-customize.php`.
- Moved the archive pagination from a function to `pagination.php`.
- Cleaned up ´index.php´, and moved modifications of the archive title to a `functions.php` filter where it belongs.
- Removed a obsolete thumbnail admin CSS fix.
- Removed removal of outline.
- Only output Custom CSS as inline style if the accent color set differs from the default.
- Restructured the custom CSS function, and added output of its CSS with `wp_add_inline_style()` instead of a `wp_head` action.
- Added theme version to enqueues.
- Fixed block editor buttons missing the Hitchcock button styles.
- Updated clearing to use pseudos instead of a `.clear` element.
- Removed title attributes from links.
- Restructured site title output for better semantics.
- CSS: Moved the block styles to their own section of the document.
- Changed the "Regular" block editor font size to "Normal", to match the block editor naming convention.
- Updated block editor styles.
- Removed Customizer live JavaScript preview.

Version 1.25 (2020-03-30)
-------------------------
- Social menu: Fixed targeting issue causing mail and feed links not getting the right icon.
- Set font smoothing to antialiased.

Version 1.24 (2020-03-30)
-------------------------
- Fixed issue with gallery block alignment after changes to the block markup in Core.
- Updated the block editor styles for links to prevent them hitting elements outside of theme scope.
- Limited the FontAwesome files to only include woff and woff2 files, reducing the theme file size by a large amount.
- Updated the archive post previews to be square on mobile, so they always have the same aspect ratio.
- Social menu: Added Xing, Snapchat.

Version 1.23 (2019-07-20)
-------------------------
- Added theme URI to style.css
- Updated "Tested up to"
- Added theme tags
- Added skip link
- Don't show comments if the post is password protected
- Don't show the post thumbnail if the post is password protected
- Fixed font issues in the block editor styles
- Updated FontAwesome to the latest version, and added a lot more icons
- Added licensing information for FontAwesome code
- Better social menu styling
- Updated screenshot resolution to 1200x900

Version 1.22 (2019-06-20)
-------------------------
- Fixed sub menus being overlapped by the menu link when on two lines
- Updated Pinterest icon url to be domain independent
- Added Twitch icon

Version 1.21 (2019-04-07)
-------------------------
- Added the new wp_body_open() function, along with a function_exists check

Version 1.20 (2019-01-11)
-------------------------
- Fixed fix for margin-top of first item in block: gallery

Version 1.19 (2018-12-19)
-------------------------
- Combined index.php, archive.php and search.php into index.php
- Combined single.php and page.php into singular.php
- Made "Edit post" translateable
- Fixed misplaced closing .content tag on singular.php
- Changed the search form button to a button element
- Changed the navigation toggle on mobile to a button element
- Fixed header search in IE11

Version 1.18 (2018-12-10)
-------------------------
- Removed an extra closing <h4> tag in archive.php

Version 1.17 (2018-12-07)
-------------------------
- Fixed Gutenberg style changes required due to changes in the block editor CSS and classes
- Fixed the Classic Block TinyMCE buttons being set to the wrong font

Version 1.16 (2018-11-30)
-------------------------
- Fixed Gutenberg editor styles font being overwritten

Version 1.15 (2018-10-28)
-------------------------
- Fixed blog description font

Version 1.14 (2018-10-28)
-------------------------
- Updated with Gutenberg support
	- Gutenberg editor styles
	- Styling of Gutenberg blocks
	- Custom Hitchcock Gutenberg palette
	- Custom Hitchcock Gutenberg typography styles
- Added option to disable Google Fonts with a translateable string
- Updated theme description
- Improved compatibility with < PHP 5.5
- Removed the languages sub folder, since that is handled by WordPress.org
- Removed old vendor prefixed CSS
- Updated the Google Fonts enqueue to make use of new weights added to Montserrat since Hitchcock was created
- Updated the styling to make use of the new weights
- Disabled webkit font smoothing to improve readability

Version 1.13 (2018-05-24)
-------------------------
- Fixed output of cookie checkbox in comments

Version 1.12 (2018-03-25)
-------------------------
- Added logo support back in, together with a retina logo setting
- Added current menu item styling

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