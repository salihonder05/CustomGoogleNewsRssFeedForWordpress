# Custom Google News Rss Feed Script For Wordpress
A Custom RSS FEED Script For Wordpress Blogs - For Google News or Other Services

- This script not using the wordpress core files. // For Speed, Mobility, Stability and Security...
- DB User Only needs read permission. You can use another Mysql user for WP databese.
- You can use this script in your subdomain.

- You MUST use Advanced Custom Fields PRO.
  - Add new field group. post type -> post
  - Add new field = field name 'Google News Status'
  - Field type must be true/false.
  - You change your interface options.

- Use .htaccess for beautify url.
- Working Now => /googleNews -> googleNews.php

- If you want add another rss feed for another services (Bundle, Bing News or etc.) you should copy/edit/rename googleNews.php and add new rule to htaccess file.