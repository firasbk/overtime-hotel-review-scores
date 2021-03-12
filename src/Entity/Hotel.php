<?php

namespace App\Entity;

use App\Repository\HotelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="hotel")
 * @ORM\Entity(repositoryClass=HotelRepository::class)
 */
class Hotel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private string $name;
    
    public function getId(): ?int
    {
        return $this->id;
    }
    
    function getName(): string {
        return $this->name;
    }

    function setName(string $name): void {
        $this->name = $name;
    }
}
