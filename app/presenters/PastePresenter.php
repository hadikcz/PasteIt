<?php
namespace App\Presenters;

use Nette;


/**
 *
 * @author Hadik
 */
class PastePresenter extends BasePresenter
{
	
	/** @var \App\Model\PasteManager */
	private $pasteManager;
	
	public function __construct(\App\Model\PasteManager $pasteManager) {
		parent::__construct();
		$this->pasteManager = $pasteManager;		
	}	

    protected function createComponentPasteItForm() {
        $form = new Nette\Application\UI\Form;

        $form->addText("id_type", "Typ:");
		
		$form->addTextArea("text", "Text:")
				->setRequired();

        $form->addSubmit("send", "PasteIt !");

        $form->onSuccess[] = $this->pasteItFormSucceeded;
        return $form;
    }

    public function pasteItFormSucceeded($form) {
		$hash = $this->pasteManager->save($form->values);
        $this->redirect('Show:default', $hash);
        
    }
	
}