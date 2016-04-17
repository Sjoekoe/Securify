<?php
namespace App\Visitors;

use App\Accounts\Account;

class EloquentVisitorRepository implements VisitorRepository
{
    /**
     * @var \App\Visitors\EloquentVisitor
     */
    private $visitor;

    public function __construct(EloquentVisitor $visitor)
    {
        $this->visitor = $visitor;
    }

    /**
     * @param \App\Accounts\Account $account
     * @param array $values
     * @return \App\Visitors\Visitor
     */
    public function create(Account $account, array $values)
    {
        $visitor = new EloquentVisitor();
        $visitor->name = $values['name'];
        $visitor->account_id = $account->id();
        $visitor->company_id = $values['company_id'];

        $visitor->save();

        return $visitor;
    }

    /**
     * @param \App\Visitors\Visitor $visitor
     * @param array $values
     * @return \App\Visitors\Visitor
     */
    public function update(Visitor $visitor, array $values)
    {
        $visitor->name = $values['name'];

        $visitor->save();

        return $visitor;
    }

    /**
     * @param \App\Visitors\Visitor $visitor
     */
    public function delete(Visitor $visitor)
    {
        $visitor->delete();
    }

    /**
     * @param int $id
     * @return \App\Visitors\Visitor|null
     */
    public function find($id)
    {
        return $this->visitor->where('id', $id)->first();
    }

    /**
     * @param \App\Accounts\Account $account
     * @param int $limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByAccountPaginated(Account $account, $limit = 10)
    {
        return $this->visitor->where('account_id', $account->id())->paginate($limit);
    }
}
