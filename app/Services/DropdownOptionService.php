<?php

namespace App\Services;

use App\Models\DropdownOption;

class DropdownOptionService
{
    private $dropdownOptionObj;

    public function __construct()
    {
        $this->dropdownOptionObj = new DropdownOption();
    }

    public function collection(array $inputs)
    {
        $typeArr = explode(',', $inputs['type']);
        $dropdownOptions = $this->dropdownOptionObj->getQB()->whereIn('type', $typeArr)->get();

        $dropdownOptions = $dropdownOptions->groupBy('type');

        return $dropdownOptions;
    }
}
