<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentaireRepository")
 */
class Commentaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCommentaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contenueCommtaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommentaire(): ?\DateTimeInterface
    {
        return $this->dateCommentaire;
    }

    public function setDateCommentaire(\DateTimeInterface $dateCommentaire): self
    {
        $this->dateCommentaire = $dateCommentaire;

        return $this;
    }

    public function getContenueCommtaire(): ?string
    {
        return $this->contenueCommtaire;
    }

    public function setContenueCommtaire(string $contenueCommtaire): self
    {
        $this->contenueCommtaire = $contenueCommtaire;

        return $this;
    }
}
