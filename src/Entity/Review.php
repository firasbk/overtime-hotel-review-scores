<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="review")
 * @ORM\Entity(repositoryClass=ReviewRepository::class)
 */
class Review
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @var Hotel
     *
     * @ORM\ManyToOne(targetEntity="Hotel", cascade={"all"})
     */
    private Hotel $hotel;

    /**
     * @var int
     *
     * @ORM\Column(name="score", type="integer")
     */
    private int $score;

    /**
     * @var string|null
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private ?string $comment;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_date", type="datetime")
     */
    private \DateTime $createdDate;
    
    public function getId(): ?int
    {
        return $this->id;
    }
    
    function getHotel(): Hotel {
        return $this->hotel;
    }

    function getScore(): int {
        return $this->score;
    }

    function getComment(): ?string {
        return $this->comment;
    }

    function getCreatedDate(): \DateTime {
        return $this->createdDate;
    }

    function setHotel(Hotel $hotel): void {
        $this->hotel = $hotel;
    }

    function setScore(int $score): void {
        $this->score = $score;
    }

    function setComment(?string $comment): void {
        $this->comment = $comment;
    }

    function setCreatedDate(\DateTime $createdDate): void {
        $this->createdDate = $createdDate;
    }
    
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'hotel' => $this->getHotel(),
            'score' => $this->getScore(),
            'comment' => $this->getComment(),
            'createdDate' => $this->getCreatedDate()            
        ];
    }
}
