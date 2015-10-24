<?php
namespace App\Presenters;

use Nette;
use App\Model;


/**
 *
 * @author Hadik
 */
class ShowPresenter extends BasePresenter
{
	
	/** @var \App\Model\PasteManager */
	private $pasteManager;
	
	public function __construct(\App\Model\PasteManager $pasteManager) {
		parent::__construct();
		$this->pasteManager = $pasteManager;		
	}
	
	
	public function renderDefault($hash = '') {		
		$this->template->pasteData = $this->pasteManager->get($hash);
	}
	
}