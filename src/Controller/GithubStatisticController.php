<?php

declare(strict_types=1);

namespace App\Controller;

use App\DataProvider\Github\DataProvider;
use App\Exception\LocalizedException;
use App\Service\RepositoriesComparator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route(path: '/github/stats')]
final class GithubStatisticController extends AbstractController
{
    public function __construct(
        private DataProvider $repositoryDataProvider,
        private RepositoriesComparator $comparator,
        private SerializerInterface $serializer
    ) {
    }

    #[Route('/compare', name: 'github_stats_compare_repos', methods: [Request::METHOD_POST])]
    public function compare(Request $request): JsonResponse
    {
        try {
            $repositoryRefs = $request->get('repository');
            $repositories = [];
            foreach ($repositoryRefs as $repositoryRef) {
                $repository = $this->repositoryDataProvider->getData($repositoryRef);
                $repositories[$repository->getName()] = $repository;
            }

            return new JsonResponse(
                $this->serializer->serialize(
                    array_merge($repositories, ['comparison' => $this->comparator->calculateBaseStatisticsForRepositories($repositories)]),
                    'json'
                )
            );
        } catch (LocalizedException $exception) {
            return new JsonResponse($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        } catch (ClientException $exception) {
            return new JsonResponse($exception->getMessage(), Response::HTTP_NOT_FOUND);
        } catch (\Throwable $exception) {
            return new JsonResponse('Unexpected error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
