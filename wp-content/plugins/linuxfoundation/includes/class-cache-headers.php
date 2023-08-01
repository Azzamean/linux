<?php

class CacheHeaders
{
    public function __construct()
    {
        add_action("send_headers", [$this, "add_header_cache"], 99);
    }

    public function add_header_cache()
    {
        if (!is_admin() && !is_user_logged_in()) {
            header(
                'Cache-Control: public, max-age=60, s-maxage=43200, stale-while-revalidate=86400, stale-if-error=604800'
            );
        }
    }
}

$cache_headers = new CacheHeaders();
