=== Change OG URL To HTTP ===
Contributors: inorbit
Tags: og url, http, og url yoast, og url aioseo, retain facebook likes
Requires at least: 4.1
Tested up to: 4.8.1
Stable tag: 1.0
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Changes OG URL tag added by Yoast, Aioseo and other plugins from HTTPS to HTTP to retain facebook like count for posts and pages.

== Description ==

When you shift your blog from HTTP to HTTPS, all your posts/pages lose facebook likes/share count. The only way to regain these likes/share counts is to add a 'OG URL' tag that points back to the older 'HTTP' urls as [described here by Facebook](https://developers.facebook.com/docs/plugins/faqs#moving-urls). 

This plugin helps you do just that.

For example, if you use a SEO plugin like Yoast, the OG URL tag automatically reflects the HTTPS version for HTTPS URLs. This plugin adds a filter to the 'OG URL' output and changes it back to 'HTTP' for all existing posts/pages. New posts that you add after this plugin is activated will not be affected. 

Similary, the canonical URL tag remains unchanged as 'HTTPS'. Canonical tag is used by search engines like Google. So you are good when it comes to SEO.

This plugin changes the OG URL output for the following popular plugins:

* Yoast SEO Plugin
* ALL In One SEO Pack
* WP facebook open graph protocol by Chuck Reynolds
* Facebook Open Graph, Google+ and Twitter Card Tags plugin by Webdados

= Note =

This plugin only changes the 'OG URL' tags for posts that existed when this plugin is first installed. This way all new posts will have the regular OG URL tags with 'HTTPS'.

== Steps to make this work ==

You need to follow these steps in order for the plugin to work:

*Step 1:* Install and activate the plugin.

*Step 2:* If you are using a Cache plugin (eg: WP Super Cache), delete the cache.

*Step 3:* Exclude facebook bot from the HTTP to HTTPS redirection in your HTaccess file. Here's an example:

RewriteEngine On
RewriteCond %{SERVER_PORT} 80
RewriteCond %{HTTP_USER_AGENT} !facebookexternalhit/[0-9] 
RewriteRule ^(.*)$ https://sitename.com/$1 [R=301,L]

The above rewrite rule excludes facebook bots from the redirect.

*Step 4:* Wait for 30 days for facebook to rescrape your pages. Your 'share count' will return when facebook rescrapes your page.

== Test to see if this works ==

You can instantly check to see if you did everything right by forcing facebook to rescrape one or many of your pages. Here's how you can do that: 

* Login to your facebook account and go to [Facebook debugger tool](https://developers.facebook.com/tools/debug/)
* Enter the 'HTTPS' url of one of your pages/posts and click the 'Debug' button. 
* If you get the "This URL hasn't been shared on Facebook before." message,click on the 'Fetch New Information' button. 
* Now click 'Scrap Again'. You should now be able to see all your 'likes' to the page. You would also see two URLs under the 'Redirect path'
heading which reflects your og:url meta tag and your original HTTPS URL.

Even if you do not manually rescrape your URLs, facebook will automatically rescape your URLs within 30 days. So all your 'share counts' will return within 30 days. 

For detailed information on these steps, [check out this article](https://orbitingweb.com/blog/http-to-https-retain-facebook-likes/)

== Want any new features? ==

Want any new features added to this plugin? Just send me an email. [You can find my email here.](https://orbitingweb.com/lets-get-in-touch/)

== Installation ==

= Manually installing the plugin =

1. Download the plugin zip file from Wordpress.org
1. Upload the zip file of the plugin by logging into your wordpress dashboard and going to 'Plugins > Add New > Upload Plugin'.
1. Click on the 'install' now button.
1. After the installation is complete, click the 'Activate' button.
1. Once activated, the plugin automatically adds a filter to the OG:URL output.

= Installing from Wordpress dashboard =

1. Login to your wordpress dashboard and go to 'Plugins > Add New'.
1. Search for 'Quick And Easy SEO' and click on the 'Install' button.
1. Once the installation is complete, click on the 'Activate' button.
1. Once activated, the plugin automatically adds a filter to the OG:URL output.
1. Check your HTML source to see if all tags are being added properly. 

== Frequently Asked Questions ==

= What does the plugin do? =

The plugin changes the OG URL output of popular plugins from HTTPS to HTTP URLs.

eg: https://example.com/article/ to http://example.com/article/

= How do I check if the plugin works? =

Simply check the HTML source of one of your posts/pages to see if the OG URL tag has been changed to 'HTTP'.

= Does the plugin change OG URL tags for all posts? =

The plugin only changes the OG URL tags for posts that existed when the plugin was installed.
This way new posts will have OG URL tags with HTTPS.

== screenshots ==

1. HTML souce of the page shows OG URL tag changed to HTTP


