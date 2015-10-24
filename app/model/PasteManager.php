<?php

namespace App\Model;

use Nette;
use Nette\Utils\Random;

class PasteManager {

	/** @var Nette\Database\Context */
	private $dtb;

	/** @var Nette\Utils\DateTime */
	private $dateTime;

	public function __construct(Nette\Database\Context $dtb, Nette\Utils\DateTime $dateTime) {
		$this->dtb = $dtb;
		$this->dateTime = $dateTime;
	}

	/**
	 * Save past text into database
	 * Return generated hash
	 * @param array $data
	 * @return string
	 */
	public function save($data) {
		$data->hash = Random::generate(6, '0-9a-zA-Z');
		$data->inserted = $this->dateTime->getTimestamp();
		$data->id_user = '';
		$this->dtb->table('pastes')->insert($data);
		return $data->hash;
	}

	public function get($hash) {
		return $this->dtb->table('pastes')->where("hash", $hash)->fetch();
	}

}
