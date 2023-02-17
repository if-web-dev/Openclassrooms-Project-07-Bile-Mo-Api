<?php

namespace App\DataFixtures;

use DateTimeImmutable;
use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProductFixtures extends Fixture
{
    public const PRODUCT_REFERENCE = 'product';

    public function load(ObjectManager $manager): void
    {
        $products = [
            [
                'brand' => 'Apple',
                'model' => 'iPhone 14 Pro Max',
                'description' => 'Avec un appareil photo principal de 48 Mpx pour capturer des détails époustouflants. Dynamic Island et l’écran toujours activé, qui offrent une toute nouvelle expérience sur iPhone.',
                'sku' => 'PAPP-16GBI14PRO-BA'
            ],
            [
                'brand' => 'samsung',
                'model' => 'Galaxy Z Fold4',
                'description' => 'Son immense écran pliable vous plonge dans vos contenus préférés et vous fait passer maître du multitâche.',
                'sku' => 'PSAM-8GBZFOLD-BN'
            ],
            [
                'brand' => 'xiaomi',
                'model' => '12T Pro',
                'description' => 'Caméra 200MP ultime. Processeur phare Snapdragon® 8+ Gen 1 Smart HyperCharge 120W Ecran AMOLED CrystalRes 120Hz',
                'sku' => 'PXIA-8GB12T-WN'
            ],
            [
                'brand' => 'Apple',
                'model' => 'iPhone 13',
                'description' => 'Le double appareil photo le plus avancé à ce jour sur iPhone. La puce A15 Bionic, d’une vitesse fulgurante. Une autonomie nettement améliorée. Un design résistant. La 5G ultra-rapide. Et un écran Super Retina XDR plus lumineux.',
                'sku' => 'PAPP-16GBI13-BA'
            ],
            [
                'brand' => 'Samsung',
                'model' => 'Galaxy S23 Ultra',
                'description' => 'Incroyablement puissant, il embarque notre processeur le plus rapide à ce jour, le Qualcomm Snapdragon® 8 Gen 2. Pour un smartphone plus fluide, performant et autonome du matin au soir.',
                'sku' => 'PSAM-16GBS23-WN'

            ],
            [
                'brand' => 'Xiaomi',
                'model' => 'Redmi Note 11 Pro 5G',
                'description' => '108MP de purs détails',
                'sku' => 'PXIA-8GBRED-BN'
            ],
            [
                'brand' => 'Apple',
                'model' => 'iPhone 11',
                'description' => 'Passez à la puissance 11. Tout nouveau double appareil photo avec ultra grand-angle. Mode Nuit et qualité d’image vidéo spectaculaire. Résistance à l’eau et à la poussière.',
                'sku' => 'PAPP-8GBI11-GN'
            ],
            [
                'brand' => 'Samsung',
                'model' => 'Galaxy A53',
                'description' => 'Le Samsung Galaxy A53 est un modèle de milieu de gamme équipé d\'un écran Super AMOLED de 6.5 pouces avec un taux de rafraîchissement de 120 Hz, animé par un SoC Samsung Exynos 1280 (compatible 5G), couplé à 6 Go de RAM et 128 Go de stockage.',
                'sku' => 'PSAM-8GBA53-GN'
            ],
            [
                'brand' => 'Xiaomi',
                'model' => 'Redmi 10A',
                'description' => 'Un téléphone tres simple au fonctions basiques satisfaisantes',
                'sku' => 'PXIA-8GBRED10A-BA'
            ]

        ];

        foreach ($products as $index => $productData) {

            $product = (new Product())
                ->setBrand($productData['brand'])
                ->setModel($productData['model'])
                ->setDescription($productData['description'])
                ->setSku($productData['sku'])
                ->setCreatedAt(new DateTimeImmutable());

            $manager->persist($product);

            $this->addReference(self::PRODUCT_REFERENCE . $index, $product);
        }

        $manager->flush();
    }
}
