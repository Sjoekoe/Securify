<?php
namespace App\Filesystem\Rules;

use Illuminate\Contracts\Config\Repository as Config;

final class LargeFileSizeRule extends FileSizeRule
{
    const NAME = 'large_filesize';
    
    /**
     * @param \Illuminate\Contracts\Config\Repository $config
     */
    public function __construct(Config $config)
    {
        $this->maxFileSize = $config->get('files.large_upload_max_filesize');
    }
}
