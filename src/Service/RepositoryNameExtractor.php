<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\InvalidRepositoryName;

final class RepositoryNameExtractor
{
    /**
     * @throws InvalidRepositoryName
     */
    public function getNameFromFullPathOrName(string $repositoryUri): string
    {
        return rtrim(
            preg_replace('~^https?://github.com/~', '', $repositoryUri) ?? throw new InvalidRepositoryName($repositoryUri),
            '/'
        );
    }
}
