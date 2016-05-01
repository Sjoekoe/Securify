<?php
namespace App\Filesystem\Rules;

use App\Validation\Rules\Rule;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\File\File;

abstract class FileSizeRule implements Rule
{
    /**
     * @var int
     */
    protected $maxFileSize;

    /**
     * @param string $attribute
     * @param mixed $value
     * @param array $parameters
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return bool
     */
    public function validate($attribute, $value, array $parameters = [], Validator $validator = null)
    {
        if ($value instanceof File) {
            return $value->getSize() <= $this->maxFileSize;
        }

        return false;
    }
}
