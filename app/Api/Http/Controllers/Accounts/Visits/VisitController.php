<?php
namespace App\Api\Http\Controllers\Accounts\Visits;

use App\Accounts\Account;
use App\Api\Http\Controller;
use App\Api\Visits\VisitTransformer;
use App\Visits\Visit;
use App\Visits\VisitRepository;

class VisitController extends Controller
{
    /**
     * @var \App\Visits\VisitRepository
     */
    private $visits;

    public function __construct(VisitRepository $visits)
    {
        $this->visits = $visits;
    }

    public function index(Account $account)
    {
        $visits = $this->visits->findByAccountPaginated($account);

        return $this->response()->paginator($visits, new VisitTransformer());
    }

    public function show(Account $account, Visit $visit)
    {
        return $this->response()->item($visit, new VisitTransformer());
    }

    public function delete(Account $account, Visit $visit)
    {
        $this->visits->delete($visit);
        
        return $this->response()->noContent();
    }
}
