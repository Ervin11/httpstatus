<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Websites;
use App\Repository\WebsitesRepository;


class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */

    public function index(WebsitesRepository $repo)
    {   
        $websites = $repo->findAll();

        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'websites' => $websites
        ]);
    }

    /**
     * @Route("/show/12", name="show")
     */

    public function show()
    {
        return $this->render('index/show.html.twig');
    }

    /**
     * @Route("/history", name="history")
     */

    public function history()
    {
        return $this->render('index/history.html.twig');
    }

    /**
     * @Route("/add", name="add")
     */

    public function add(Request $request, ObjectManager $manager)
    {

        if ($request->request->count() > 0)
        {
            $websites = new Websites();
            $websites->setUrl($request->request->get('url'));

            $manager->persist($websites);
            $manager->flush();
        }

        return $this->render('index/add.html.twig');
    }

}
