<?php
namespace App\Filesystem\Rules;

use Illuminate\Contracts\Config\Repository as Config;

final class SmallFileSizeRule extends FileSizeRule
{
    const NAME = 'small_filesize';

    /**
     * @param \Illuminate\Contracts\Config\Repository $config
     */
    public function __construct(Config $config)
    {
        $this->maxFileSize = $config->get('files.small_upload_max_filesize');
    }
}
