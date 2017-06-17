<?php
declare(strict_types=1);

namespace AppBundle\Resource;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class GitHubContributorsResourceCollection
 * @package AppBundle\Resource
 */
class GitHubContributorResourceCollection extends ArrayCollection
{
    /**
     * @var array
     */
    private $contributorCollection;

    /**
     * @param GitHubContributorResource $contributorResource
     */
    public function addItem(GitHubContributorResource $contributorResource)
    {
        $this->contributorCollection[] = $contributorResource;
    }

    /**
     * @return array
     */
    public function getIterator():array
    {
        return $this->contributorCollection;
    }

}