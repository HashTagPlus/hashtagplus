<?php

namespace Entry\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
// use Entry\Model\Entry; // <-- Add this import
use Entry\Entity\Entry;
use Entry\Form\EntryForm; // <-- Add this import
use Doctrine\ORM\EntityManager;

class EntryController extends AbstractActionController {

	public function indexAction() {
		
		//$query = $this->getEntityManager ()->
		//createQuery("SELECT Entry.url, Type.type FROM \Entry\Entity\Entry, \Type\Entity\Type  
		//			WHERE Entry.type = Type.id");
		//$users = $query->getResult();
		//$entityManager = $this->getEntityManager();
		
		//$entityManager
       // -> createQuery('select c.url as entry_url from \Entry\Entity\Entry e JOIN e.type_id type')
        //-> getResult();
		
		//$query = $this->getEntityManager()->createQueryBuilder()
		//->select('u')
		//->from('\Entry\Entity\Entry', 'u')
		//->leftJoin('u.type', 'a')
		//->getQuery();
		//$info = $query->getResult();
		
		
		//$result = $entityManager->createQueryBuilder()
		//->select('e', 't')
		//->from('Entry\Entity\Entry', 'e')
		//->innerJoin('e.type_id', 't', 'WITH', 'e.type_id = t.id')
		//->getQuery()
		//->getResult();
		
		
		//print_r($result); die;
		
		return new ViewModel ( array (
				'entries' => $this->getEntityManager ()->getRepository ( 'Entry\Entity\Entry' )->findAll () 
		) );
	}
	
	
	
	public function addAction() {
		$form = new EntryForm ();
		$form->get ( 'submit' )->setValue ( 'Add' );
		
		$request = $this->getRequest ();
		if ($request->isPost ()) {
			$entry = new Entry ();
			
			$entry->setUrl ( $this->getRequest ()->getPost ( 'url' ) );
			$this->getEntityManager ()->persist ( $entry );
			$this->getEntityManager ()->flush ();
			$newId = $entry->getId ();
			
			return $this->redirect ()->toRoute ( 'entry' );
		}
		return array (
				'form' => $form 
		);
	}
	public function editAction() {
		$id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
		if (! $id) {
			return $this->redirect ()->toRoute ( 'entry', array (
					'action' => 'add' 
			) );
		}
		$entry = $this->getEntityManager ()->find ( '\Entry\Entity\Entry', $id );
		
		$form = new EntryForm ();
		$form->bind ( $entry );
		$form->get ( 'submit' )->setAttribute ( 'value', 'Edit' );
		
		$request = $this->getRequest ();
		if ($request->isPost ()) {
			$entry->setUrl ( $this->getRequest ()->getPost ( 'url' ) );
			$entry->setDescription ( $this->getRequest ()->getPost ( 'description' ) );
			
			$this->getEntityManager ()->persist ( $entry );
			$this->getEntityManager ()->flush ();
			
			return $this->redirect ()->toRoute ( 'entry' );
		}
		
		return array (
				'id' => $id,
				'form' => $form 
		);
	}
	public function deleteAction() {
		$id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
		if (! $id) {
			return $this->redirect ()->toRoute ( 'entry' );
		}
		
		$entry = $this->getEntityManager ()->find ( '\Entry\Entity\Entry', $id );
		
		$request = $this->getRequest ();
		if ($request->isPost ()) {
			$del = $request->getPost('del', 'No');
			if ($del == 'Yes') {
				$this->getEntityManager ()->remove ( $entry );
				$this->getEntityManager ()->flush ();
			}
			// Redirect to list of albums
			return $this->redirect()->toRoute('entry');
		}
		
		return array(
            'id'    => $id,
            'entry' => $entry
        );
	}
	
	/**
	 *
	 * @var Doctrine\ORM\EntityManager
	 */
	protected $em;
	public function getEntityManager() {
		if (null === $this->em) {
			$this->em = $this->getServiceLocator ()->get ( 'doctrine.entitymanager.orm_default' );
		}
		return $this->em;
	}
}
