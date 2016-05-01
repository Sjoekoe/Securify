<?php
namespace App\Documents;

use App\Documents\Folders\EloquentFolder;
use App\Documents\Folders\EloquentFolderRepository;
use App\Documents\Folders\FolderRepository;
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
        
        $this->app->singleton(FolderRepository::class, function() {
            return new EloquentFolderRepository(new EloquentFolder());
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            DocumentRepository::class,
            FolderRepository::class,
        ];
    }
}
