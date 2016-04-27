<?php

use App\Core\Factories\BuildModels;
use App\Core\Factories\ModelFactory;
use App\Helpers\CreatesModels;
use App\JWT\TokenGenerator;
use App\Users\UserRepository;
use Illuminate\Http\Response;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    use BuildModels, CreatesModels;

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
        //$this->artisan('migrate');
    }

    /**
     * @param int|null $userId
     * @return array
     */
    public function setJWTHeaders($userId = null)
    {
        return ['Authorization' => 'Bearer ' . $this->getJWTToken($userId)];
    }

    private function getJWTToken($userId)
    {
        return $this->app[TokenGenerator::class]->byUser($this->createUser());
    }

    public function assertNoContent()
    {
        return $this->assertResponseStatus(Response::HTTP_NO_CONTENT);
    }
}
