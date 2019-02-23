<?php

namespace App\Entity;

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
    private $historyStatus;

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

    public function getHistoryStatus(): ?string
    {
        return $this->historyStatus;
    }

    public function setHistoryStatus(?string $historyStatus): self
    {
        $this->historyStatus = $historyStatus;

        return $this;
    }
}
