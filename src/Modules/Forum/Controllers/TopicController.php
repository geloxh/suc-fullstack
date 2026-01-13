public function edit($id) {
    // Check if user owns the topic or is admin
    $topic = $this->topicService->getById($id);
    if (!$topic || ($topic['user_id'] != $_SESSION['user_id'] && $_SESSION['role'] != 'admin')) {
        header('Location: /');
        exit;
    }
    return $this->view('forum/edit_topic', ['topic' => $topic]);
}

public function update($id) {
    if ($_POST) {
        $this->topicService->update($id, $_POST);
        header("Location: /topic/$id");
        exit;
    }
}

public function delete($id) {
    $topic = $this->topicService->getById($id);
    if ($topic && ($topic['user_id'] == $_SESSION['user_id'] || $_SESSION['role'] == 'admin')) {
        $this->topicService->delete($id);
    }
    header('Location: /');
    exit;
}