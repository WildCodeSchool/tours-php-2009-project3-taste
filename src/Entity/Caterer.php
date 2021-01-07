<?php

namespace App\Entity;

use App\Repository\CatererRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CatererRepository::class)
 */
class Caterer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Votre nom ne peux pas être vide")
     * @Assert\Length(max="100", maxMessage="Votre nom ne peut pas dépasser 100 caractères")
     */
    private string $lastname;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Votre prénom ne peux pas être vide")
     * @Assert\Length(max="100", maxMessage="Votre prénom ne peut pas dépasser 100 caractères")
     */
    private string $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Votre ne Email ne peut pas être vide")
     * @Assert\Email(
     *     message="L'addresse mail '{{ value }}' n'est pas valide"
     * )
     */
    private string $email;

    /**
     * @ORM\Column(type="string", length=15)
     * @Assert\NotBlank(message="Numéro de téléphone ne peut pas être vide")
     * @Assert\Length(max="15", maxMessage="Le numéro ne peut pas excéder 15 chiffres")
     */
    private string $number;

    /**
     * @ORM\Column(type="string", length=150)
     * @Assert\NotBlank(message="Votre budget ne peut pas être vide")
     * @Assert\Length (max="150", maxMessage="Votre budget ne peut excèder 150 caractères")
     */
    private string $budget;

    /**
     * @ORM\Column(type="date", length=255)
     * @Assert\Type("\DateTimeInterface")
     */
    private \DateTime $date;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="La localisation ne peut pas être vide")
     * @Assert\Length(max="255", maxMessage="La localisation ne peut pas excéder 255 caractères")
     */
    private string $location;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Le nombre de personnes ne peut pas être vide")
     */
    private string $guests;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min="20", minMessage="La description doit être supérieur à 20 caractères")
     */
    private string $description;

    public function getId(): int
    {
        return $this->id;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getBudget(): string
    {
        return $this->budget;
    }

    public function setBudget(string $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getGuests(): string
    {
        return $this->guests;
    }

    public function setGuests(string $guests): self
    {
        $this->guests = $guests;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
