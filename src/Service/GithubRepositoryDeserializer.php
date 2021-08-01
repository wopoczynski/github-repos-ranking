<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\GithubRepository;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

final class GithubRepositoryDeserializer
{
    public function deserialize(string $data): GithubRepository
    {
        $normalizer = new GetSetMethodNormalizer(null, new CamelCaseToSnakeCaseNameConverter(), new ReflectionExtractor());
        $serializer = new Serializer([new DateTimeNormalizer(), $normalizer], [new JsonEncoder()]);

        return $serializer->deserialize(
            $data,
            GithubRepository::class,
            'json',
            [AbstractNormalizer::ALLOW_EXTRA_ATTRIBUTES => true]
        );
    }
}
