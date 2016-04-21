<?php
namespace App\Api\Http\Controllers\Accounts\Visitations;

use App\Accounts\Account;
use App\Api\Http\Controller;
use App\Api\Visits\Requests\StoreVisitationRequest;
use App\Visits\Jobs\CreateVisitation;
use App\Visits\Jobs\UpdateVisitation;
use App\Visits\Visit;
use Illuminate\Bus\Dispatcher;

class VisitationController extends Controller
{
    /**
     * @var \Illuminate\Bus\Dispatcher
     */
    private $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function store(StoreVisitationRequest $request, Account $account)
    {
        $this->dispatcher->dispatch(new CreateVisitation($account, $request->all()));

        return $this->response()->created();
    }

    public function update(StoreVisitationRequest $request, Account $account, Visit $visit)
    {
        $this->dispatcher->dispatch(new UpdateVisitation($account, $visit, $request->all()));

        return $this->response()->created();
    }
}
