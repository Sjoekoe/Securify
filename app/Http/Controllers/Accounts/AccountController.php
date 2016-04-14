<?php
namespace App\Http\Controllers\Accounts;

use App\Accounts\Account;
use App\Core\Info\Info;
use App\Http\Controllers\Controller;
use App\Teams\TeamRepository;

class AccountController extends Controller
{
    /**
     * @var \App\Teams\TeamRepository
     */
    private $teams;

    public function __construct(TeamRepository $teams)
    {
        $this->middleware('auth');
        $this->teams = $teams;
    }

    public function index()
    {
        return view('accounts.index');
    }

    public function login(Account $account)
    {
        if ($team = $this->teams->findByUserAndAccount(securify_user(), $account)) {
            if ($this->isNotCurrentActiveAccount($account)) {
                auth()->activateTeam($team);
            }

            return redirect()->route('dashboard');
        }

        return back();
    }

    public function dashboard(Info $info)
    {
        return $info->toJson();
    }

    /**
     * @param \App\Accounts\Account $account
     * @return bool
     */
    private function isNotCurrentActiveAccount(Account $account)
    {
        return ! (auth()->checkTeam() && securify_account()->id() == $account->id());
    }
}
