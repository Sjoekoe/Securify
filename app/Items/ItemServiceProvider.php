<?php
namespace App\Items;

use App\Items\Groups\EloquentItemGroup;
use App\Items\Groups\EloquentItemGroupRepository;
use App\Items\Groups\ItemGroupRepository;
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
        
        $this->app->singleton(ItemGroupRepository::class, function() {
            return new EloquentItemGroupRepository(new EloquentItemGroup());
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            ItemRepository::class,
            ItemGroupRepository::class,
        ];
    }
}
