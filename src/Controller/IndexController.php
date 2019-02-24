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

        print_r(gettype($websites));

        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'websites' => $websites
        ]);
    }

    /**
     * @Route("/show/{id}", name="show")
     */

    public function show(Websites $websites)
    {
        return $this->render('index/show.html.twig', [
            'websites' => $websites
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */

    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();

        $website = $em->getRepository(Websites::class)->find($id);
        $site = $id;
        $status = $em->getRepository(Status::class)->find($site);

        if (!$website) {
            return $this->redirectToRoute('index');
        }

        $em->remove($website);
        $em->remove($status);
        $em->flush();

        return $this->redirectToRoute('index');
        
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

        $repoWebsite = $this->getDoctrine()->getRepository(Websites::class);

        if ($request->request->count() > 0)
        {
            $websites = new Websites();
            $websites->setUrl($request->request->get('url'));
 
            $sites = $websites->getUrl($request->request->get('url'));

            $status = new Status();

            // print_r(get_headers($sites));

            $header = get_headers($sites);

            $code = substr($header[0], 9, 3);
            $date = substr($header[1], 6, 26);

            $status->setSite($websites)
                   ->setCode($code)
                   ->setDate($date);

            $manager->persist($websites);
            $manager->persist($status);
            $manager->flush();
        }

        return $this->render('index/add.html.twig');
    }

}
