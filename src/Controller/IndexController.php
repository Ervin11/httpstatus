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

    public function show(Websites $websites, $id)
    {   
        $site = $id;

        $status = $this->getDoctrine()->getRepository(Status::class)->find($site);
        
        // $websites->getStatuses();
        
        dump($status);

        return $this->render('index/show.html.twig', [
            'websites' => $websites,
            'status' => $status
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */

    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();

        $website = $em->getRepository(Websites::class)->find($id);
        $sites = $id;
        $status = $em->getRepository(Status::class)->find($sites);

        if (!$website) {
            return $this->redirectToRoute('index');
        }

        $em->remove($website);
        $em->remove($status);
        $em->flush();

        return $this->redirectToRoute('index');
        
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */

    public function edit($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $website = $em->getRepository(Websites::class)->find($id);
        $sites = $id;
        $status = $em->getRepository(Status::class)->find($sites);

        if (!$website) {
            return $this->redirectToRoute('index');
        }

        if ($request->request->count() > 0) {

            $website->setUrl($request->request->get('url'));
            $sites = $website->getUrl($request->request->get('url'));

            $test = substr( $sites, 0, 7 ) === "http://";
            $test2 = substr( $sites, 0, 8 ) === "https://";

            if ($test || $test2) {

                $header = get_headers($sites);

            }

            else {

                $header = get_headers("http://".$sites);
            }

            $code = substr($header[0], 9, 3);
            $date = substr($header[1], 6, 26);

            $status->setSite($website)
                   ->setCode($code)
                   ->setDate($date);

            $em->persist($website);
            $em->persist($status);
            $em->flush();

            return $this->redirectToRoute('index');
        }
        

        return $this->render('index/edit.html.twig');
        
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

            $test = substr( $sites, 0, 7 ) === "http://";
            $test2 = substr( $sites, 0, 8 ) === "https://";

            if ($test || $test2) {

                $header = get_headers($sites);

            }

            else {

                $header = get_headers("http://".$sites);
            }

            $code = substr($header[0], 9, 3);
            $date = substr($header[1], 6, 26);
            
            $status->setSite($websites)
                   ->setCode($code)
                   ->setDate($date);

            $manager->persist($websites);
            $manager->persist($status);
            $manager->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('index/add.html.twig');
        
        
    }

}
