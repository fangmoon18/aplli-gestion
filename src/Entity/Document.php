<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DocumentRepository")
 */
class Document
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Veuillez upload des fichiers .pdf uniquement.")
     * @Assert\File(mimeTypes={ "application/pdf" })
     */
    private $Fichier;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Candidat", inversedBy="Documents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Candidat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFichier()
    {
        return $this->Fichier;
    }

    public function setFichier($Fichier)
    {
        $this->Fichier = $Fichier;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(?string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getCandidat(): ?Candidat
    {
        return $this->Candidat;
    }

    public function setCandidat(?Candidat $Candidat): self
    {
        $this->Candidat = $Candidat;

        return $this;
    }
}
