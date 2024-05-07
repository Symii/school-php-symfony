<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\Product;
use App\Entity\Task;
use App\Form\Type\ProductType;
use App\Form\Type\TaskType;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{

    #[Route('/', name: 'index')]
    public function index()
    {
        return $this->redirectToRoute('product_show', ['id' => 1]);
    }

    #[Route('/show/{id}', name: 'product_show')]
    public function showById(EntityManagerInterface $entityManager, int $id): Response
    {
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        return $this->render('product/show-product.html.twig', ['product' => $product]);
    }

    #[Route('/show', name: 'products_show')]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $productList = $entityManager->getRepository(Product::class)->findAll();

        if (!$productList) {
            throw $this->createNotFoundException(
                'No product found '
            );
        }

        return $this->render('product/show.html.twig', ['productList' => $productList]);
    }

    /*

    #[Route('/product', name: 'create_product')]
    public function createProduct(EntityManagerInterface $entityManager): Response
    {
        $product = new Product();
        $product->setName('Gaming Keyboard');
        $product->setPrice(439.99);
        $product->setDescription('For real gamers!');
        $product->setShortUrl("keyboards/gaming-keyboard");

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$product->getId());
    }
    */

    #[Route('/product', name: 'new_product')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $product = $form->getData();

            // ... perform some action, such as saving the task to the database
    
            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $entityManager->persist($product);
    
            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

            return $this->redirectToRoute('product_success');
        }
      
        return $this->render('product/form.html.twig', ['form' => $form]);
    }

    #[Route('/show', name: 'product_success')]
    public function show2(EntityManagerInterface $entityManager): Response
    {
        $productList = $entityManager->getRepository(Product::class)->findAll();

        if (!$productList) {
            throw $this->createNotFoundException(
                'No product found '
            );
        }

        return $this->render('product/show.html.twig', [
            'productList' => $productList,
             'message' => 'Pomyslnie dodano produkt do bazy danych',
            ]);
    }



}
