<?php

namespace App\State;

use App\Entity\Customer;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Symfony\Bundle\SecurityBundle\Security;
use ApiPlatform\Metadata\DeleteOperationInterface;

final class UserProcessor implements ProcessorInterface
{
    public function __construct(
        private ProcessorInterface $persistProcessor,
        private ProcessorInterface $removeProcessor,
        private Security $security
    ) {
    }

    public function process($data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        /**
         * @var Customer $customer
         */
        $customer = $this->security->getUser();
        //delete a user of the customer logged 
        if ($operation instanceof DeleteOperationInterface) {
            if ($customer->getId() !== $data->getCustomer()->getId()) {
                throw new \Exception("This user doesn't exist");
            }

            return $this->removeProcessor->process($data, $operation, $uriVariables, $context);
        }
        //Create a user of the customer logged
        $data->setCustomer($customer);
        $result = $this->persistProcessor->process($data, $operation, $uriVariables, $context);

        return $result;
    }
}
