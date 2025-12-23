<?php

namespace App\Http\Requests\Admin;

use App\Models\Life;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;

class SaveLifeRequest extends CrudRequest
{
    /**
     * Type of class being validated.
     *
     * @var string
     */
    protected $type = Life::class;

    /**
     * Rules when editing resource.
     *
     * @return array
     */
    protected function editRules()
    {
        return [
        ];
    }

    /**
     * Rules when creating resource.
     *
     * @return array
     */
    protected function createRules()
    {
        return [
        ];
    }

    /**
     * Base rules for both creating and editing the resource.
     *
     * @return array
     */
    public function baseRules()
    {
        return [
            'name' => ['required', 'string', 'min:1', 'max:255'],
           
            'birth_date' => ['nullable', 'date'],
            
        ];
    }

    protected function prepareForValidation()
    {
        try {
            $formatedDate = Carbon::createFromFormat('d/m/Y', $this->birth_date)->format('Y-m-d');
        } catch (InvalidFormatException $e) {
            $formatedDate = $this->birth_date;
        }
        
        $this->merge([
            'birth_date' => $formatedDate
        ]);
    }

}
