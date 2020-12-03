<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PropertyController extends AbstractController {

    /**
     * @var PropertyRepository
     */
    private $repository;

    public function __construct(PropertyRepository $repository,EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }
    /**
     * @Route("/biens",name="property.index")
     * @return Response
     */
    public function index():Response
    {
        /*$property = new Property();
        $property->setTitle('mon premier bien')
                ->setPrice(200000)
                ->setRooms(4)
                ->setBedrooms(3)
                ->setDescription('une petite description')
                ->setSurface(60)
                ->setFloor(4)
                ->setHeat(1)
                ->setCity('Montpellier')
                ->setAddress('15 Boulevard Gambetta')
                ->setPostalCode('34000');
                $em = $this->getDoctrine()->getManager();
                $em->persist($property);
                $em->flush();*/

        //$repository = $this->getDoctrine()->getRepository(Property::class);
        $property = $this->repository->findAllVisible();
        //$property[0]->setSold('false');
        //$this->em->flush();
        dump($property);

        return $this->render('property/index.html.twig',[
            'current_meny' => 'properties'
        ]);
    }
    /**
     * @Route("/biens/{slug}-{id}",name="property.show", requirements={"slug":"[a-z0-9\-]*"})
     */
    public function show($slug,$id){
        $property = $this->repository->find($id);
        if($property->getSlug() !== $slug){
            $this->redirectToRoute('property.show',[
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ],301);
        }
        return $this->render('property/show.html.twig',[
            'current_meny' => 'properties',
            'property' => $property
        ]);

    }
}