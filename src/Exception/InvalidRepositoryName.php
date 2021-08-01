<?php

declare(strict_types=1);

namespace App\Exception;

use JetBrains\PhpStorm\Pure;
use Throwable;

final class InvalidRepositoryName extends LocalizedException
{
    #[Pure]
    public function __construct(string $message = '', int $code = 0, Throwable $previous = null)
    {
        parent::__construct(sprintf('%s is invalid repository name or route', $message), $code, $previous);
    }
}
