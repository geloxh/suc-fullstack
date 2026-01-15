<div class="container" style="padding: 2rem 1rem;">
    <div class="hero-section">
        <h1 class="hero-title">Welcome to SUC-Industry Collaboration Forum</h1>
        <p class="hero-subtitle">Connect with students and faculty from Philippines State Universities and Colleges</p>
    </div>    

    
    <?php if (!empty($recentTopics)): ?>
        <div class="recent-topics-section">
            <h2>Recent Discussions</h2>
            <?php foreach($recentTopics as $topic): ?>
                <div class="topic-item">
                    <h3><a href="/suc-fullstack/topic/<?php echo $topic['id']; ?>"><?php echo htmlspecialchars($topic['title']); ?></a></h3>
                    <p>by <?php echo htmlspecialchars($topic['username']); ?> in <?php echo htmlspecialchars($topic['forum_name']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>