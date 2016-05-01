<?php

if (! function_exists('format_bytes')) {
    /**
     * Bytes converters.
     *
     * @param int $bytes
     * @return string
     * @todo Make this a Value object
     */
    function format_bytes($bytes)
    {
        $bytes = floatval($bytes);
        $result = '';
        $formatted = [
            0 => ["unit" => "TB", "value" => pow(1024, 4)],
            1 => ["unit" => "GB", "value" => pow(1024, 3)],
            2 => ["unit" => "MB", "value" => pow(1024, 2)],
            3 => ["unit" => "KB", "value" => 1024],
            4 => ["unit" => "bytes", "value" => 1],
        ];

        foreach ($formatted as $format) {
            if ($bytes >= $format["value"]) {
                $result = $bytes / $format["value"];
                $result = str_replace(".", ",", strval(round($result, 2))) . " " . $format["unit"];
                break;
            }
        }

        return $result;
    }
}
