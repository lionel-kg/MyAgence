<?php 
namespace App\Controller;

use Twig\Environment;
use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @var Environment 
     */
    private $twig;

    public function __construct(Environment $twig){
        $this->twig = $twig;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(PropertyRepository $repository) : Response
    {
        $properties = $repository->findLatest();
       
        return $this->render('pages/home.html.twig', [
            'properties' => $properties,
        ]);
    }

    /**
     * @Route("/biens/images/{id}",name="property.images")
     */
    public function showImage($id,PropertyRepository $repository){
        $property = $repository->find($id);
            $img = stream_get_contents($property->getImage());
           $response = new Response(
            $img, 
            Response::HTTP_OK,
            ['content-type' => 'image']
        ); 
    
        return $this->render("property/image.html.twig",[
            'img' => $response->send(),
        ]);
    }

    
}