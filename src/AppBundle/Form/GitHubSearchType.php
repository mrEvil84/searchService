<?php
declare(strict_types=1);

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class GitHubSearch
 * @package AppBundle\Form
 */
class GitHubSearchType extends AbstractType
{
    const REPOSITORY_NAME = 'RepositoryName';
    const SORT_BY = 'SortBy';
    const SORT_ORDER = 'SortOrder';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(self::REPOSITORY_NAME, null, ['label'=> 'Search for repository name: '])
            ->add(self::SORT_BY, ChoiceType::class, ['choices'=>[
                'Sort by login' => GitHubSearchSort::SORT_BY_LOGIN,
                'Sort by contributors' => GitHubSearchSort::SORT_BY_CONTRIBUTORS
            ],
                'label' => 'Sort by name: '
            ])
            ->add(self::SORT_ORDER, ChoiceType::class, ['choices'=>[
                'ASC' => GitHubSearchSort::SORT_ORDER_ASC,
                'DESC' => GitHubSearchSort::SORT_ORDER_DESC
            ],
                'label'=> 'Sort order: '
            ])
            ->add('Search for contributors', SubmitType::class)
        ;
    }

}