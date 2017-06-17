<?php
declare(strict_types=1);

namespace AppBundle\Resource;

/**
 * Class GitHubContributorsResource
 * @package AppBundle\Resource
 */
class GitHubContributorResource
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $avatarUrl;

    /**
     * @var integer
     */
    private $contributions;

    public function __construct(string $name, string $avatarUrl, int $contributions)
    {
        $this->name = $name;
        $this->avatarUrl = $avatarUrl;
        $this->contributions = $contributions;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAvatarUrl(): string
    {
        return $this->avatarUrl;
    }

    /**
     * @return int
     */
    public function getContributions(): int
    {
        return $this->contributions;
    }
}