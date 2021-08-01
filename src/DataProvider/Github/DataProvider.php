<?php

declare(strict_types=1);

namespace App\DataProvider\Github;

use App\Dictionary\GitHubDictionary;
use App\Dto\GithubRepository;
use App\Service\GithubRepositoryDeserializer;
use App\Service\RepositoryNameExtractor;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

final class DataProvider
{
    private const API_URI = 'https://api.github.com/repos/{repositoryName}';
    private const API_PULL_REQUESTS_URI = 'https://api.github.com/search/issues?q=repo:{repositoryName}%20is:pr%20is:{state}&per_page=1';
    private const API_URI_LATEST_RELEASE = 'https://api.github.com/repos/{repositoryName}/releases/latest';

    public function __construct(
        private GithubRepositoryDeserializer $deserializer,
        private HttpClientInterface $httpClient,
        private RepositoryNameExtractor $extractor
    ) {
    }

    /**
     * @throws \App\Exception\InvalidRepositoryName
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function getData(string $repository): GithubRepository
    {
        $name = $this->extractor->getNameFromFullPathOrName($repository);

        return $this->deserializer->deserialize(
            $this->getRequest(str_replace('{repositoryName}', $name, self::API_URI))->getContent()
        )
            ->setOpenPullRequests($this->getPullRequestsCount($name, GitHubDictionary::OPEN_PULL_REQUESTS))
            ->setClosedPullRequests($this->getPullRequestsCount($name, GitHubDictionary::CLOSED_PULL_REQUESTS))
            ->setLatestRelease($this->getLatestRelease($name));
    }

    private function getPullRequestsCount(string $name, string $state): int
    {
        return (int) json_decode(
            $this->getRequest(
                str_replace(['{repositoryName}', '{state}'], [$name, $state], self::API_PULL_REQUESTS_URI)
            )->getContent(),
            true,
        )['total_count'];
    }

    private function getLatestRelease(string $name): string
    {
        try {
            return json_decode(
                $this->getRequest(
                    str_replace('{repositoryName}', $name, self::API_URI_LATEST_RELEASE)
                )->getContent(),
                true,
            )['tag_name'];
        } catch (\Exception) {
        } finally {
            return 'no-tag-released';
        }
    }

    private function getRequest(string $url): ResponseInterface
    {
        return $this->httpClient->request(
            Request::METHOD_GET,
            $url,
            [
                'headers' => [
                    'Accept' => 'application/vnd.github.v3+json',
                ],
            ]
        );
    }
}
