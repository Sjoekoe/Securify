<?php
namespace App\Api\Http\Controllers\Accounts\Visitors;

use App\Accounts\Account;
use App\Api\Http\Controller;
use App\Api\Visitors\Requests\StoreVisitorRequest;
use App\Api\Visitors\Requests\UpdateVisitorRequest;
use App\Api\Visitors\VisitorTransformer;
use App\Visitors\Visitor;
use App\Visitors\VisitorRepository;

class VisitorController extends Controller
{
    /**
     * @var \App\Visitors\VisitorRepository
     */
    private $visitors;

    public function __construct(VisitorRepository $visitors)
    {
        $this->visitors = $visitors;
    }

    public function index(Account $account)
    {
        $visitors = $this->visitors->findByAccountPaginated($account);

        return $this->response()->paginator($visitors, new VisitorTransformer());
    }

    public function store(StoreVisitorRequest $request, Account $account)
    {
        $visitor = $this->visitors->create($account, $request->all());

        return $this->response()->item($visitor, new VisitorTransformer());
    }

    public function show(Account $account, Visitor $visitor)
    {
        return $this->response()->item($visitor, new VisitorTransformer());
    }

    public function update(UpdateVisitorRequest $request, Account $account, Visitor $visitor)
    {
        $visitor = $this->visitors->update($visitor, $request->all());

        return $this->response()->item($visitor, new VisitorTransformer());
    }

    public function delete(Account $account, Visitor $visitor)
    {
        $this->visitors->delete($visitor);

        return $this->response()->noContent();
    }
}
