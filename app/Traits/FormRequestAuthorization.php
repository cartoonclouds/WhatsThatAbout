<?php


namespace App\Traits;

use Exception;

trait FormRequestAuthorization
{

    protected function getPolicyGuard()
    {
        return in_array($this->method(), ['PUT', 'PATCH']) ? 'update' : 'create';
    }

    protected function getPolicyParameter()
    {
        if (!isset($this->routeParameter) || !isset($this->parameterClass)) {
            throw new Exception('Class variables routeParameter and parameterClass must be defined');
        }

        return $this->getPolicyGuard() === 'update'? $this->route()->parameter($this->routeParameter) : $this->parameterClass;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can($this->getPolicyGuard(), $this->getPolicyParameter());
    }
}
