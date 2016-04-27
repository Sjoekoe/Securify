<?php
namespace App\Items;

use Illuminate\Support\ServiceProvider;

class ItemServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;
    
    public function register()
    {
        $this->app->singleton(ItemRepository::class, function() {
            return new EloquentItemRepository(new EloquentItem());
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            ItemRepository::class,
        ];
    }
}
