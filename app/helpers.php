<?php

if (! function_exists('securify_protocol_prepend')) {
    /**
     * @param string $url
     * @return string
     */
    function securify_protocol_prepend($url)
    {
        return (new App\Http\ProtocolPrepender())->prepend($url);
    }
}
