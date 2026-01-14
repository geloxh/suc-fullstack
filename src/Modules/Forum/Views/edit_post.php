<div class="container">
    <h1>Edit Post</h1>
    <form method="POST"action="/post/<?= $post['id'] ?>/update">
        <div class="form-group">
            <label>Content:</label>
            <textarea name="content" required><?= htmlspecialchars($post['content']) ?></textarea>
        </div>
        <button type="submit">Update Post</button>
        <a href="/topic/<?= $post['topic_id'] ?>">Cancel</a>
    </form>
</div>