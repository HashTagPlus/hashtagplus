<?php
namespace Entry\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Entry\Model\Entry;          // <-- Add this import
use Entry\Form\EntryForm;       // <-- Add this import


class EntryController extends AbstractActionController
{
	protected $entryTable;
	
	public function getEntryTable()
    {
        if (!$this->entryTable) {
            $sm = $this->getServiceLocator();
            $this->entryTable = $sm->get('Entry\Model\EntryTable');
        }
        return $this->entryTable;
    }

    public function indexAction()
    {
    	return new ViewModel(array(
            'entryes' => $this->getEntryTable()->fetchAll(),
        ));
    }

        public function addAction()
    {
        $form = new EntryForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $entry = new Entry();
            $form->setInputFilter($entry->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $entry->exchangeArray($form->getData());
                $this->getEntryTable()->saveEntry($entry);

                // Redirect to list of albums
                return $this->redirect()->toRoute('entry');
            }
        }
        return array('form' => $form);
    }


    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('entry', array(
                'action' => 'add'
            ));
        }

        // Get the Album with the specified id.  An exception is thrown
        // if it cannot be found, in which case go to the index page.
        try {
            $entry = $this->getEntryTable()->getEntry($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('entry', array(
                'action' => 'index'
            ));
        }

        $form  = new EntryForm();
        $form->bind($entry);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($entry->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getEntryTable()->saveEntry($form->getData());

                // Redirect to list of entries
                return $this->redirect()->toRoute('entry');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('entry');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getEntryTable()->deleteEntry($id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('entry');
        }

        return array(
            'id'    => $id,
            'entry' => $this->getEntryTable()->getEntry($id)
        );
    }

}
