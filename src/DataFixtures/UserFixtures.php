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
                'email' => 'jhonson@gmail.com'
            ],
            [
                'name' => 'Snipes',
                'firstname' => 'Wesley',
                'email' => 'snipes@gmail.com'
            ],
            [
                'name' => 'Stalone',
                'firstname' => 'silvester',
                'email' => 'stalone@gmail.com'
            ],
            [
                'name' => 'Van damme',
                'firstname' => 'Jean Claude',
                'email' => 'vandamn@gmail.com'
            ],
            [
                'name' => 'Lee',
                'firstname' => 'Bruce',
                'email' => 'lee@gmail.com'
            ],
            [
                'name' => 'Norris',
                'firstname' => 'Chuck',
                'email' => 'norris@gmail.com'
            ],
            [
                'name' => 'Statham',
                'firstname' => 'Jason',
                'email' => 'statham@gmail.com'
            ],
            [
                'name' => 'Willis',
                'firstname' => 'Bruce',
                'email' => 'willis@gmail.com'
            ],
            [
                'name' => 'Li',
                'firstname' => 'Jet',
                'email' => 'li@gmail.com'
            ],
            [
                'name' => 'Schwarzenegger',
                'firstname' => 'Arnold',
                'email' => 'scharzenegger@gmail.com'
            ],
            [
                'name' => 'Freeman',
                'firstname' => 'Morgan',
                'email' => 'freeman@gmail.com'
            ],
            [
                'name' => 'Spacey',
                'firstname' => 'Kevin',
                'email' => 'spacey@gmail.com'
            ],
            [
                'name' => 'Wahlberg',
                'firstname' => 'Mark',
                'email' => 'wahlberg@gmail.com'
            ],
            [
                'name' => 'Diesel',
                'firstname' => 'Vin',
                'email' => 'diesel@gmail.com'
            ],
            [
                'name' => 'Damon',
                'firstname' => 'Matt',
                'email' => 'damon@gmail.com'
            ],
            [
                'name' => 'Hanks',
                'firstname' => 'Tom',
                'email' => 'hanks@gmail.com'
            ],
            [
                'name' => 'Pacino',
                'firstname' => 'Al',
                'email' => 'pacino@gmail.com'
            ],

        ];

        foreach ($users as $index => $userData) {

            $randNbr = rand(0, 2);
            $customer = $this->getReference(CustomerFixtures::CUSTOMER_REFERENCE . $randNbr);

            $product = (new User())
                ->setName($userData['name'])
                ->setFirstname($userData['firstname'])
                ->setEmail($userData['email'])
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
            ProductFixtures::class,
        ];
    }
}
