<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Websites;
use App\Repository\WebsitesRepository;
use App\Entity\Status;
use App\Repository\StatusRepository;


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
     * @Route("/show/{id}", name="show")
     */

    public function show(Websites $website)
    {

        return $this->render('index/show.html.twig', [
          'website' => $website


        ]);
    }



    /**
     * @Route("/delete/{id}", name="delete")
     */
/*
    public function delete(Request $request, ObjectManager $manager)
    {

            $websites->remove($id);
            $manager->flush();

        //$websites = $this->getDoctrine()->getRepository(Websites::class)->find($id);
//        $doctrine = $this->getDoctrine()->getManager();
  //      $doctrine->remove($id);
    //    $doctrine->flush();
        return $this->render('index/add.html.twig');

    }

*/
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

        $repoWebsite = $this->getDoctrine()->getRepository(Websites::class);

        if ($request->request->count() > 0)
        {
            $websites = new Websites();
            $websites->setUrl($request->request->get('url'));

            $sites = $websites->getUrl($request->request->get('url'));

            $status = new Status();

            // print_r(get_headers($sites));

            $header = get_headers($sites);

            $yo = substr($header[0], 9, 3);
            $yop = substr($header[1], 6, 26);

            print($yop);

            $status->setSite($websites);

            $manager->persist($websites);
            $manager->persist($status);
            $manager->flush();
        }

        return $this->render('index/add.html.twig');
    }

}
