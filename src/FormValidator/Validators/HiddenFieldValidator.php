<?php

namespace App\FormValidator\Validators;

use App\FormValidator\Exceptions\FormValidatorException;
use App\FormValidator\Helpers\Request;

final class HiddenFieldValidator extends AbstractValidator
{
    public function __construct(private string $fieldName) {}

    public function handle(Request $data): void
    {
        if ($data->get($this->fieldName)) {
            throw new FormValidatorException('Hidden field must not be filled');
        }
        $this->handleNext($data);
    }
}
