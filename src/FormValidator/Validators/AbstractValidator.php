<?php

namespace App\FormValidator\Validators;

use App\FormValidator\Exceptions\FormValidatorException;
use App\FormValidator\Helpers\Request;

abstract class AbstractValidator
{
    private ?AbstractValidator $nextValidator = null;

    /**
     * @throws FormValidatorException
     */
    public abstract function handle(Request $data): void;

    public function setNextValidator(AbstractValidator $next): void
    {
        $this->nextValidator = $next;
    }

    /**
     * @throws FormValidatorException
     */
    protected function handleNext(Request $data): void
    {
        $this->nextValidator?->handle($data);
    }
}
