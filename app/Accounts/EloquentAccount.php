<?php
namespace App\Accounts;

use App\Helpers\StandardModel;
use Illuminate\Database\Eloquent\Model;

class EloquentAccount extends Model implements Account
{
    use StandardModel;
    
    protected $table = self::TABLE;
    
    protected $fillable = ['name', 'vat', 'website', 'date_format', 'time_format'];

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

    /**
     * @return string
     */
    public function dateFormat()
    {
        return $this->date_format;
    }

    /**
     * @return string
     */
    public function timeFormat()
    {
        return $this->time_format;
    }
}
