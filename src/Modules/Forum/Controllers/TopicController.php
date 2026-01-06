public function edit($id) {
    $this->requireAuth();
    $topic = $this->topicService->getTopicById($id);
    $this->render('forum/edit-topic', compact('topic'));
}

public function delete($id) {
    $this->requireAuth();
    $this->topicService->deleteTopic($id);
    $this->redirect('/forum');
}
