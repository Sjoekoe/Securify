<?php

use App\Core\Factories\BuildModels;
use App\Core\Factories\ModelFactory;
use App\Users\User;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    use BuildModels;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
        $this->modelFactory = $app->make(ModelFactory::class);

        return $app;
    }

    public function setup()
    {
        parent::setUp();
        $this->artisan('migrate:reset');
        $this->artisan('migrate');
    }

    /**
     * @param array $attributes
     * @return \App\Users\User
     */
    public function createUser(array $attributes = [])
    {
        return $this->modelFactory->create(User::class, array_merge([
            'name' => 'Doe',
            'email' => 'john.doe@email.com',
        ], $attributes));
    }

    public function assertNoContent()
    {
        return $this->assertResponseStatus(204);
    }
}
