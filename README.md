# Custom Google News RSS Feed Script For Wordpress
A Custom RSS FEED Script For Wordpress Blogs - For Google News or Other Services

- This script is not using the Wordpress core files. (For speed, flexibility, stability and security.)
- DB User only needs read permission. You can use another MySQL user for WP databese.
- You can use this script in your subdomain.

- You MUST use Advanced Custom Fields PRO plugin.
  - Add new field group with the condition of "Post Type -> Post"
  - Add a new field named "Google News Status"
  - Field type must be TRUE/FALSE.
  - You change your interface options.

- Use the ".htaccess" file to beautify the feed URL. So, your feed URL will be "yoursite.com/news-feed" instead of "yoursite.com/news-feed.php"
- Working Now => /googleNews -> googleNews.php

- If you want to add another RSS feed for another services (Bundle, Bing News or etc.), you should copy/edit/rename "google-news.php" file and add new rule into the .htaccess file.