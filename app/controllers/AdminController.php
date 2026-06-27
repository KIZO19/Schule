<?php
// app/controllers/AdminController.php

class AdminController extends Controller {
    private $childRequestModel;

    public function __construct() {
        $this->childRequestModel = $this->loadModel('ChildRequestModel');
    }

    public function dashboard() {
        $this->ensureAgentAuthenticated();

        $ecoleId = $_SESSION['ecole_id'] ?? $_SESSION['agent_ecole_id'];
        $parentModel = $this->loadModel('ParentModel');
        $eleveModel = $this->loadModel('Eleve');
        $agentModel = $this->loadModel('AgentModel');

        $metrics = [
            'pendingRequests' => $this->childRequestModel->countPendingRequestsByEcole($ecoleId),
            'parentsCount' => $parentModel->countParentsByEcole($ecoleId),
            'studentsCount' => $eleveModel->countElevesByEcole($ecoleId),
            'agentsCount' => $agentModel->countAgentsByEcole($ecoleId),
        ];

        $recentRequests = $this->childRequestModel->getRecentPendingRequestsByEcole($ecoleId, 4);

        $this->renderView('admin/dashboard', [
            'titrePage' => 'Tableau de Bord Secrétariat',
            'metrics' => $metrics,
            'recentRequests' => $recentRequests,
        ]);
    }

    public function childRequests() {
        $this->ensureAgentAuthenticated();
        $requests = $this->childRequestModel->getPendingRequests();
        $this->renderView('admin/child_requests', [
            'requests' => $requests
        ]);
    }

    public function approveRequest($id = null) {
        $this->ensureAgentAuthenticated();
        if ($id) {
            $this->childRequestModel->approveRequest($id);
        }
        $this->redirect('/school/Admin/childRequests');
    }

    public function rejectRequest($id = null) {
        $this->ensureAgentAuthenticated();
        if ($id) {
            $this->childRequestModel->rejectRequest($id);
        }
        $this->redirect('/school/Admin/childRequests');
    }
}