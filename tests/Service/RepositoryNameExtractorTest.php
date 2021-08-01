<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\RepositoryNameExtractor;
use PHPUnit\Framework\TestCase;

final class RepositoryNameExtractorTest extends TestCase
{
    private RepositoryNameExtractor $object;

    public function setUp(): void
    {
        $this->object = new RepositoryNameExtractor();
    }

    /**
     * @dataProvider names
     */
    public function testGetNameFromFullPathOrName(string $name): void
    {
        $this->assertEquals('wopoczynski/github-repos-ranking', $this->object->getNameFromFullPathOrName($name));
    }

    /**
     * @return array<string[]>
     */
    public function names(): array
    {
        return [
            ['https://github.com/wopoczynski/github-repos-ranking/'],
            ['https://github.com/wopoczynski/github-repos-ranking'],
            ['wopoczynski/github-repos-ranking'],
            ['wopoczynski/github-repos-ranking/'],
        ];
    }
}
