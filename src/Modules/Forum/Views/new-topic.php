<div class="container">
    <h1>Create New Topic</h1>
    <form method="POST" action="/suc-fullstack/new-topic">
        <div class="form-group">
            <label for=""></label>
            <input type="text" name="title" required>
        </div>
        <div class="form-group">
            <label>Content:</label>
            <textarea name="content" required></textarea>
        </div>
        <button type="submit">Create Topic</button>
    </form>
</div>