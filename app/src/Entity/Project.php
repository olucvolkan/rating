<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Client;
use App\Entity\Vico;
/**
 * Project
 *
 * @ORM\Table(name="project", indexes={@ORM\Index(name="IDX_2FB3D0EE19F89217", columns={"vico_id"}), @ORM\Index(name="creator_idx", columns={"creator_id"}), @ORM\Index(name="created_idx", columns={"created"})})
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var Vico
     *
     * @ORM\ManyToOne(targetEntity="Vico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vico_id", referencedColumnName="id")
     * })
     */
    private $vico;

    /**
     * @var Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="creator_id", referencedColumnName="id")
     * })
     */
    private $creator;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Project
     */
    public function setId(int $id): Project
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     * @return Project
     */
    public function setCreated(\DateTime $created): Project
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Project
     */
    public function setTitle(string $title): Project
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return \App\Entity\Vico
     */
    public function getVico(): \App\Entity\Vico
    {
        return $this->vico;
    }

    /**
     * @param \App\Entity\Vico $vico
     * @return Project
     */
    public function setVico(\App\Entity\Vico $vico): Project
    {
        $this->vico = $vico;
        return $this;
    }

    /**
     * @return \App\Entity\Client
     */
    public function getCreator(): \App\Entity\Client
    {
        return $this->creator;
    }

    /**
     * @param \App\Entity\Client $creator
     * @return Project
     */
    public function setCreator(\App\Entity\Client $creator): Project
    {
        $this->creator = $creator;
        return $this;
    }

}
