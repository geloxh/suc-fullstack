<?php
namespace App\Modules\User\Controllers;

use App\Web\Controllers\BaseController;
use App\Modules\User\Services\GroupService;

class GroupController extends BaseController {
    private $groupService;
    
    public function __construct(GroupService $groupService) {
        $this->groupService = $groupService;
    }
    
    public function index() {
        $groups = $this->groupService->getAllGroups();
        $this->render('user/groups', compact('groups'));
    }
}