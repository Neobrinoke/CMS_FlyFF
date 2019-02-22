<?php

namespace App\Model\Resource;

use Illuminate\Support\Collection;

class PropJob
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string|null */
    private $rank;

    /** @var int */
    private $minLvl;

    /** @var int */
    private $maxLvl;

    /** @var string */
    private $imageJob;

    /** @var string|null */
    private $imageLvl;

    /**
     * PropJob constructor.
     * @param int $id
     * @param array $value
     * @throws \Exception
     */
    public function __construct(int $id, array $value)
    {
        if (empty($value)) {
            throw new \Exception('PropJob cannot be empty! Check parameters.');
        }

        $this->setId($id);
        $this->setName($value['name']);
        $this->setRank($value['rank']);
        $this->setMinLvl($value['minLvl']);
        $this->setMaxLvl($value['maxLvl']);
        $this->setImageJob($value['imageJob']);
        $this->setImageLvl($value['imageLvl']);
    }

    /**
     * Retrieve all propJobs.
     *
     * @return Collection
     * @throws \Exception
     */
    public static function all(): Collection
    {
        $propJobs = new Collection();

        foreach (config('resources.jobs') as $key => $value) {
            $propJobs->push(new PropJob($key, $value));
        }

        return $propJobs;
    }

    /**
     * Return instance of PropJob by jobId.
     *
     * @param int $jobId
     * @return PropJob
     * @throws \Exception
     */
    public static function find(int $jobId): PropJob
    {
        $propJobs = self::all();

        /** @var PropJob $propJob */
        foreach ($propJobs as $propJob) {
            if ($propJob->getId() === $jobId) {
                return $propJob;
            }
        }

        throw new \Exception(sprintf("Cannot find PropJob for jobId [%d]! Check resources.jobs file.", $jobId));
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Return name by translation.
     *
     * @return string
     */
    public function getName(): string
    {
        return trans($this->name);
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return null|string
     */
    public function getRank(): ?string
    {
        return $this->rank;
    }

    /**
     * @param null|string $rank
     */
    public function setRank(?string $rank): void
    {
        $this->rank = $rank;
    }

    /**
     * @return int
     */
    public function getMinLvl(): int
    {
        return $this->minLvl;
    }

    /**
     * @param int $minLvl
     */
    public function setMinLvl(int $minLvl): void
    {
        $this->minLvl = $minLvl;
    }

    /**
     * @return int
     */
    public function getMaxLvl(): int
    {
        return $this->maxLvl;
    }

    /**
     * @param int $maxLvl
     */
    public function setMaxLvl(int $maxLvl): void
    {
        $this->maxLvl = $maxLvl;
    }

    /**
     * @return string
     */
    public function getImageJob(): string
    {
        return asset(sprintf($this->imageJob, $this->id));
    }

    /**
     * @param string $imageJob
     */
    public function setImageJob(string $imageJob): void
    {
        $this->imageJob = $imageJob;
    }

    /**
     * @param int|null $masterRank
     * @return null|string
     */
    public function getImageLvl(?int $masterRank): ?string
    {
        return asset(sprintf($this->imageLvl, $masterRank));
    }

    /**
     * @param null|string $imageLvl
     */
    public function setImageLvl(?string $imageLvl): void
    {
        $this->imageLvl = $imageLvl;
    }
}
