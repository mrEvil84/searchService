<?php
declare(strict_types=1);

namespace AppBundle\DTO;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class GitHubContributorDTOCollection
 * @package AppBundle\DTO
 */
class GitHubContributorDTOCollection extends ArrayCollection
{
    /**
     * @var array
     */
    private $contributors;

    /**
     * @param GitHubContributorDTO $contributorDTO
     */
    public function addItem(GitHubContributorDTO $contributorDTO)
    {
        $this->contributors[] = $contributorDTO;
    }

    /**
     * @return array
     */
    public function getIterator()
    {
       return $this->contributors;
    }

    /**
     * @return int
     */
    public function getCount():int
    {
        return count($this->contributors);
    }

}