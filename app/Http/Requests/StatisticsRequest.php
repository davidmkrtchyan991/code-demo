<?php

namespace App\Http\Requests;

use App\Classes\enums\RoleEnum;
use App\Classes\enums\StatisticsTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\auth\UserRoleCheckerHelper;

class StatisticsRequest extends FormRequest
{

    use UserRoleCheckerHelper;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->isAuthPassed(RoleEnum::ROLE_ADMINISTRATOR) || $this->isAuthPassed(RoleEnum::ROLE_TECHNICAL_MANAGER);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

        ];
    }

    public function isOrder()
    {
        return !$this->get('statisticsType') || $this->get('statisticsType') == StatisticsTypeEnum::ORDERS;
    }
}
