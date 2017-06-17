<?php

namespace AppBundle\Controller;

use AppBundle\Form\GitHubSearchType;
use AppBundle\Query\GitHubSearchContributorsQuery;
use AppBundle\Service\GithubSearch;
use AppBundle\Service\GitHubSearchService;
use AppBundle\Service\SearchService;
use AppBundle\Validator\GitHubSearchFormValidator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    const DEFAULT_TEMPLATE = 'default/index.html.twig';
    const HISTORY_TEMPLATE = 'default/searchHistory.html.twig';

    /**
     * @Route("/", name="homepage")
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        try{
            $form = $this->createForm(GitHubSearchType::class);
            $form->handleRequest($request);

            $formValidator = new GitHubSearchFormValidator($form);
            $form = $formValidator->validate();

            if ($form->isSubmitted() && $form->isValid()) {
                $formData = $form->getData();
                $query = new GitHubSearchContributorsQuery(
                    $formData[GitHubSearchType::REPOSITORY_NAME],
                    $formData[GitHubSearchType::SORT_BY],
                    $formData[GitHubSearchType::SORT_ORDER]
                );

                return $this->render(self::DEFAULT_TEMPLATE, [
                    'form' => $form->createView(),
                    'search' => $this->getSearchService()->search($query),
                    'query' => 'yes'
                ]);
            }

            return $this->render(self::DEFAULT_TEMPLATE, [
                'form' => $form->createView(),
                'search' => [],
                'query' => 'no'
            ]);
        } catch (\Exception $e) {

            return $this->render(self::DEFAULT_TEMPLATE, [
                'form' => $form->createView(),
                'search' => [],
                'query' => 'yes'
            ]);
        }
    }

    /**
     * @Route("/history", name="history")
     * @return Response
     */
    public function searchHistoryAction()
    {
        return $this->render(self::HISTORY_TEMPLATE, [
            'searchHistory' => $this->getSearchService()->getDbSearchHistory()
        ]);
    }

    /**
     * @return SearchService|object
     */
    private function getSearchService()
    {
        return $this->get('search_service');
    }

}
