=== Plugin Name ===
Name: CM Tooltip Glossary Pro
Contributors: CreativeMindsSolutions
Donate link: https://www.cminds.com/
Tags: glossary, pages, posts, definitions, tooltip, automatic, hints, hint, tip, tool-tip
Requires at least: 3.3
Tested up to: 6.0.2
Stable tag: 4.0.12

PRO Version! Parses posts for defined glossary terms and adds links to the static glossary page containing the definition and a tooltip with the definition.

== Description ==

Parses posts for defined glossary terms and adds links to the static glossary page containing the definition.  The plugin also creates a tooltip containing the definition which is displayed when users mouseover the term.  Based on [automatic-glossary](http://wordpress.org/extend/plugins/automatic-glossary/) and on [TooltipGlossary] (http://wordpress.org/extend/plugins/tooltipglossary/).

The code has been bug fixed based on TooltipGlossary and many new features added. A new tag was introduced to avoid using the Tooltip [glossary_exclude] text [/glossary_exclude].

The tooltip is created with JavaScript based on the article written by [Michael Leigeber](http://www.leigeber.com/author/michael/) [here](http://sixrevisions.com/tutorials/javascript_tutorial/create_lightweight_javascript_tooltip/) and can be customized and styled through the tooltip.css and tooltip.js files.

Alphabetical index for glossary list is based on [jQuery ListNav Plugin](http://www.ihwy.com/labs/jquery-listnav-plugin.aspx)

**More About this Plug**

You can find more information about CM Tooltip Glossary Pro at [CreativeMinds Website](https://www.cminds.com/).


**More Plugins by CreativeMinds**

* [CM Ad Changer]( http://wordpress.org/extend/plugins/cm-ad-changer/ ) - Helps you manage, track and provide reports of how your advertising campaigns are being run and turns your WordPress site into an ad server.
* [CM Download Manager]( http://wordpress.org/extend/plugins/cm-download-manager ) - Allows users to upload, manage, track and support documents or files in a download directory listing database for others to contribute, use and comment upon.
* [CM Answers]( http://wordpress.org/extend/plugins/cm-answers/ ) - Allows users to post questions and answers (Q&A) in a Stack-overflow style community forum which is easy to use, customize and install. Comes with Social integration Shortcodes.

== Installation ==

1. Upload the plugin folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Define your glossary terms under the glossary menu item in the administration interface.  The title of the page should be the term.  The body content should be the definition.
4. Create a main glossary page (example "Glossary") with no body content if you wish to.  If you do not create this page then your terms will still be highlighted but there will not be a central listing of all your terms.
5. In the plugin's dashboard preferences, enter the main glossary page's id (optional as above)
6. There are a handful of other optional preferences available in the dashboard.

Note: You must have a call to wp_head() in your template in order for the tooltip js and css to work properly.  If your theme does not support this you will need to link to these files manually in your theme (not recommended).

== Frequently Asked Questions ==

= Does my main glossary page need to be titled "Glossary"? =

No.  It can be called anything.  In fact you don't even need to have a main glossary page.

= Do I need to manually type in an unordered list of my glossary terms on the glossary page? =

No.  Just leave that page blank.  The plugin creates the unordered list of terms automatically.

= How do I add glossary terms? =

Simply add a term under the 'Glossary' section in the adminstration interface.  Title it the glossary term (ex. "WordPress") and put the term's definition into the body (ex. "A neato Blogging Platform").

= What if I need to add or change a glossary term? =

Just add it or change it.  The links for your glossary terms are added to your page and post content on the fly so your glossary links will always be up to date.

= How do I prevent the glossary from parsing a paragraph =

Just wrap the paragraph with [glossary_exclude] paragraph text [/glossary_exclude].

= How do I define the Glossary link style =

You can use glossaryLink. You can also define glossaryLinkMain if you wish to have a different style in the main glossary page

== Screenshots ==

1. List of terms in Glossary
2. Tooltip for one term inside glossary page
3. Tooltip for one term inside a post
4. Glossary terms page in Admin panel
5. Glossary setting page in Admin

== Changelog ==

= 4.0.12 =
* Bug: Added missing widgets
* Improvement: New shortcode: [cmtt_synonyms] allowing to show synonyms anywhere on the term page.
* Bug: Fixed the bug with sharing icons
* Bug: Fixed the bug with backlinks affecting the Recent Posts Widget

= 4.0.11 =
* Improvement: Added option to enable/disable the All results count on the Glossary Index

= 4.0.10 =
* Bug: Fixes the term highlighting bug introduced in 4.0.9
* Improvement: Added support for adding forced categories with Community Terms addon [added in 1.3.0]
* Improvement: Tooltip font size setting now also applies to mobile link.

= 4.0.9 =
* Improvement: Added support for adding "private" terms with Community Terms addon [added in 1.2.23]
* Bug: Fixed small bugs

= 4.0.8 =
* Feature: Added option to highlight only every nth occurrence of the term
* Bug: Fixed bugs with server-side pagination
* Bug: Fixed some small bugs 
* Improvement: Improved the detection and reporting of the duplicate synonyms
* Optimization: Small code optimizations

= 4.0.7 =
* Bug: Fixed the problem with the link hover color not working
* Bug: Fixed some small bugs 
* Bug: Fixed bug with server-side pagination

= 4.0.6 =
* Improvement: Added option allowing to enable/disable the Oxygen Builder parsing
* Bug: Fixed some small bugs 

= 4.0.5 =
* Feature: Added options to hide part of the footnote definitions
* Improvement: Improved code responsible for excluding the parsing of scripts
* Feature: Added option to whitelist/blacklist the tooltip terms on category level

= 4.0.4 =
* Bug: Fixed the bug with footnotes linking to terms page when it should be disabled
* Bug: Restored the missing tooltip styling settings (position and animations)
* Bug: Fixed a bug which caused Elementor pages to appear broken when tooltips were not in footer
* Feature: Added support for gttranslate.io service
* Feature/optimization: Added the option "Run QuickScan before parsing?"
* Bug: Fixed bug with related articles causing duplicate entries
* Bug: Fixed the rare bug with the alphabetical list on the glossary term pages
* Bug: Fixed the bug with plugin not working correctly on latest version of Oxygen builder

= 4.0.3 =
* Major change: Major improvement to the styles of Settings, added foldable sections and search
* Added support for tooltips in FullScreen mode
* Added option: Clicking on tooltip redirects to term?
* Added metabox option: Overwrite the "Display terms as a footnotes" setting on this page.
* Added debug option: (Debug) Move tooltips in DOM tree dynamically?
* Settings change: moved the "Is clickable" option from Tooltip - Styling to Tooltip - Content section
* Fixed some JS errors

= 4.0.2 =
* Bug: Fixed the bug with the flushing of the rewrite rules
* Bug: Re-added some missing settings from before 4.0.0
* Feature: Two new options for the Footnotes display
* Bug: Fixed few small bugs

= 4.0.1 =
* Critical Bug: Fixed the bug appearing when SharingBox was enabled

= 4.0.0 =
* Feature: added option 'Display tooltips as a footnotes' and main footnotes links style options
* Feature: added full footnotes functionality - direct links, backlinks to called link, adopted for synonyms and variations
* Feature: added option 'Simplify term permalink'
* Feature: added ability to show the tooltip by users roles
* Feature: Added Languages export/import
* Feature: added option 'Force load scripts'
* Feature: added option 'Add support for audio files in tooltips'
* Feature: added option 'Highlight terms in BuddyBoss activity content'
* Fixed scroll JS bug at Divi theme
* Fixed footnotes for early synonyms logic
* Fixed Footnote font size option added
* Fixed case sensitive notation logic
* Fixed multiple synonyms adding
* Fixed small bugs
* Accessibility improvements
* License package update

= 3.9.14 =
* Feature: Added options "Exclude hyphenated words" and "Exclude words in double quotes"
* Bug: Fixed small bugs

= 3.9.13 =
* Feature: Added option to change tooltip z-index
* Bug: Fixed small bugs
* Added missing option

= 3.9.12 =
* Bug: Fixed JS error
* Bug: Fixed the problem with not showing term definition if it's created using Themify Builder

= 3.9.11 =
* Fixed small bugs

= 3.9.10 =
* Bug: Fixed the problem with including HTML tags in the content attribute of the [glossary_tooltip] shortcode
* Bug: Fixed the problem with displaying additional information multiple times on Avada builder generated pages
* Minor fixes

= 3.9.9 =
* Bug: Fixed an issue with [glossary_exclude] shortcode

= 3.9.8 =
* Feature: Added option to convert content to initial encoding
* Feature: Added option to highlight term in archive descriptions
* Feature: Added ability to enable/disable search for glossary items on post/page
* Bug: Fixed an issue in pagination styling
* Bug: Fixed the bug in javascript file

= 3.9.7 =
* Feature: Added option to add structured data to the Term page
* Feature: Added option to close tooltip only on close button click
* Feature: Added option to enable tooltips on specific page
* Updated the Licensing Package

= 3.9.6 =
* Bug: Fixed a bug on the term page

= 3.9.5 =
* Bug/Feature: Fixed conflict with WordPress SEO - ACF Content Analysis
* Feature: Added support for AMP and AMP for WP plugins
* Feature: Added new shortcode [cmtgend]
* Bug: Fixed the bug in Tooltip Preview

= 3.9.4 =
* Feature: Added option to wrap with <span> for ACF Fields
* Feature: Added option to show tooltip close icon only on mobile devices
* Feature: Added option to disable tooltips on desktops
* Bug: Fixed the bug in "Backup Glossary Terms to File" functionality

= 3.9.3 =
* Bug: Fixed the bug in javascript file

= 3.9.2 =
* Bug: Fixed the bug with the accented letters not being displayed for the base letter in Glossary Index
* Bug: Fixed the bug with backlinks appearing more then once
* Bug: Fixed the bug in option description
* Bug: Fixed the bug in "Stretch the alphabetical index to 100%" option
* Bug: Fixed the bug in import/export functionality

= 3.9.1 =
* Bug: Fixed the bug with some of the Glossary Index terms being missing
* Feature: Added the option to import/export the single meta values

= 3.9.0 =
* Feature: Added option to stretch the alphabetical index to 100%
* Feature: Added the option allowing to display only the first X terms beginning with each letter
* Bug: Fixed the bug with tooltips not opening on the first click
* Bug: Fixed a rare JS bug
* Bug: Fixed a bug with synonyms/Wikipiedia content appearing incorrectly
* Bug: Fixed a bug with the related terms not using the custom urls

= 3.8.19 =
* Feature: Added the option to select the delimeter for the Glossary Term Synonyms/Variations
* Bug: Fixed the bug in the [glossary_tooltip] shortcode

= 3.8.18 =
* Improvement: Improved the support for tooltips in AJAX loaded content
* Feature: Added the support for the "term_id" parameter for the [glossary_tooltip] shortcode
* Feature: Added the option allowing to change the parsing function priority (can solve some conflict with other themes/plugins)
* Feature: Added the option to auto-add parsed pages to the Related Articles Index

= 3.8.17 =
* Feature: Added the support for Woocommerce Attribute labels
* Bug: Fixed small bugs

= 3.8.16 =
* Fixed small bugs

= 3.8.15 =
* Feature: Added the option to disable the DOM parser

= 3.8.14 =
* Feature: Added the option to the display the tooltips in the WP Image captions
* Feature: Added the option to change tooltip title's font size
* Feature: Added link attribute to the [glossary_tooltip] shortcode
* Feature: Added the option to export and import plugin settings
* Bug/change: Fixed the issue with the Customizer

= 3.8.13 =
* Bug/change: Fixed the CSS for the Modern Table view
* Feature: Added the option to overwrite the general setting for opening the glossary links on new tabs
* Updated the Licensing Package

= 3.8.12 =
* Added the support for Gutenberg for Glossary Term pages

= 3.8.11 =
* Updated the Licensing Package
* Change: Redesigned the Glossary Index Settings Page

= 3.8.10 =
* Small performance optimizations
* Added missing label for custom templates

= 3.8.9 =
* Feature: Fixed support for AntiSpambot
* Bug: Fixed the issue with audio/video players playing after tooltip being closed

= 3.8.8 =
* Bug: Security update

= 3.8.7 =
* Bug: Fixed the compatibility issue with jQuery > 3.0.0

= 3.8.6 =
* Bug: Added the option to change the behavior of the "Highlight only the first occurrence" for variants/synonyms

= 3.8.5 =
* Bug: Fixed small issues

= 3.8.4 =
* Bug: Fixed the issue with the hashes during AJAX parsing
* Bug: Fixed the Taxonomy Backlink not being displayed on the backend correctly
* Bug: Fixed the 404 errors in the CSS references
* Feature: Added the option to exclude the page/post from the Related Articles (through CM Tooltip Disables metabox)
* Feature/Change: Instead of disabling the related terms on post/page the checkbox now overrides the general settings (so it's easy now to only display them on few selected pages)
* Feature/Change: The option allowing to add "title" attribute link now works also on the Glossary Index page

= 3.8.3 =
* Updated the Licensing Package

= 3.8.2 =
* Bug: Fixed the shortcode attached to the parsing button

= 3.8.1 =
* Bug: Fixed the bug in Enfold compatibility

= 3.8.0 =
* Bug: Fixed the additional linebreaks being added on export
* Update: Updated the Enfold compatibility (requires Enfold 4.4.1+)

= 3.7.10 =
* Bug: Fixed small bug

= 3.7.9 =
* Bug: Fixed the bug which caused the tooltips to be stuck open

= 3.7.8 =
* Bug: Fixed the bug which caused the plugin to stop parsing the terms

= 3.7.7 =
* Feature: Added the option to allow sorting of Glossary Index terms by the title
* Feature: Added the minification for the scripts and styles (disabled for Administrators)
* Feature: Added the support for the wpDatatables plugin

= 3.7.6 =
* Bug: Fixed the bug with the missing function
* Feature: Added the option to add custom code before and after the Glossary Term Page content
* Feature: Added the option to add custom code before and after the Glossary Tooltip content

= 3.7.5 =
* Bug: Fixed the warning about missing class
* Bug: Added the missing functionality

= 3.7.4 =
* Bug/Feature: Added the missing $additionalClass to links if tooltips are disabled

= 3.7.3 =
* Bug/Change: Disabled the option "Move tooltip contents to footer?" by default - to stop the rare problems with the tooltips displaying random strings

= 3.7.2 =
* Bug: Fixed the small compatibility issue with PHP >7.2
* Bug: Fixed the small compatibility with servers with "set_time_limit" disabled

= 3.7.1 =
* Bug: Fixed the small compatibility issue with PHP <5.5
* Feature: Removed the underline of the dashicons in the [glossary_tooltip] shortcode unless it's forced with the new underline="1" parameter
* Bug: Changed the default setting to move to scripts to footer to fix the problems with the tooltips displaying random strings

= 3.7.0 =
* Added the option to disable the comments per glossary page
* Added the option to move the tooltip content to the footer (improved the compatibility with the builders)
* Updated the licensing package

= 3.6.1 =
* Added the support for "author_id" attribute for the [glossary] shortcode allowing to display terms from single author
* Added the debug code for Related Articles Indexing
* Fixed the problem with the linebreaks after list items
* Updated the licensing package

= 3.6.0 =
* Added the support for importing featured images
* Fixed the error reporting during imports

= 3.5.14 =
* Added the support for the parsing in the Goodlayers theme builder

= 3.5.13 =
* Now showing the term link automatically on the bottom when displaying tooltip on click

= 3.5.12 =
* Fixed the Custom Link in the ReadMore link in the tooltip

= 3.5.11 =
* Alignment with Pro+/Ecommerce changes

= 3.5.10 =
* Further fixes for the Enfold theme
* Added new filters

= 3.5.9 =
* Fixed the bug with the non-linked terms not having the right styles applied
* Fixed the bug with the terms not openin on the new tab properly on the index page
* Added the option to show the term link in tooltip in new tab
* Fixes for the Enfold theme

= 3.5.8 =
* Fixed the problem with the fontsize for the tooltips
* Fixed the disable_listnav attribute for Client Side Pagination

= 3.5.7 =
* Small bugfixes

= 3.5.6 =
* Fixed the problem with the tooltip closing on mobile
* Fixed the XSS vulnerability of the Glossary Index

= 3.5.5 =
* Added the label to "Back to top" in "Expand + Description" Glossary Index type
* Added the option to disable the filtering of the tooltip content completely
* Added the option to display the related articles in new tab
* Added the new shortcode [cm_tooltip_link_to_term] (see the Shortcodes menu item for details)

= 3.5.4 =
* Fixed the bug with the Tooltip title color settings not working

= 3.5.3 =
* Added the translation wrappers to few missing places on the Glossary Term Page

= 3.5.2 =
* Furtner improved the PHP 7.0 compatibility
* Added the option to close the tooltip with the ESC key (if it's clickable)

= 3.5.1 =
* Small bug fixes

= 3.5.0 =
* Improved the PHP 7.0 compatibility
* Added the option to overwrite the "Highlight only first term occurance" for post
* Fixed a rare warning about in the wp-includes/cache.php
* Added the option to use the dashicons in the [glossary_tooltip] shortcode
* Added option to exclude the parsed ACF fields by ID
* Added the option to disable ACF parsing on page/post
* Added the options to set the size and color of the tooltip close icon

= 3.4.4 =
*Add the option to change the Tooltip title's text color and the Tooltip title's background color

= 3.4.3 =
* Improved accessibility of the Glossary Index letter navigation

= 3.4.2 =
* Added the option to remove the term higlightining on BuddyPress pages
* Fixed the term highlighting in the image captions of the ACF fields
* Fixed the tooltip explanations to some of the settings

= 3.4.1 =
* Fixed the Fast-Live-Filter vs Nothing found label
* Added the option to remove the parsing from the excerpts in Performance&Debug section enabled by default
* Removed the tooltip reappearing after clicking the close button

= 3.4.0 =
* Added the option to select which types of Advanced Custom Fields should be parsed
* Added the option to select which types of Advanced Custom Fields should have the WP filters removed (wpautop)
* Added the option to disable the Alphabetic Index
* Added the option to change the width of the tiles
* Fixed the bug in parsing of the ACF fields
* Fixed the bug with the close icon for tooltip sometimes missing when not logged in

= 3.3.13 =
* Fixed the problem with the align of the letters index in the Glossary Term pages

= 3.3.12 =
* Bugfix release

= 3.3.11 =
* Fixed the problem with the styling of the Index Page
* Fixed the typo in SYNONYMS
* Fixed the problem with the tooltips appearing on Glossary Index Page with server-side pagination
* Fixed the bug with styles missing on the Glossary Term pages when no related terms have been found and scripts placed in footer
* Fixed the bug with "ALL" option not being properly pre-selected in some cases (you can now type "all" or "ALL" in pre selected option to force that)

= 3.3.10 =
* Fixed the notice in related articles
* Changed the styling of the letter count in Glosssary Index Alphabetical list
* Fixed the bug in the Category Whitelisting
* Added the option to show only "Draft" elements on Terms List in Admin Dashboard

= 3.3.9 =
* Added the option to change the ordering of the tags to alphabetical
* Removed the redundant Server Information tab from the Settings
* Moved the shortcodes info to separate tab
* Slightly improved the look of the tooltip close icon
* Fixed small bugs

= 3.3.8 =
* Fixed the rare 'randomness' of the random terms widget bug in some installations
* Added the option to enable "Embeded mode" which outputs the scripts inside the content (so the Glossary Index Page works in Magento using FishPig extension)
* Fixed the bug not allowing to unset all of the post types in the related articles list
* Improved support for Yoast SEO plugin
* Added the option to force override the color of the tooltip texts
* Added the option to show only the custom related articles
* Fixed the bug in the related articles parsing

= 3.3.7 =
* Fixed the rare bug with initial the pagination
* Fixed the rare bug with undefined excludedTagsCount
* Fixed the bug with "related" attribute used together with "glossary_index_style" in [glossary] shortcode
* CHANGE: Disabled the "Enable Caching Mechanisms" by default

= 3.3.6 =
* Added the option to split the Glossary Index letters navigation into multiple lines with | character
* Added the option to disable the element count in Glossary Index letters navigation
* Fixed the Glossary Index letters styling
* Added the option to disable the additional Visual Editor buttons
* Added the option allowing to open the custom related articles in same tab
* Added the new attribute to [glossary] shortcode "glossary_index_style" allowing to override the general setting

= 3.3.5 =
* General bugfixing

= 3.3.4 =
* General bugfixing

= 3.3.3 =
* Fixed conflict in BuddyPress avatar cropping
* Added the option to hide the "empty" letters in the Glossary Index Page
* Big performance optimization (reduced memory amount used, number of quersies, and loading times)

= 3.3.1 =
* Replaced "data-tooltip" attribute with "data-cmtooltip" to avoid collisions
* Added the new label for the prefix before the "title" attribute

= 3.3.0 =
* Fixed the problem with set_time_limit
* Fixed the gettext calls
* Added the options to set colors for links in the tooltip
* Added the option to display tooltips on click not on hover

= 3.2.9 =
* Updated the "ALL" count in Glossary Index Page client side pagination

= 3.2.8 =
* Small fix in the licensing API

= 3.2.7 =
* Added the several new strings to be translatable
* Removed the deprecated options
* Added the option to Get the Suggested Synonyms from the external Service
* Added many custom classes to the elements on the Glossary Term page to allow easier customisation

= 3.2.6 =
* Ensured the WordPress 4.4 compatibility
* Small fix to the licensing package

= 3.2.3 =
* Fixed the sorting of numbers when 'intl' library is present from 1,10,11,2 to 1,2,10,11
* Fixed the problem with the role management

= 3.2.2 =
* Fixed the problem with related articles when the "Highlight Only the first occurance" is enabled and "Only highlight on "main" WP query?" is disabled
* Fixed the bug with synonyms not being properly deleted for the deleted terms (messaged as duplicates)
* Removed the parsing of the tooltips in the textareas
* IMPORTANT! Adding/deleting/editing the glossary terms now require the "manage_glossary" capability (added to admin/editor on activation)
* Added the option to control the role(s) which can add/edit/delete glossary terms
* Fixed the bug in the BuddyPress group creation/editing

= 3.2.1 =
* Raised the priority of the main hooks over to 20000 to avoid conflicts
* Added the functionality which remembers the last selected filters on the Glossary Index Page
* Improved the design of the tooltips
* Added the option to set the delay before the tooltip appears and before it hides
* Added the option to show the shadow for the tooltips and set it's color
* Redesigned the synonyms feature to improve the WPML compatibility and fix some bugs

= 3.2.0 =
* Fixed the missing arguments to "current_user_can" calls
* Added the autocreation of cache table, when one of the columns is missing
* Fixed the code responsible for creating the cache table
* Moved all of the Labels to separate table
* Added the option to whitelist/blacklist multiple categories on the post/page

= 3.1.9 =
* Fixed the bug with terms consisting of just numbers being incorrectly highlighted
* Added the support for highlighting the terms in the Woocommerce short description

= 3.1.8 =
* Added the hook allowing to change/remove the built-in tooltip styling: add_filter('cmtt_dynamic_css',$content)

= 3.1.7 =
* Removed the <h4> tags used in the plugin to comply with the accessibility standards
* Adedd the support for touch+mouse devices
* Added the options to control the Related Articles Index - now it's done in chunks to solve the performance problems

= 3.1.6 =
* Added the option to keep the images in the Tooltip content
* Added the option to move the scripts loading to the footer
* Added the option to disable the creation of RSS feeds for the glossary term pages
* Fixed the bug with the "checked" on the Tooltip - Disables
* Small improvements and bugfixes
* Fixed the rare problem with the shortcode detection

= 3.1.5 =
* Fixed the bug with the option "Show close icon"
* Added the option to keep the images in the Tooltip content
* Added some security updates
* Fixed the bug which stopped the terms from being highlighted on glossary pages
* Added the option to pick the pagination position in the Server-side pagination
* Updated the CSS for the category links on the Glossary Index Page

= 3.1.4 =
* Fixed the XSS vulnerability in Wordpress add_query_arg() and remove_query_arg() functions

= 3.1.2 =
* Fixed the support for the apostrophes in the Glossary Terms
* Added the option to highlight terms in bbPress replies
* Added the option to pick the template for the Glossary Term from the Settings
* Added the wp-color-picker to color selections

= 3.1.1 =
* Changed all of the __() and _e() calls to CMTT_Free::__() and CMTT_Free::_e() respectively
* Added the options to set the tooltips max-width and min-width
* Organized the General Settings screen in more sections

= 3.1.0 =
* Fixed the problems with blacklist/whitelist
* Fixed the option removing comments from term pages (worked inverse)
* Added the explanation to the Custom Term Link functionality
* Added the option to turn ON/OFF the caching mechanisms
* Added the option to choose the Custom Post Types where the Tooltips should be highlighted
* Added the option to highlight the terms in Advanced Custom Fields (ACF)
* Added the new attribute (related="X") to the [glossary] shortcode allowing to show "up to X" related articles on Glossary Index List
* Added the new attribute (no_desc="0") to the [glossary] shortcode allowing to disable the descriptions on Glossary Index List

= 3.0.6 =
* Fixed some small bugs, small code improvements
* Fixed small bug in js on mobile devices, subsequent term clicks close previous tooltips

= 3.0.5 =
* Improved i18n by wrapping some missing texts in __()

= 3.0.4 =
* Settings stay on the last tab after save
* Fixed the bug with the terms not being highlighted for some users

= 3.0.3 =
* Fixed the bug with [glossary_exclude] shortcode sometimes appearing around the Glossary Index
* Improved the support for mobile devices
* Added the support for passing the attributes to the [glossary] shortcode by $_GET and $_POST
* Removed the unused "title_prefix", "title_show" and "title_category" attributes from the [glossary] shortcode
* Updated the shortcode attributes of the [glossary] shortcode
* Fixed the bug with accented characters in Modern Table and Classic Table

= 3.0.2 =
* Added the support for DataTables(https://datatables.net)
* Improved the way tooltip position is calculated - the tooltips should take into account the boundaries of the viewport
* Added the option to choose the locale used for the sorting on Glossary Index page

= 3.0.1 =
* Added the support for sorting using "intl" library
* Fixed the typo in "Cleanup Database" button
* Added the autoinstaller for the synonyms and related posts (fixes the problems with failed saving)

= 3.0.0 =
* Improved the performance of the Glossary Index page
* Added the support for [glossary] shortcode
* Added the automatic addition of [glossary] shortcode to the Glossary Index page
* Added over 50 new filters
* Added over 20 new actions
* Fixed many bugs/potential bugs
* Improved i18n by adding some missing labels
* Improved security by fixing potential XSS vulnerabilities

= 2.8.6 =
* Fixed the numbers of terms overlapping the letters in Glossary Index
* Added the option to manually check for the plugin updates
* Added the option to display the "X" to close the tooltip
* Fixed a rare bug with terms not being highlighted only once

= 2.8.5 =
* Fixed the frequency the plguin checks for the update

= 2.8.4 =
* Fixed the bug with the license activation
* Added the option to turn off the term highlighting on the Glossary Term pages in the Settings

= 2.8.3 =
* Fixed the bug "indexOf not working in InternetExplorer 8"

= 2.8.2 =
* Added the new options for sorting of the Related Articles
* Added the option to add a custom Wikipedia URl for a term
* Fixed some small JS issues
* Added the option to edit the [All] label

= 2.8.1 =
* Fixed the bug causing the Glossary Index Page to disregard the chosen template
* Fixed the links to the social media libraries
* Added the option to select the size of the Glossary Index letters
* Fixed the bug in [cm_tooltip_parse] shortcode which was adding the <p> tag
* Limited the scope of the admin styles to the plugin's Settings only
* Fixed the problems with Posts/Pages with with statuses other than "published" being shown in "Related Posts"

= 2.8.0 =
* Merged the items on the Glossary Index Page regardless of the case
* Improved the support to [glossary_parse] shortcode by adding new qTags and tinyMCE and ckeditor buttons
* Added the option allowing to display the edit-link inside the Tooltip for logged-in users with "edit_posts" capability
* Added the button on the Settings page allowing to Cleanup the database (erase all the data plugin has saved in the DB)

= 2.7.9 =
* Fixed the bug in the function generating the Glossary Index Page

= 2.7.8 =
* Added the example import file on the Import/Export page
* Fixed the bugs on the Import/Export page

= 2.7.7 =
* Combined the scripts to optimize loading times
* Optimized the loading of external vendor scripts required by ShareThis box
* Added the option to turn off the tooltips on mobile devices
* Fixed the Import/Export format example
* WARNING! Due to the performance issues on big glossaries, we've decided to disable for the terms to have parent

= 2.7.6 =
* Changed some of the CSS rules to be more strict
* Fixed the bug with one of the options that couldn't be unchecked
* Improved the tooltip display on narrow screens on low resolutions and near the edges

= 2.7.5 =
* Added the support for the CM Tooltip Glossary Remote Import
* Fixed the paths of the scripts on SSL installations
* Fixed the TinyMCE editor integration (glossary_exclude button)
* Added the Call to action box on Settings screen

= 2.7.4 =
* Fixed the deprecated calls in widgets.php
* Fixed the problem with licensing
* Started the WPML compatibility integration
* Added the filter "cmtt_disable_metabox_posttypes" which allows to display disable metabox on custom post types

= 2.7.3 =
* Fixed the js bug
* Added the backup support and options

= 2.7.2 =
* Removed the meta information caching from the query of the parser (bug with long queries)
* Fixed the bug with "glossary_container" element being indented on AJAX requests
* Fixed the bug with term definitions not being displayed correctly on the Glossary Index Page

 2.7.1 =
* Added option to change the order of the "Related Articles"
* Improved the performance of the synonyms
* Fixed the bug with widgets

 2.7.0 =
* Updated the link to the User Guide
* Dropped the "Licensed Item Name" from the "Licensing" screen
* Redesigned the "Settings"

 2.6.9 =
* Fixed the "parse_error" bug in PHP versions <5.3
* Added Licensing tab and support
* Fixed notices

= 2.6.8 =
* Fixed some problems with displaying the Glossary Index page (conflict)

= 2.6.7 =
* Added the menu icon
* Fixed the setting "Avoid parsing protected tags?"
* Adedd "header" to the list of protected tags
* Fixed "Show linked glossary terms" setting
* Remove the filter displaying the Glossary Index Page after it's outputted once

= 2.6.6 =
* Fixed the title of the Glossary Index Page when there's permalink conflict
* Displaying "Glossary Index Page ID" settings in separate line
* Added the option to prefix the Glossary Term title on Glossary Term page
* Fixed a bugs with pagination
* Added the options to display the "Share This" box on the Glossary Index Page and Glossary Term Pages

= 2.6.5 =
* Changed the "Glossary Index Page ID" input from textbox to select
* Updated the descriptions of "Glossary Index Page ID" and "Glossary Index Page Permalink"
* Added option to generate the "Glossary Index Page"
* Added new column in "System Information" with information if the setting is OK

= 2.6.4 =
* Fixed the bug with 'persistent' tooltip
* Fixed the bug with permalink conflict of page and archive
* Fixed the first listnav letter bug when [All] and [0-9] were disabled

= 2.6.3 =
* Fixed a very rare bug with filenames conflict

= 2.6.1 =
* Fixed bugs
* Added warning message about missing "mbstring" library
* Fixed the title settings

= 2.6.0 =
* Fixed some problems with saving the settings
* Added the redirect from the terms archive to the glossary index page

= 2.5.2 =
* Added the "mbstring" check to the System Information tab
* Fixed the conflict with "NextGen Gallery"
* Fixed the bug with "&amp;" character in synonyms
* Redesigned the settings for better readability and functionality
* Fixed some notices

= 2.5.1 =
* Tooltips are now displayed by default
* Added the Term title to the Tooltip content
* Added the note about using the Excerpts

= 2.5.0 =
* Fixed the bug with 0-9 color on glossary index letters nav bar
* Fixed the bug with disabling the tooltips in the Glossary Random Terms widget
* Added the option to show [All] on the glossary index letters nav bar
* Added the "Server Information" settings tab
* Fixed the conditions in "the_content" filters

= 2.4.10 =
* Separated "Variations" metabox from "Synonyms"
* Fixed wording in the variations/synonyms additional informations
* Fixed a bug in tooltip recognition pattern
* Added the support for BuddyPress (custom type for filter: "bp_blogs_record_comment_post_types")
* Added "Edit Glossary Item" to the admin bar
* Added the support for shortcode [glossarytooltip content="text"]term[/glossarytooltip]
* Added the code changing the default charset for the synonyms/variations table to UTF-8
* Added the link to the "Trash" (for trashed glossary terms)

= 2.4.9 =
* Added the charset (UTF-8) and collate information of synonyms/variations table
* Fixed a bug with contentHash
* Added better support for Unicode characters in tooltip recognition pattern (especially for French support)
* Added clarification informations about synonyms and variants (toggle by clicking on "More info")

= 2.4.8 =
* Fixed the rare bug with case-sensitivity
* Added the option allowing to turn off the plugin parsing completely
* Fixed related articles per page setting
* Added the option to add Glossary Items from the admin bar
* Changed the database structure regarding the synonyms
* Added the error message if the same synonym/variation is being used more than once
* Fixed the deprecated "attribute_escape()" calls

= 2.4.6 =
* Fixed notifications appearing on some plugin installations
* Fixed the bug with parsing with huge amounts of glossary items ( over 3000)

= 2.4.5 =
* Added the option to disable the glossary term links on given page
* Added the option to disable the tooltips on given page
* Clarified the option which stopped the plugin to parse the given page

= 2.4.4 =
* Fixed listnav js problems
* Added the option to disable the parsing of the glossary pages
* Fixed the conflict with Cminds AdsChanger plugin
* Fixed the rare installation bug which caused main glossary page not being created

= 2.4.3 =
* Fixed a bug which caused the alphabetical list to not appear

= 2.4.2 =
* Added the option to put the tooltip.js in footer
* Switched default tooltip.js loading place to header (due to many themes lacking wp_footer() hook)
* Changed the way how jQueryUI is loaded in admin

= 2.4.1 =
* Fixed the issue with tooltip transparency
* Fixed the issue with tooltip fadeIn
* Added the option to switch the tooltip between clickable and unclickable
* Added the custom filter "cm_tooltip_parse" which can be used to enable tooltip functionality outside "the_content"
* Added the shortcode "[cm_tooltip_parse]text[/cm_tooltip_parse]" which applies the above filter to its content

= 2.4.0 =
* Fixed the bug with tooltip link in glossary index page

= 2.3.11 =
* Fixed the bug with definitions on the glossary list not appearing
* Fixed the bug with wrong tooltip appearing for two terms having the same part
* Fixed the PHP error for widget
* Added the affiliate programme

= 2.3.10 =
* Fixed a couple of PHP warnings

= 2.3.9 =
* Fixed tooltip.js conflict with Modernizr
* Fixed the rare conflict that caused the main index page not showing up

= 2.3.8 =
* Fixed the issue where admin tabs weren't working in rare cases

= 2.3.7 =
* Fixed the bug with htmlentities being decoded

= 2.3.6 =
* IMPORTANT! Minimal Wordpress version supported: 3.3
* Fixed the way of loading dynamic CSS
* Added the explanation for how to remove the tooltips on the main index page
* Removed old files

= 2.3.5 =
* Upgraded the main glossary index paging mechanism

= 2.3.4 =
* Fixed the bug which was throwing Warnings if the content html was incorrect
* Fixed the bug with tooltip not appearing for some users
* Added the option to search the terms in non-separated texts (e.g. japanese) (default: OFF)

= 2.3.3 =
* Fixed the bug which was breaking the layout for the pages without content

= 2.3.2 =
* Fixed the bug which appeared when activating plugin with PHP < 5.3.6
* Removed the admin menu link for subscribers
* Fixed "More info" link

= 2.3.1 =
* Fixed the bug which broke the layout if the either term or synonym was the same as the HTML tag name
* Optimized the parsing speed

= 2.3 =
* Added ability to remove leave links in tooltip content
* Optimized the javascript of the tooltip
* Fixed the conflict with Wordpress SEO by Yoast
* Fixed tooltip display problems
* Optimized the parsing to make the pages load faster
* Fixed the bug with broken links
* Fixed the bug with broken inputs

= 2.2.5 =
* Disabled tooltip on glossary list when descriptions are enabled
* Updated JS method to allow tooltip to appear while mouse in on tooltip

= 2.2.4 =
* Fixed bug with replacing single quotes with backticks
* tested with WP 3.5.2
* Fixed slashes before single quotes in tooltip content
* Fixed pagination nav for tiles view
* Added strip_tags for glossary descriptions within glossary list

= 2.2.3 =
* Added user guide

= 2.2.2 =
* Fixed special characters (e.g. umlauts) parsing

= 2.2.1 =
* show the terms AND the definitions in Alphabetical index
= 2.2 =
* Added support for custom characters in alphabetical index
* Added option to remove [0-9] from alphabetical index
* Added text to import panel informing that file should be UTF8
* Removed lowercase normalization for synonyms
* Moved synonyms below description
* Added second back link in the bottom of glossary page and options to customize that
* Disabled parsing for not singular pages with "more" tag (as for excerpts)

= 2.1 =
* Fixed dbDelta
* Improved performance on not singular pages

= 2.0.10 =
* Fixed related articles indexing

= 2.0.9 =
* Synonyms and variations can now be exported and imported to/from CSV

= 2.0.8 =
* Fixed problem with saving synonyms and variations
* Variations are now not shown in tooltip
* Fixed display issue on settings page

= 2.0.7 =
* Added right single quotation mark to normalization
* Added ability to add singular/plural variations for glossary terms
* Added ability to prefix related glossary articles

= 2.0.6 =
* Indexing related articles disabled on activation, moved completely to cron and extended execution time limit to 5mins

= 2.0.5 =
* Content normalized regarding special characters like single quote and ampersand, which were encoded differently based on environment, editor and other factors.

= 2.0.4 =
* Fixed problem with (*UTF8) flag not being recognized on all PHP environments
* Fixed problem when empty synonyms failed when saving
* Fixed problem when synonyms could not be turned off

= 2.0.3 =
* Fixed problem with html entities in glossary term name (ampersand, apostrophe, etc.)
* Added multisite capability

= 2.0.2 =
* Install bug fix and add comments to glossary

= 2.0 =
* Minor fix in styling
* Allow users with "edit_posts" capability to add/edit glossary terms
* Added "/u" (UTF8) flag to regex to force UTF8 encoding
* Glossary main page is now automatically created upon activation if not exists
* Added styling of glossary links and tooltips to settings panel
* Tabbed UI for settings
* Added "Synonyms" feature
* Added "Related articles" feature
* Added server-side pagination

= 1.6 =
* Added "open glossary description in new window/tab" option to settings panel
* Added onclick event on tooltip, so if you using touch device, you just need to click on the tooltip to hide it.
* Changed parsing mechanism

= 1.5 =
* Added "case-sensitive" option to settings panel
* Fixed bug when slash character inside glossary term was causing problems
* Added default z-index:100 to tooltip CSS

= 1.4 =
* Fixed bug when multiline tooltips were not displayed correctly on Glossary List
* Fixed bug when glossary list was displayed in the bottom of all pages/posts when Glossary Page ID was not set in Settings
* Terms that are substrings of current glossary item are not highlighted now on glossary definition page
* Fixed bug when term with brackets inside was not highlighted
* Added "Published/Trash" filter for glossary terms

= 1.31 =
* Bug fix with escaped single qoutations

= 1.3 =
* Reorganize admin menu
* Added 'with_front'=false for rewrite item

= 1.2 =
* Added alphabetical letter index for glossary list
* Added option to style glossary list as tiles instead of regular list
* Do not show glossary explanation tooltip when on its explanation page
* Do not show [glossary_exclude] tag in tooltips
* Fix bug when excluded tags were embedded into other excluded tags
* Fix bug when glossary terms were substrings of other glossary terms and only the shortest was caught (Thanks to Torsten Keil)
* Fix bug when HTML code in tooltip content causes page to break
* Thanks for Paul Ryan (prar@hawaii.edu) for his code contribution and Sebastian Palus for his addition and bug fixes

= 1.1 =
* Add A tag to the list of tags to ignore (Thanks to Robert Gilman)
* Change activation mechanisim  (Thanks to Robert Gilman)
* Fix bug when using excerpt (Thanks to Robert Gilman)

= 1.0 =
* First release nased on revised version on TooltipGlossary
* Optimized code and bug fix from TooltipGlossary
* Added [glossary_exclude] text [/glossary_exclude]
* Added filters to clean tooltip text
* Avoid changing URL using this format: href='url' in adition to href=""
* Add extended functionality including excluding H1, H2, H3, Script, Object tags
* Use the excerpt (if it exists) as hover text.
* Remove term link to the glossary page
* Limit tooltip length
