<?php
namespace App\Documents;

use Illuminate\Support\ServiceProvider;

class DocumentServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;
    
    public function register()
    {
        $this->app->singleton(DocumentRepository::class, function () {
            return new EloquentDocumentRepository(new EloquentDocument());
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            DocumentRepository::class,
        ];
    }
}
