<?php

if (! function_exists('securify_account')) {
    /**
     * @return \App\Accounts\Account
     */
    function securify_account()
    {
        return auth()->account();
    }
}

if (! function_exists('securify_team')) {
    /**
     * @return \App\Teams\Team
     */
    function securify_team()
    {
        return auth()->team();
    }
}

if (! function_exists('securify_user')) {
    /**
     * @return \App\Users\User
     */
    function securify_user()
    {
        return auth()->user();
    }
}
