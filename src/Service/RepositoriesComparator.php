<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\GithubRepository;

final class RepositoriesComparator
{
    /**
     * @param array<string, GithubRepository> $repositories
     *
     * @return array{'stars': array<string, int>,
     * 'forks': array<string, int>,
     * 'networkCount': array<string, int>,
     * 'subscribersCount': array<string, int>,
     * 'watchersCount': array<string, int>,
     * 'openPullRequests': array<string, int>,
     * 'closedPullRequests': array<string, int>
     * }
     */
    public function calculateBaseStatisticsForRepositories(array $repositories): array
    {
        return [
            'stars' => $this->getOrderByStatistic('stargazersCount', $repositories),
            'forks' => $this->getOrderByStatistic('forksCount', $repositories),
            'networkCount' => $this->getOrderByStatistic('networkCount', $repositories),
            'subscribersCount' => $this->getOrderByStatistic('subscribersCount', $repositories),
            'watchersCount' => $this->getOrderByStatistic('watchersCount', $repositories),
            'openPullRequests' => $this->getOrderByStatistic('openPullRequests', $repositories),
            'closedPullRequests' => $this->getOrderByStatistic('closedPullRequests', $repositories),
        ];
    }

    /**
     * @param array<string, GithubRepository> $repositories
     *
     * @return array<string, int>
     */
    private function getOrderByStatistic(string $fieldName, array $repositories): array
    {
        $statistics = [];
        foreach ($repositories as $repositoryName => $repository) {
            $statistics[$repositoryName] = $repository->{'get' . ucfirst($fieldName)}();
        }
        uasort($statistics, fn ($a, $b) => (-1) * ($a <=> $b));

        return $statistics;
    }
}
