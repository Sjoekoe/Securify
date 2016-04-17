<?php
namespace App\Companies;

use App\Helpers\BelongsToAccount;
use App\Helpers\StandardModel;
use Illuminate\Database\Eloquent\Model;

class EloquentCompany extends Model implements Company
{
    use StandardModel, BelongsToAccount;

    /**
     * @var string
     */
    protected $table = self::TABLE;

    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'vat', 'website', 'telephone'];

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
    public function telephone()
    {
        return $this->telephone;
    }

    /**
     * @return string
     */
    public function email()
    {
        return $this->email;
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
    public function vat()
    {
        return $this->vat;
    }
}
