<?php

namespace App\State;

use App\Entity\Customer;
use App\Repository\UserRepository;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Symfony\Bundle\SecurityBundle\Security;
use ApiPlatform\Metadata\CollectionOperationInterface;


final class UserProvider implements ProviderInterface
{
    public function __construct(
        private UserRepository $userRepository,
        private Security $security
    ) {
    }
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        /**
         * The Customer logged
         * @var Customer $customer
         */
        $customer = $this->security->getUser();
        //return a user collection of the customer logged
        if ($operation instanceof CollectionOperationInterface) {

            $userCollection = $customer->getUsers();
            return $userCollection;
        }
        // return a user of the customer logged by the uri id
        $user = $this->userRepository->findOneBy([
            'id' => $uriVariables['id'],
            'customer' => $customer
        ]);

        return $user;
    }
}
