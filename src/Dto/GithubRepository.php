<?php

declare(strict_types=1);

namespace App\Dto;

final class GithubRepository
{
    private string $name;
    private string $url;
    private string $description;
    private \DateTimeInterface $createdAt;
    private \DateTimeInterface $updatedAt;
    private \DateTimeInterface $pushedAt;
    private string $latestRelease;
    private int $size;
    private int $stargazersCount;
    private int $watchersCount;
    private int $forksCount;
    private int $openIssuesCount;
    private int $networkCount;
    private int $subscribersCount;
    private string $defaultBranch;
    private int $openPullRequests;
    private int $closedPullRequests;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getPushedAt(): \DateTimeInterface
    {
        return $this->pushedAt;
    }

    public function setPushedAt(\DateTimeInterface $pushedAt): self
    {
        $this->pushedAt = $pushedAt;

        return $this;
    }

    public function getLatestRelease(): string
    {
        return $this->latestRelease;
    }

    public function setLatestRelease(string $latestRelease): self
    {
        $this->latestRelease = $latestRelease;

        return $this;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getStargazersCount(): int
    {
        return $this->stargazersCount;
    }

    public function setStargazersCount(int $stargazersCount): self
    {
        $this->stargazersCount = $stargazersCount;

        return $this;
    }

    public function getWatchersCount(): int
    {
        return $this->watchersCount;
    }

    public function setWatchersCount(int $watchersCount): self
    {
        $this->watchersCount = $watchersCount;

        return $this;
    }

    public function getForksCount(): int
    {
        return $this->forksCount;
    }

    public function setForksCount(int $forksCount): self
    {
        $this->forksCount = $forksCount;

        return $this;
    }

    public function getOpenIssuesCount(): int
    {
        return $this->openIssuesCount;
    }

    public function setOpenIssuesCount(int $openIssuesCount): self
    {
        $this->openIssuesCount = $openIssuesCount;

        return $this;
    }

    public function getNetworkCount(): int
    {
        return $this->networkCount;
    }

    public function setNetworkCount(int $networkCount): self
    {
        $this->networkCount = $networkCount;

        return $this;
    }

    public function getSubscribersCount(): int
    {
        return $this->subscribersCount;
    }

    public function setSubscribersCount(int $subscribersCount): self
    {
        $this->subscribersCount = $subscribersCount;

        return $this;
    }

    public function getDefaultBranch(): string
    {
        return $this->defaultBranch;
    }

    public function setDefaultBranch(string $defaultBranch): self
    {
        $this->defaultBranch = $defaultBranch;

        return $this;
    }

    public function getOpenPullRequests(): int
    {
        return $this->openPullRequests;
    }

    public function setOpenPullRequests(int $openPullRequests): self
    {
        $this->openPullRequests = $openPullRequests;

        return $this;
    }

    public function getClosedPullRequests(): int
    {
        return $this->closedPullRequests;
    }

    public function setClosedPullRequests(int $closedPullRequests): self
    {
        $this->closedPullRequests = $closedPullRequests;

        return $this;
    }
}
