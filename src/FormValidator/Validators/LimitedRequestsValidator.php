<?php

namespace App\FormValidator\Validators;

use App\FormValidator\Exceptions\FormValidatorException;
use App\FormValidator\Helpers\LimitedRequests;
use App\FormValidator\Helpers\Request;

final class LimitedRequestsValidator extends AbstractValidator
{
    private const REQUESTS_LIMIT = 5;

    public function handle(Request $data): void
    {
        LimitedRequests::storeRequest();
        if (LimitedRequests::getRequestsCount() > self::REQUESTS_LIMIT) {
            throw new FormValidatorException('Requests limit exceeded');
        }
        $this->handleNext($data);
    }
}