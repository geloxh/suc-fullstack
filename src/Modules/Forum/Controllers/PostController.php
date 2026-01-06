public function edit($id) {
    $this->requireAuth();
    $post = $this->postService->getPostById($id);
    $this->render('forum/edit-post', compact('post'));
}

public function delete($id) {
    $this->requireAuth();
    $this->postService->deletePost($id);
    $this->json(['success' => true]);
}
