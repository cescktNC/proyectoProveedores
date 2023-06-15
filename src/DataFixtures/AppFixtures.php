<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Proveedores;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $proveedor1 = new Proveedores();
        $proveedor1->setNombre('Hotel Sant Eloi');
        $proveedor1->setEmail('info@hotelsanteloi.com');
        $proveedor1->setTelefono('987125475');
        $proveedor1->setTipo('hotel');
        $proveedor1->setActivo(true);

        $proveedor2 = new Proveedores();
        $proveedor2->setNombre('Estudis Crest Pas');
        $proveedor2->setEmail('info@estudiscrestpas.com');
        $proveedor2->setTelefono('547444112');
        $proveedor2->setTipo('hotel');
        $proveedor2->setActivo(true);

        $proveedor3 = new Proveedores();
        $proveedor3->setNombre('Hotel Antic');
        $proveedor3->setEmail('info@hotelantic.com');
        $proveedor3->setTelefono('452369854');
        $proveedor3->setTipo('hotel');
        $proveedor3->setActivo(true);

        $proveedor4 = new Proveedores();
        $proveedor4->setNombre('Eurostars Andorra');
        $proveedor4->setEmail('info@eurostarsandorra.com');
        $proveedor4->setTelefono('452147774');
        $proveedor4->setTipo('hotel');
        $proveedor4->setActivo(false);

        $proveedor5 = new Proveedores();
        $proveedor5->setNombre('Hotel Andorra Park');
        $proveedor5->setEmail('info@hotelandorrapark.com');
        $proveedor5->setTelefono('121444558');
        $proveedor5->setTipo('hotel');
        $proveedor5->setActivo(false);

        $proveedor6 = new Proveedores();
        $proveedor6->setNombre('Hotel Spa Diana Parc');
        $proveedor6->setEmail('info@hotelspadianaparc.com');
        $proveedor6->setTelefono('987445632');
        $proveedor6->setTipo('hotel');
        $proveedor6->setActivo(true);

        $proveedor7 = new Proveedores();
        $proveedor7->setNombre('Hotel Zènit Diplomàtic');
        $proveedor7->setEmail('info@hotelzenitdiplomatic.com');
        $proveedor7->setTelefono('541222365');
        $proveedor7->setTipo('hotel');
        $proveedor7->setActivo(true);

        $proveedor8 = new Proveedores();
        $proveedor8->setNombre('Hotel Yomo Centric');
        $proveedor8->setEmail('info@hotelyomocentric.com');
        $proveedor8->setTelefono('412111458');
        $proveedor8->setTipo('hotel');
        $proveedor8->setActivo(true);

        $proveedor9 = new Proveedores();
        $proveedor9->setNombre('Grandvalira');
        $proveedor9->setEmail('info@grandvalira.com');
        $proveedor9->setTelefono('474111222');
        $proveedor9->setTipo('pista');
        $proveedor9->setActivo(true);

        $proveedor10 = new Proveedores();
        $proveedor10->setNombre('Baqueria Beret');
        $proveedor10->setEmail('info@baqueiraberet.com');
        $proveedor10->setTelefono('325552147');
        $proveedor10->setTipo('pista');
        $proveedor10->setActivo(true);

        $proveedor11 = new Proveedores();
        $proveedor11->setNombre('Port Ainé');
        $proveedor11->setEmail('info@portaine.com');
        $proveedor11->setTelefono('471120025');
        $proveedor11->setTipo('pista');
        $proveedor11->setActivo(false);

        $proveedor12 = new Proveedores();
        $proveedor12->setNombre('Caldea');
        $proveedor12->setEmail('info@caldea.com');
        $proveedor12->setTelefono('120325011');
        $proveedor12->setTipo('complemento');
        $proveedor12->setActivo(true);

        $proveedor13 = new Proveedores();
        $proveedor13->setNombre('Hotel Avanti');
        $proveedor13->setEmail('info@hotelavanti.com');
        $proveedor13->setTelefono('854012336');
        $proveedor13->setTipo('hotel');
        $proveedor13->setActivo(true);

        $proveedor14 = new Proveedores();
        $proveedor14->setNombre('Acta Arthotel');
        $proveedor14->setEmail('info@actaarthotel.com');
        $proveedor14->setTelefono('987452147');
        $proveedor14->setTipo('hotel');
        $proveedor14->setActivo(true);

        $proveedor15 = new Proveedores();
        $proveedor15->setNombre('Hotel Espel');
        $proveedor15->setEmail('info@hotelespel.com');
        $proveedor15->setTelefono('125478965');
        $proveedor15->setTipo('hotel');
        $proveedor15->setActivo(true);

        $proveedor16 = new Proveedores();
        $proveedor16->setNombre('Hotel Eureka');
        $proveedor16->setEmail('info@hoteleureka.com');
        $proveedor16->setTelefono('125478965');
        $proveedor16->setTipo('hotel');
        $proveedor16->setActivo(true);

        $proveedor17 = new Proveedores();
        $proveedor17->setNombre('Hotel Cims');
        $proveedor17->setEmail('info@hotelcims.com');
        $proveedor17->setTelefono('145214001');
        $proveedor17->setTipo('hotel');
        $proveedor17->setActivo(true);

        $proveedor18 = new Proveedores();
        $proveedor18->setNombre('Spa Siente Boí');
        $proveedor18->setEmail('info@spasienteboi.com');
        $proveedor18->setTelefono('980106781');
        $proveedor18->setTipo('complemento');
        $proveedor18->setActivo(false);

        $proveedor19 = new Proveedores();
        $proveedor19->setNombre('Spa La Collada');
        $proveedor19->setEmail('info@spalacollada.com');
        $proveedor19->setTelefono('780197425');
        $proveedor19->setTipo('complemento');
        $proveedor19->setActivo(true);

        $proveedor20 = new Proveedores();
        $proveedor20->setNombre('Inúu Wellness Attitude');
        $proveedor20->setEmail('info@inuuwellnessattitude.com');
        $proveedor20->setTelefono('471099870');
        $proveedor20->setTipo('complemento');
        $proveedor20->setActivo(true);

        $manager->persist($proveedor1);
        $manager->persist($proveedor2);
        $manager->persist($proveedor3);
        $manager->persist($proveedor4);
        $manager->persist($proveedor5);
        $manager->persist($proveedor6);
        $manager->persist($proveedor7);
        $manager->persist($proveedor8);
        $manager->persist($proveedor9);
        $manager->persist($proveedor10);
        $manager->persist($proveedor11);
        $manager->persist($proveedor12);
        $manager->persist($proveedor13);
        $manager->persist($proveedor14);
        $manager->persist($proveedor15);
        $manager->persist($proveedor16);
        $manager->persist($proveedor17);
        $manager->persist($proveedor18);
        $manager->persist($proveedor19);
        $manager->persist($proveedor20);

        $manager->flush();
    }
}
