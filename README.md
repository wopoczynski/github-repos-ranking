[![CI](https://github.com/wopoczynski/github-repos-ranking/actions/workflows/php.yml/badge.svg)](https://github.com/wopoczynski/github-repos-ranking/actions/workflows/php.yml)

# Github repos ranking

## Simple project - fun with github api using symfony 5.3.x

### run project by

``docker-compose up -d --build``

also be sure if someone wants to copy the dockerfiles to remove xdebug from prod containers :)

### build backend (fetch vendors, warmup cache etc) command

``docker-compose exec php-fpm bash composer install``

### usage

If build succeed and no errors has been thrown - we should be able to use api at
https://localhost:8001/github/stats/compare

### example

you can input as many VALID repositories (full urlls or just repo names)

```CURL
curl --location --request POST 'https://localhost:8001/github/stats/compare' \
--header 'Content-Type: application/json' \
--form 'repository[0]="https://github.com/{repository}"' \
--form 'repository[1]="{repository_2}"' \
```

will return basic stats for each repos such as:

* name
* url
* description
* isFork
* createdAt
* updatedAt
* pushedAt
* size
* stargazersCount
* watchersCount
* forksCount
* openIssuesCount
* networkCount
* subscribersCount
* defaultBranch
* latestRelease
* openPullRequests
* closedPullRequests

as well as result in comparison between them (stars, forks, networkCount, subscribersCount, watchersCount)
i.e.:

* comparison
    * stars [...name => amount]
    * forks [...name => amount]
    * networkCount [...name => amount]
    * subscribersCount [...name => amount]
    * watchersCount [...name => amount]
    * openPullRequests [...name => amount]
    * closedPullRequests [...name => amount]

each ordered from top to lowest

### example

```CURL
curl --location --request POST 'https://localhost:8001/github/stats/compare' \
--header 'Content-Type: application/json' \
--form 'repository[0]="https://github.com/symfony/symfony"' \
--form 'repository[1]="https://github.com/laravel/laravel/"' \
--form 'repository[2]="api-platform/api-platform"' \
--form 'repository[3]="zendframework/zendframework/"'
```

will return

```json
{
  "symfony": {
    "name": "symfony",
    "url": "https:\/\/api.github.com\/repos\/symfony\/symfony",
    "description": "The Symfony PHP framework",
    "createdAt": "2010-01-04T14:21:21+00:00",
    "updatedAt": "2021-08-01T15:19:55+00:00",
    "pushedAt": "2021-08-01T15:31:19+00:00",
    "latestRelease": "no-tag-released",
    "size": 200863,
    "stargazersCount": 25603,
    "watchersCount": 25603,
    "forksCount": 8224,
    "openIssuesCount": 796,
    "networkCount": 8224,
    "subscribersCount": 1217,
    "defaultBranch": "5.4",
    "openPullRequests": 191,
    "closedPullRequests": 25594
  },
  "laravel": {
    "name": "laravel",
    "url": "https:\/\/api.github.com\/repos\/laravel\/laravel",
    "description": "A PHP framework for web artisans.",
    "createdAt": "2011-06-08T03:06:08+00:00",
    "updatedAt": "2021-08-01T13:48:12+00:00",
    "pushedAt": "2021-07-31T22:01:25+00:00",
    "latestRelease": "no-tag-released",
    "size": 10222,
    "stargazersCount": 66081,
    "watchersCount": 66081,
    "forksCount": 21271,
    "openIssuesCount": 30,
    "networkCount": 21271,
    "subscribersCount": 4679,
    "defaultBranch": "8.x",
    "openPullRequests": 0,
    "closedPullRequests": 3912
  },
  "api-platform": {
    "name": "api-platform",
    "url": "https:\/\/api.github.com\/repos\/api-platform\/api-platform",
    "description": "Create REST and GraphQL APIs, scaffold Jamstack webapps, stream changes in real-time.",
    "createdAt": "2015-03-06T21:46:05+00:00",
    "updatedAt": "2021-08-01T01:17:26+00:00",
    "pushedAt": "2021-07-08T15:05:36+00:00",
    "latestRelease": "no-tag-released",
    "size": 5450,
    "stargazersCount": 6831,
    "watchersCount": 6831,
    "forksCount": 787,
    "openIssuesCount": 402,
    "networkCount": 787,
    "subscribersCount": 221,
    "defaultBranch": "main",
    "openPullRequests": 5,
    "closedPullRequests": 355
  },
  "zendframework": {
    "name": "zendframework",
    "url": "https:\/\/api.github.com\/repos\/zendframework\/zendframework",
    "description": "Official Zend Framework repository",
    "createdAt": "2010-06-04T02:42:05+00:00",
    "updatedAt": "2021-07-27T00:50:53+00:00",
    "pushedAt": "2019-05-22T18:35:44+00:00",
    "latestRelease": "no-tag-released",
    "size": 98962,
    "stargazersCount": 5655,
    "watchersCount": 5655,
    "forksCount": 2716,
    "openIssuesCount": 19,
    "networkCount": 2716,
    "subscribersCount": 535,
    "defaultBranch": "master",
    "openPullRequests": 0,
    "closedPullRequests": 5524
  },
  "comparison": {
    "stars": {
      "laravel": 66081,
      "symfony": 25603,
      "api-platform": 6831,
      "zendframework": 5655
    },
    "forks": {
      "laravel": 21271,
      "symfony": 8224,
      "zendframework": 2716,
      "api-platform": 787
    },
    "networkCount": {
      "laravel": 21271,
      "symfony": 8224,
      "zendframework": 2716,
      "api-platform": 787
    },
    "subscribersCount": {
      "laravel": 4679,
      "symfony": 1217,
      "zendframework": 535,
      "api-platform": 221
    },
    "watchersCount": {
      "laravel": 66081,
      "symfony": 25603,
      "api-platform": 6831,
      "zendframework": 5655
    },
    "openPullRequests": {
      "symfony": 191,
      "api-platform": 5,
      "laravel": 0,
      "zendframework": 0
    },
    "closedPullRequests": {
      "symfony": 25594,
      "zendframework": 5524,
      "laravel": 3912,
      "api-platform": 355
    }
  }
}
```
