<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\AuditTask;
use App\Entity\Company;
use App\Entity\Audit;
use App\Entity\Observation;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $auditTask1 = new AuditTask();
        $auditTask1->setNameTask("task1");
        $auditTask1->setDescriptionTask("description1");
        $manager->persist($auditTask1);

        $company1 = new Company();
        $company1->setNameCompany("company1");
        $manager->persist($company1);

        $audit1 = new Audit();
        $audit1->setCompany($company1);
        $manager->persist($audit1);

        $observation1 = new Observation();
        $observation1->setDescriptionObservation("description1");
        $observation1->setAudit($audit1);
        $observation1->setTask($auditTask1);
        $manager->persist($observation1);

        $manager->flush();
    }
}
