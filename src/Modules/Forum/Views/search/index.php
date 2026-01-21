 <style>
    .search-container {
        max-width: 800px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .search-form {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 2rem;
    }

    .search-form input {
        flex: 1;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
    }

    .search-form button {
        padding: 0.75rem 1.5rem;
        background: var(--primary-blue);
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .result-item {
        background: white;
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .result-item h3 {
        margin: 0 0 0.5rem 0;
    }

    .result-item h3 a {
        color: var(--primary-blue);
        text-decoration: none;
    }

    .result-item .meta {
        color: #666;
        font-size: 0.9rem;
    }

    .result-type {
        display: inline-block;
        padding: 0.25rem 0.5rem;
        background: var(--acccent-gold);
        color: white;
        border-radius: 3px;
        font-size: 0.8rem;
        margin-bottom: 0.5rem;
    }
 </style>
 
 <div class="search-container">
    <h1>Search Results</h1>

    <form method="GET" class="search-form">
        <input type="text" name="q" value="<?= htmlspecialchars($query) ?>" placeholder="Search topics, posts..." required>
        <button type="submit">Search</button>
    </form>

    <?php if (!empty($query)): ?>
        <h2>Results for "<?= htmlspecialchars($query) ?>" (<?=  count($results) ?> found)</h2>

        <?php if (!empty($results)): ?>
            <div class="search-results">
                <?php foreach ($results as $result): ?>
                    <div class="result-item">
                        <span class="result-type"><?=  ucfirst($result['type']) ?></span>
                        <h3><a href="/topic/<?= $result['id'] ?>"><?= htmlspecialchars($result['title']) ?></a></h3>
                        <p><?= htmlspecialchars(substr(strip_tags($result['content']), 0, 200)) ?>...</p>
                       <div class="meta">
                            By <?=  htmlspecialchars($result['username']) ?>
                            in <?=  htmlspecialchars($result['forum_name']) ?>
                            on <?=  date('M j, Y', strtotime($result['created_at'])) ?>
                       </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="result-item">
                <p>No results found for your serch. Try different keywords.</p>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <p>Enter a search term to find topics and posts.</p>
    <?php endif; ?>
</div>