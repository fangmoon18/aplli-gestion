<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CandidatRepository")
 */
class Candidat
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
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $NumTel;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $BirthDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Etude;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $StatutPro;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $Inscription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $TypeFinancement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $StatutFinancement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $FraisDossier;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $IdentifiantPO;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $MdpPO;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $EmailConseillePO;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $NomStage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CIRETStage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $AdresseStage;

    /**
     * @ORM\Column(type="string", length=17, nullable=true)
     */
    private $NumTelStage;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Session", inversedBy="candidats")
     */
    private $SessionFait;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Note;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $StatutTestApt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Document", mappedBy="Candidat", orphanRemoval=true)
     */
    private $Documents;

    public function __construct()
    {
        $this->Documents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(?string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getNumTel(): ?string
    {
        return $this->NumTel;
    }

    public function setNumTel(?string $NumTel): self
    {
        $this->NumTel = $NumTel;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->BirthDate;
    }

    public function setBirthDate(?\DateTimeInterface $BirthDate): self
    {
        $this->BirthDate = $BirthDate;

        return $this;
    }

    public function getEtude(): ?string
    {
        return $this->Etude;
    }

    public function setEtude(?string $Etude): self
    {
        $this->Etude = $Etude;

        return $this;
    }

    public function getStatutPro(): ?string
    {
        return $this->StatutPro;
    }

    public function setStatutPro(?string $StatutPro): self
    {
        $this->StatutPro = $StatutPro;

        return $this;
    }

    public function getInscription(): ?\DateTimeInterface
    {
        return $this->Inscription;
    }

    public function setInscription(?\DateTimeInterface $Inscription): self
    {
        $this->Inscription = $Inscription;

        return $this;
    }

    public function getTypeFinancement(): ?string
    {
        return $this->TypeFinancement;
    }

    public function setTypeFinancement(?string $TypeFinancement): self
    {
        $this->TypeFinancement = $TypeFinancement;

        return $this;
    }

    public function getStatutFinancement(): ?string
    {
        return $this->StatutFinancement;
    }

    public function setStatutFinancement(?string $StatutFinancement): self
    {
        $this->StatutFinancement = $StatutFinancement;

        return $this;
    }

    public function getFraisDossier(): ?string
    {
        return $this->FraisDossier;
    }

    public function setFraisDossier(?string $FraisDossier): self
    {
        $this->FraisDossier = $FraisDossier;

        return $this;
    }

    public function getIdentifiantPO(): ?string
    {
        return $this->IdentifiantPO;
    }

    public function setIdentifiantPO(?string $IdentifiantPO): self
    {
        $this->IdentifiantPO = $IdentifiantPO;

        return $this;
    }

    public function getMdpPO(): ?string
    {
        return $this->MdpPO;
    }

    public function setMdpPO(?string $MdpPO): self
    {
        $this->MdpPO = $MdpPO;

        return $this;
    }

    public function getEmailConseillePO(): ?string
    {
        return $this->EmailConseillePO;
    }

    public function setEmailConseillePO(?string $EmailConseillePO): self
    {
        $this->EmailConseillePO = $EmailConseillePO;

        return $this;
    }

    public function getNomStage(): ?string
    {
        return $this->NomStage;
    }

    public function setNomStage(?string $NomStage): self
    {
        $this->NomStage = $NomStage;

        return $this;
    }

    public function getCIRETStage(): ?string
    {
        return $this->CIRETStage;
    }

    public function setCIRETStage(?string $CIRETStage): self
    {
        $this->CIRETStage = $CIRETStage;

        return $this;
    }

    public function getAdresseStage(): ?string
    {
        return $this->AdresseStage;
    }

    public function setAdresseStage(?string $AdresseStage): self
    {
        $this->AdresseStage = $AdresseStage;

        return $this;
    }

    public function getNumTelStage(): ?string
    {
        return $this->NumTelStage;
    }

    public function setNumTelStage(?string $NumTelStage): self
    {
        $this->NumTelStage = $NumTelStage;

        return $this;
    }

    public function getSessionFait(): ?Session
    {
        return $this->SessionFait;
    }

    public function setSessionFait(?Session $SessionFait): self
    {
        $this->SessionFait = $SessionFait;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->Note;
    }

    public function setNote(?string $Note): self
    {
        $this->Note = $Note;

        return $this;
    }

    public function getStatutTestApt(): ?string
    {
        return $this->StatutTestApt;
    }

    public function setStatutTestApt(?string $StatutTestApt): self
    {
        $this->StatutTestApt = $StatutTestApt;

        return $this;
    }

    /**
     * @return Collection|Document[]
     */
    public function getDocuments(): Collection
    {
        return $this->Documents;
    }

    public function addDocument(Document $document): self
    {
        if (!$this->Documents->contains($document)) {
            $this->Documents[] = $document;
            $document->setCandidat($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): self
    {
        if ($this->Documents->contains($document)) {
            $this->Documents->removeElement($document);
            // set the owning side to null (unless already changed)
            if ($document->getCandidat() === $this) {
                $document->setCandidat(null);
            }
        }

        return $this;
    }
}
