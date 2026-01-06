public function uploadAvatar() {
    $this->requireAuth();
    try {
        $this->userService->updateAvatar($_SESSION['user_id'], $_FILES['avatar']);
        $this->redirect('/profile');
    } catch (\Exception $e) {
        $this->redirect('/profile?error=' . urlencode($e->getMessage()));
    }
}
