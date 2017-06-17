<?php
declare(strict_types=1);

namespace AppBundle\DTO;

/**
 * Class GitHubContributor
 * @package AppBundle\DTO
 */
class GitHubContributorDTO
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
     * @var int
     */
    private $contributions;

    /**
     * GitHubContributorDTO constructor.
     * @param string $name
     * @param string $avatarUrl
     * @param $contributions
     */
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
    public function getContributionsCount(): int
    {
        return $this->contributions;
    }

}