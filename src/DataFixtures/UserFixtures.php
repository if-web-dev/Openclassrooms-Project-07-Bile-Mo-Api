<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public const USER_REFERENCE = 'user';

    public function load(ObjectManager $manager): void
    {
        $users = [
            [
                'name' => 'Jhonson',
                'firstname' => 'Dwayne',
                'email' => 'jhonson@gmail.com',
                'phone' => '0102030405'
            ],
            [
                'name' => 'Snipes',
                'firstname' => 'Wesley',
                'email' => 'snipes@gmail.com',
                'phone' => '0908070605'
            ],
            [
                'name' => 'Stalone',
                'firstname' => 'silvester',
                'email' => 'stalone@gmail.com',
                'phone' => '0605040802'
            ],
            [
                'name' => 'Van damme',
                'firstname' => 'Jean Claude',
                'email' => 'vandamn@gmail.com',
                'phone' => '0304080606'
            ],
            [
                'name' => 'Lee',
                'firstname' => 'Bruce',
                'email' => 'lee@gmail.com',
                'phone' => '0305060402'
            ],
            [
                'name' => 'Norris',
                'firstname' => 'Chuck',
                'email' => 'norris@gmail.com',
                'phone' => '0102030807'
            ],
            [
                'name' => 'Statham',
                'firstname' => 'Jason',
                'email' => 'statham@gmail.com',
                'phone' => '0102540807'
            ],
            [
                'name' => 'Willis',
                'firstname' => 'Bruce',
                'email' => 'willis@gmail.com',
                'phone' => '0102032807'

            ],
            [
                'name' => 'Li',
                'firstname' => 'Jet',
                'email' => 'li@gmail.com',
                'phone' => '0130030807'
            ],
            [
                'name' => 'Schwarzenegger',
                'firstname' => 'Arnold',
                'email' => 'scharzenegger@gmail.com',
                'phone' => '0301020406'
            ],
            [
                'name' => 'Murphy',
                'firstname' => 'Eddy',
                'email' => 'Murphy@gmail.com',
                'phone' => '0605040302'
            ],
            [
                'name' => 'Spacey',
                'firstname' => 'Kevin',
                'email' => 'spacey@gmail.com',
                'phone' => '0203005821'
            ],
            [
                'name' => 'Wahlberg',
                'firstname' => 'Mark',
                'email' => 'wahlberg@gmail.com',
                'phone' => '0203005821'
            ],
            [
                'name' => 'Freeman',
                'firstname' => 'Morgan',
                'email' => 'freeman@gmail.com',
                'phone' => '0203005821'
            ],
            [
                'name' => 'Damon',
                'firstname' => 'Matt',
                'email' => 'damon@gmail.com',
                'phone' => '0506040201'
            ],
            [
                'name' => 'Hanks',
                'firstname' => 'Tom',
                'email' => 'Hanks@gmail.com',
                'phone' => '0203005821'
            ],
            [
                'name' => 'Pacino',
                'firstname' => 'Al',
                'email' => 'pacino@gmail.com',
                'phone' => '0206040907'
            ],

        ];

        foreach ($users as $index => $userData) {

            $randNbr = rand(0, 2);
            $customer = $this->getReference(CustomerFixtures::CUSTOMER_REFERENCE . $randNbr);

            $product = (new User())
                ->setName($userData['name'])
                ->setFirstname($userData['firstname'])
                ->setEmail($userData['email'])
                ->setPhone($userData['phone'])
                ->setCreatedAt(new DateTimeImmutable())
                ->setCustomer($customer);

            $manager->persist($product);

            $this->addReference(self::USER_REFERENCE . $index, $product);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CustomerFixtures::class,
            ProductFixtures::class
        ];
    }
}