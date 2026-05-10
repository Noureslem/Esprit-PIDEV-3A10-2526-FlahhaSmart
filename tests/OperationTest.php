<?php

namespace App\Tests;

use App\Entity\Operation;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class OperationTest extends TestCase
{
    private function getValidator()
    {
        return Validation::createValidatorBuilder()
            ->enableAttributeMapping()
            ->getValidator();
    }

    public function testOperationValideSansErreur(): void
    {
        $operation = new Operation();
        $operation->setIdUser(1);
        $operation->setTypeOperation('Labour');
        $operation->setDateDebut(new \DateTimeImmutable('today'));
        $operation->setDateFin(new \DateTimeImmutable('today'));
        $operation->setStatut('planifie');

        $violations = $this->getValidator()->validate($operation);

        $this->assertCount(0, $violations);
    }

    public function testTypeOperationInvalideSiTropCourt(): void
    {
        $operation = new Operation();
        $operation->setIdUser(1);
        $operation->setTypeOperation('Test');
        $operation->setDateDebut(new \DateTimeImmutable('today'));
        $operation->setDateFin(new \DateTimeImmutable('today'));
        $operation->setStatut('planifie');

        $violations = $this->getValidator()->validate($operation);

        $this->assertGreaterThan(0, $violations->count());
        $this->assertSame('type_operation', $violations[0]->getPropertyPath());
    }

    public function testDateDebutNeDoitPasEtreDansLePasse(): void
    {
        $operation = new Operation();
        $operation->setIdUser(1);
        $operation->setTypeOperation('Labour');
        $operation->setDateDebut(new \DateTimeImmutable('yesterday'));
        $operation->setDateFin(new \DateTimeImmutable('today'));
        $operation->setStatut('planifie');

        $violations = $this->getValidator()->validate($operation);

        $this->assertGreaterThan(0, $violations->count());
        $this->assertSame('date_debut', $violations[0]->getPropertyPath());
    }

    public function testDateFinDoitEtreApresOuEgaleDateDebut(): void
    {
        $operation = new Operation();
        $operation->setIdUser(1);
        $operation->setTypeOperation('Labour');
        $operation->setDateDebut(new \DateTimeImmutable('today'));
        $operation->setDateFin(new \DateTimeImmutable('yesterday'));
        $operation->setStatut('planifie');

        $violations = $this->getValidator()->validate($operation);

        $this->assertGreaterThan(0, $violations->count());
        $this->assertSame('date_fin', $violations[0]->getPropertyPath());
    }
}