<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\GithubRepositoryDeserializer;
use PHPUnit\Framework\TestCase;

final class GithubRepositoryDeserializerTest extends TestCase
{
    private const MOCK = '/../github_api_response_mock.json';
    private GithubRepositoryDeserializer $object;

    public function setUp(): void
    {
        $this->object = new GithubRepositoryDeserializer();
    }

    public function testDeserialize(): void
    {
        $mockedData = file_get_contents(__DIR__ . self::MOCK);
        $parsedObjectData = [
            'getName' => 'github-repos-ranking',
            'getUrl' => 'https://api.github.com/repos/wopoczynski/github-repos-ranking',
            'getDescription' => 'Testing the github api and basic stuff',
            'getCreatedAt' => (new \DateTime('2021-08-01 10:59:37.000000'))->format('Y-m-d H:i:s'),
            'getUpdatedAt' => (new \DateTime('2021-08-01 13:46:39.000000'))->format('Y-m-d H:i:s'),
            'getPushedAt' => (new \DateTime('2021-08-01 13:46:36.000000'))->format('Y-m-d H:i:s'),
            'getSize' => 28,
            'getStargazersCount' => 0,
            'getWatchersCount' => 0,
            'getForksCount' => 0,
            'getOpenIssuesCount' => 0,
            'getNetworkCount' => 0,
            'getSubscribersCount' => 1,
            'getDefaultBranch' => 'main',
        ];

        $result = $this->object->deserialize($mockedData); /* @phpstan-ignore-line */

        foreach ($parsedObjectData as $getter => $value) {
            $this->assertEquals($value, $result->{$getter}() instanceof \DateTimeInterface ? $result->{$getter}()->format('Y-m-d H:i:s') : $result->{$getter}());
        }
    }
}
