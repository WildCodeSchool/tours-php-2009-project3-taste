<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="array")
     * @var array[]
     */
    private array $cart = [];

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $hours;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $isValided = null;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private float $priceTotal;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?User $user;


    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array[]
     */
    public function getCart(): array
    {
        return $this->cart;
    }

    /**
     * @param array[] $cart
     * @return $this
     */
    public function setCart(array $cart): self
    {
        $this->cart = $cart;

        return $this;
    }

    public function getHours(): \DateTimeInterface
    {
        return $this->hours;
    }

    public function setHours(\DateTimeInterface $hours): self
    {
        $this->hours = $hours;

        return $this;
    }

    public function getIsValided(): ?bool
    {
        return $this->isValided;
    }

    public function setIsValided(bool $isValided): self
    {
        $this->isValided = $isValided;

        return $this;
    }

    public function getPriceTotal(): float
    {
        return $this->priceTotal;
    }

    public function setPriceTotal(float $priceTotal): self
    {
        $this->priceTotal = $priceTotal;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
