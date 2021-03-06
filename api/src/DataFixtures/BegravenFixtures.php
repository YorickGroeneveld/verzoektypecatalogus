<?php

namespace App\DataFixtures;

use App\Entity\Property;
use App\Entity\RequestType;
use App\Entity\Task;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class BegravenFixtures extends Fixture
{
    private $commonGroundService;
    private $params;

    public function __construct(CommonGroundService $commonGroundService, ParameterBagInterface $params)
    {
        $this->commonGroundService = $commonGroundService;
        $this->params = $params;
    }

    public function load(ObjectManager $manager)
    {
        if (
            $this->params->get('app_domain') != "begraven.zaakonline.nl" && strpos($this->params->get('app_domain'), "begraven.zaakonline.nl") == false &&
            $this->params->get('app_domain') != "westfriesland.commonground.nu" && strpos($this->params->get('app_domain'), "westfriesland.commonground.nu") == false
        ) {
            return false;
        }

        /*
         *  Begraven
         */

        $id = Uuid::fromString('c2e9824e-2566-460f-ab4c-905f20cddb6c');
        $requestType = new RequestType();
        $requestType->setOrganization('https://wrc.begraven.zaakonline.nl/organizations/d736013f-ad6d-4885-b816-ce72ac3e1384');
        $requestType->setIcon('fa fa-headstone');
        $requestType->setName('Begravenisplanner');
        $requestType->setDescription('Met dit verzoek kunt u een begrafenis plannen');
        $manager->persist($requestType);
        $requestType->setId($id);
        $manager->persist($requestType);
        $manager->flush();
        $requestType = $manager->getRepository('App:RequestType')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('72fdd281-c60d-4e2d-8b7d-d266303bdc46');
        $property = new Property();
        $property->setTitle('Gemeente');
        $property->setIcon('fa fa-headstone');
        $property->setType('string');
        $property->setFormat('string');
        $property->setIri('wrc/organizations');
        $property->setRequired(true);
        $property->setRequestType($requestType);
        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('bdae2f7b-21c3-4d88-be6d-a35b31c13916');
        $property = new Property();
        $property->setTitle('Begraafplaats');
        $property->setType('string');
        $property->setFormat('string');
        $property->setIri('grc/cemetery');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('3b6a637d-19c6-4730-b322-c03d0d8301b6');
        $property = new Property();
        $property->setTitle('Soort graf');
        $property->setIri('pdc/offer');
        $property->setType('string');
        $property->setFormat('string');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('b1fd7b38-384b-47ec-a0f2-6f81949cdece');
        $property = new Property();
        $property->setTitle('Event');
        $property->setType('string');
        $property->setFormat('string');
        $property->setIri('arc/event');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('8f9adb13-d5e0-40de-a08c-a2ce5a648b1e');
        $property = new Property();
        $property->setTitle('Artikelen');
        $property->setIri('pdc/offer');
        $property->setType('array');
        $property->setFormat('string');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('2631df9f-abca-4f26-bcad-a56d8ec5c856');
        $property = new Property();
        $property->setTitle('Gemeente');
        $property->setType('string');
        $property->setFormat('string');
        $property->setIri('wrc/organizations');
        $property->setRequired(false);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('24d3e05d-26c2-4adb-acd4-08bde88b4526');
        $property = new Property();
        $property->setTitle('Belanghebbende');
        $property->setType('string');
        $property->setFormat('string');
        $property->setIri('irc/assent');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('db69ce35-4ae1-4aac-936f-bdb5d4d1ff18');
        $property = new Property();
        $property->setTitle('Overledene');
        $property->setType('string');
        $property->setFormat('string');
        $property->setIri('brp/ingeschrevenpersoon');
        $property->setRequired(true);
        $property->setRequestType($requestType);

        $manager->persist($property);
        $property->setId($id);
        $manager->persist($property);
        $manager->flush();
        $property = $manager->getRepository('App:Property')->findOneBy(['id'=> $id]);

        // Bijbehorende taken die in de queu worden gezet
        $task = new Task();
        $task->setRequestType($requestType);
        $task->setName('Aaanmaken zaak');
        $task->setDescription('Deze task maakt bij het creaëren van een begravenis meteen een zaak aan');
        $task->setCode('start_zaak_begraven');
        $task->setEndpoint('trouwservice');
        $task->setType('POST');
        $task->setEvent('create');
        $task->setTimeInterval('P0D'); // We zetten een vertraging van nul minuten zodat de taka meteen wordt uitgevoerd

        $manager->persist($task);
    }
}
