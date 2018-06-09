<?php

namespace App\Model\Resource;

use Illuminate\Support\Facades\File;

class PropJob
{
	/** @var string */
	public $name;

	/** @var string|null */
	public $rank;

	/** @var int */
	public $minLvl;

	/** @var int */
	public $maxLvl;

	/** @var string */
	public $imageJob;

	/** @var string|null */
	public $imageLvl;

	public function __construct(array $values = [])
	{
		$this->values = config('resources.jobs');
	}

	public static function getByJob($jobId)
	{
		/** @var PropJob $propJob */
		$propJob = app(PropJob::class);
		return $propJob->values;
	}
}