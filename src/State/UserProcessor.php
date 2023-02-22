<?php

namespace App\State;

use App\Entity\User;
use ApiPlatform\Metadata\Operation;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\State\ProcessorInterface;
use Symfony\Bundle\SecurityBundle\Security;
use ApiPlatform\Metadata\DeleteOperationInterface;

final class UserProcessor implements ProcessorInterface
{
    public function __construct(
        private ProcessorInterface $persistProcessor,
        private ProcessorInterface $removeProcessor,
        private EntityManagerInterface $em,
        private Security $security
    ) {
    }

    public function process($data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        /**
         * @var User $user
         */
        $user = $this->security->getUser();

        if ($operation instanceof DeleteOperationInterface) {
            if ($user->getId() !== $data->getCustomer()->getId()) {
                throw new \Exception("This user doesn't exist");
            }

            return $this->removeProcessor->process($data, $operation, $uriVariables, $context);
        }

        $data->setCustomer($user);
        $this->em->persist($data);
        $this->em->flush();
        $result = $this->persistProcessor->process($data, $operation, $uriVariables, $context);
        return $result;
    }
}
