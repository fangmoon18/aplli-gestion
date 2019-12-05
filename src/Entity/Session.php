<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SessionRepository")
 */
class Session
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Titre;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DebutFormation;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $FinFormation;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DebutExam;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $FinExam;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DebutStage;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $FinStage;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Candidat", mappedBy="SessionFait")
     */
    private $candidats;

    public function __construct()
    {
        $this->candidats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getDebutFormation(): ?\DateTimeInterface
    {
        return $this->DebutFormation;
    }

    public function setDebutFormation(?\DateTimeInterface $DebutFormation): self
    {
        $this->DebutFormation = $DebutFormation;

        return $this;
    }

    public function getFinFormation(): ?\DateTimeInterface
    {
        return $this->FinFormation;
    }

    public function setFinFormation(?\DateTimeInterface $FinFormation): self
    {
        $this->FinFormation = $FinFormation;

        return $this;
    }

    public function getDebutExam(): ?\DateTimeInterface
    {
        return $this->DebutExam;
    }

    public function setDebutExam(?\DateTimeInterface $DebutExam): self
    {
        $this->DebutExam = $DebutExam;

        return $this;
    }

    public function getFinExam(): ?\DateTimeInterface
    {
        return $this->FinExam;
    }

    public function setFinExam(?\DateTimeInterface $FinExam): self
    {
        $this->FinExam = $FinExam;

        return $this;
    }

    public function getDebutStage(): ?\DateTimeInterface
    {
        return $this->DebutStage;
    }

    public function setDebutStage(?\DateTimeInterface $DebutStage): self
    {
        $this->DebutStage = $DebutStage;

        return $this;
    }

    public function getFinStage(): ?\DateTimeInterface
    {
        return $this->FinStage;
    }

    public function setFinStage(?\DateTimeInterface $FinStage): self
    {
        $this->FinStage = $FinStage;

        return $this;
    }

    /**
     * @return Collection|Candidat[]
     */
    public function getCandidats(): Collection
    {
        return $this->candidats;
    }

    public function addCandidat(Candidat $candidat): self
    {
        if (!$this->candidats->contains($candidat)) {
            $this->candidats[] = $candidat;
            $candidat->setSessionFait($this);
        }

        return $this;
    }

    public function removeCandidat(Candidat $candidat): self
    {
        if ($this->candidats->contains($candidat)) {
            $this->candidats->removeElement($candidat);
            // set the owning side to null (unless already changed)
            if ($candidat->getSessionFait() === $this) {
                $candidat->setSessionFait(null);
            }
        }

        return $this;
    }
}
