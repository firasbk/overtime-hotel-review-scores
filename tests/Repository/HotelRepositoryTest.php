<?php
namespace App\Tests\Repository;

use App\Entity\Hotel;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class HotelRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testSearchByName()
    {
        $hotel = $this->entityManager
            ->getRepository(Hotel::class)
            ->findOneById(12)  //check the actual id in database
        ;

        $this->assertSame('Larry Hartmann', $hotel->getName());
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}