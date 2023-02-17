<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CustomerFixtures extends Fixture
{
    public const CUSTOMER_REFERENCE = 'customer';
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $customers = [
            [
                'company' => 'sfr',
                'siren' => '123456789',
                'email' => 'sfr@sfr.com',
            ],
            [
                'company' => 'bouygues',
                'siren' => '321654987',
                'email' => 'bouygues@bouygues.com'
            ],
            [
                'company' => 'free',
                'siren' => '987654321',
                'email' => 'free@free.com'
            ]

        ];

        foreach ($customers as $index => $customerData) {

            $customer = (new Customer())
                ->setCompany($customerData['company'])
                ->setSiren($customerData['siren'])
                ->setRoles(['ROLE_USER'])
                ->setEmail($customerData['email'])
                ->setCreatedAt(new DateTimeImmutable());

            $password = $this->hasher->hashPassword($customer, 'password');
            $customer->setPassword($password);
            $manager->persist($customer);

            $this->addReference(self::CUSTOMER_REFERENCE . $index, $customer);
        }

        $manager->flush();
    }
}
