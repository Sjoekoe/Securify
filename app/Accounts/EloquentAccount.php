<?php
namespace App\Accounts;

use App\Helpers\StandardModel;
use Illuminate\Database\Eloquent\Model;

class EloquentAccount extends Model implements Account
{
    use StandardModel;
    
    protected $table = self::TABLE;
    
    protected $fillable = ['name', 'vat', 'website'];

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function vat()
    {
        return $this->vat;
    }

    /**
     * @return string
     */
    public function website()
    {
        return $this->website;
    }
}
