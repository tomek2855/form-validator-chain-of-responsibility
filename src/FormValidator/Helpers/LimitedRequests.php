<?php

namespace App\FormValidator\Helpers;

final class LimitedRequests
{
    private const REQUESTS_TIME_LIMIT = 3600;

    public static function storeRequest(): void
    {
        $_SESSION['requests'][] = time();
    }

    public static function getRequestsCount(): int
    {
        if (!isset($_SESSION['requests'])) {
            return 0;
        }
        return count(
            array_filter($_SESSION['requests'], fn($time) => $time + self::REQUESTS_TIME_LIMIT > time())
        );
    }
}