<?php

namespace App\Controller;


use App\Entity\Item;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\User;
use App\Repository\ItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cart')]
class CartController extends AbstractController
{
    #[Route('/complete', name: 'app_item_complete_cart', methods: ['POST'])]
    function complete(EntityManagerInterface $entityManager, Request $request): Response
    {
        /**
         * @var ItemRepository $repo
         */
        $repo = $entityManager->getRepository(Item::class);
        $user = $entityManager->getRepository(User::class);
        // get items for request to reduce stock by 1, and get the total amount of money
        $cart = $request->getSession();
        $items = $cart->get('cart', []);
        // Create and save order
        $order = new Order();
        $order->setUserId($this->getUser());

        $total = 0;
        foreach ($items as $item) {
            $repo->reduceStock($item);// create orederItem
            $orderItem = new OrderItem();
            $orderItem->setItem($repo->find($item->getId()))
                ->setPrice($item->getPrice())
                ->setQuantity(1);
            // add orderItem to order
            $order->addOrderItem($orderItem);
            $total += $item->getPrice();
        }
        $order->setTotal($total);

        $entityManager->persist($order);
        $entityManager->flush();
        $request->getSession()->remove('cart');

        return $this->render('order/show.html.twig', [
            'order' => $order,
        ]);
    }

    #[Route('/', name: 'app_item_index_cart', methods: ['GET'])]
    function index(Request $request): Response
    {
        $cart = $request->getSession();
        return $this->render('cart/index.html.twig', [
            'items' => $cart->get('cart', []),
        ]);
    }
}
