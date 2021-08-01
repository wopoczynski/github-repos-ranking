<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Dto\GithubRepository;
use App\Service\RepositoriesComparator;
use PHPUnit\Framework\TestCase;

final class RepositoriesComparatorTest extends TestCase
{
    private const STATISTICS_PROPERTIES = ['stargazersCount', 'forksCount', 'networkCount', 'subscribersCount', 'watchersCount', 'openPullRequests', 'closedPullRequests'];
    private RepositoriesComparator $object;

    public function setUp(): void
    {
        $this->object = new RepositoriesComparator();
    }

    public function testCalculateBaseStatisticsForRepositories(): void
    {
        $dtoMock = $this->createMock(GithubRepository::class);
        $dtoMock2 = $this->createMock(GithubRepository::class);
        foreach (self::STATISTICS_PROPERTIES as $property) {
            $dtoMock->expects($this->once())
                ->method('get' . ucfirst($property))
                ->willReturn(1);
        }
        foreach (self::STATISTICS_PROPERTIES as $property) {
            $dtoMock2->expects($this->once())
                ->method('get' . ucfirst($property))
                ->willReturn(2);
        }
        $repositories = ['first' => $dtoMock, 'second' => $dtoMock2];

        $this->assertEquals([
            'stars' => ['second' => 2, 'first' => 1],
            'forks' => ['second' => 2, 'first' => 1],
            'networkCount' => ['second' => 2, 'first' => 1],
            'subscribersCount' => ['second' => 2, 'first' => 1],
            'watchersCount' => ['second' => 2, 'first' => 1],
            'openPullRequests' => ['second' => 2, 'first' => 1],
            'closedPullRequests' => ['second' => 2, 'first' => 1],
        ], $this->object->calculateBaseStatisticsForRepositories($repositories));
    }
}
