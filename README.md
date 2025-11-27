fyi [Front controller view](https://en.wikipedia.org/wiki/Front_controller)

run it with `php -S localhost:8080 -d display_errors=On -d error_reporting=E_ALL app.php`

it works due to:
quoting [php internals book](https://www.phpinternalsbook.com/php7/extensions_design/php_lifecycle.html)

>Once started, PHP waits to handle one/several requests. When we talk about PHP CLI, there will be only one request: the current script to run. However, when we talk about a web environment- should it be PHP-FPM or webserver module- PHP could serve several requests one after the other. It all depends on how you did configure you webserver: you may tell it to serve an infinite number of requests, or a specific number before shutting down and recycling the process. Every time a new request arrives to be handled, PHP will run a request startup step. We call it the RINIT

or TLDR: in php cli it works due to per request interpretation of the file
