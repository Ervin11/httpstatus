<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WebsitesRepository")
 */
class Websites
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $url;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $deleteUrl;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $statusUrl;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $historyUrl;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Status", mappedBy="site")
     */
    private $statuses;

    public function __construct()
    {
        $this->statuses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getDeleteUrl(): ?string
    {
        return $this->deleteUrl;
    }

    public function setDeleteUrl(?string $deleteUrl): self
    {
        $this->deleteUrl = $deleteUrl;

        return $this;
    }

    public function getStatusUrl(): ?string
    {
        return $this->statusUrl;
    }

    public function setStatusUrl(?string $statusUrl): self
    {
        $this->statusUrl = $statusUrl;

        return $this;
    }

    public function getHistoryUrl(): ?string
    {
        return $this->historyUrl;
    }

    public function setHistoryUrl(?string $historyUrl): self
    {
        $this->historyUrl = $historyUrl;

        return $this;
    }

    /**
     * @return Collection|Status[]
     */
    public function getStatuses(): Collection
    {
        return $this->statuses;
    }

    public function addStatus(Status $status): self
    {
        if (!$this->statuses->contains($status)) {
            $this->statuses[] = $status;
            $status->setSite($this);
        }

        return $this;
    }

    public function removeStatus(Status $status): self
    {
        if ($this->statuses->contains($status)) {
            $this->statuses->removeElement($status);
            // set the owning side to null (unless already changed)
            if ($status->getSite() === $this) {
                $status->setSite(null);
            }
        }

        return $this;
    }
}
