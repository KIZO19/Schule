<?php
// app/controllers/AdminController.php

class AdminController extends Controller {
    private $childRequestModel;

    public function __construct() {
        $this->childRequestModel = $this->loadModel('ChildRequestModel');
    }

    public function dashboard() {
        $this->ensureSchoolAuthenticated();
        $this->renderView('admin/dashboard', [
            'titrePage' => 'Tableau de Bord Secrétariat'
        ]);
    }

    public function childRequests() {
        $requests = $this->childRequestModel->getPendingRequests();
        $this->renderView('admin/child_requests', [
            'requests' => $requests
        ]);
    }

    public function approveRequest($id = null) {
        if ($id) {
            $this->childRequestModel->approveRequest($id);
        }
        $this->redirect('/school/Admin/childRequests');
    }

    public function rejectRequest($id = null) {
        if ($id) {
            $this->childRequestModel->rejectRequest($id);
        }
        $this->redirect('/school/Admin/childRequests');
    }
}