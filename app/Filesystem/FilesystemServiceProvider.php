<?php
namespace App\Filesystem;

use App\Filesystem\Rules\LargeFileSizeRule;
use App\Filesystem\Rules\SmallFileSizeRule;
use App\Validation\ExtendsValidator;
use Illuminate\Support\ServiceProvider;

class FilesystemServiceProvider extends ServiceProvider
{
    use ExtendsValidator;

    /**
     * @var array
     */
    protected $rules = [
        SmallFileSizeRule::class,
        LargeFileSizeRule::class,
    ];

    public function boot()
    {
        require __DIR__ . '/helpers.php';
        
        $this->extendValidator();
        $this->registerFileSizeReplacers();
    }

    public function register()
    {
    }

    private function registerFileSizeReplacers()
    {
        /** @var \Illuminate\Contracts\Validation\Factory $validator */
        $validator = $this->app['validator'];

        $validator->replacer(SmallFileSizeRule::NAME, function($message) {
            return str_replace(':filesize', format_bytes(config('files.small_upload_max_filesize')), $message);
        });

        $validator->replacer(LargeFileSizeRule::NAME, function($message) {
            return str_replace(':filesize', format_bytes(config('files.large_upload_max_filesize')), $message);
        });
    }
}
