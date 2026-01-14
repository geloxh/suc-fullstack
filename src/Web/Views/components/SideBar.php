<?php
require_once __DIR__ . '/../../../../db/database.php';
require_once __DIR__ . '/../../../Modules/Forum/Services/ForumService.php';

$database = new Database();
$ForumService = new \App\Modules\Forum\Services\ForumService($database->getConnection());
$categories = $forumService->getCategories();

$forums = [];
foreach($categories as $category) {
    $forums[$category['id']] = $forumService->getForumsByCategory($category['id']);
}
?>

<button class="mobile-sidebar-toggle" id="mobileSidebarToggle" onclick="toggleMobileSideBar()">
    <i class="fas fa-bars"></i>
</button>

<div class="dropdown-overlay" id="sidebarOverlay" onclick="closeMobileSidebar()"></div>

<div class="dropdown-sidebar" id="dropdownSidebar">
    <div class="category-dropdown">
        <?php foreach($categories as $category): ?>
            <div class="category-item-dropdown">
                <div class="category-header-dropdown" onclick="toggleCategory(<?php echo $category['id']; ?>)">
                    <i class="<?php echo $category['icon'] ?? 'fas fa-folder'; ?> category-icon-dropdown" style="color: <?php echo $category['color'] ?? '#007bff'; ?>"></i>
                    <span class="category-name"><?php echo htmlspecialchars($category['name']); ?></span>
                    <i class="fas fa-chevron-down dropdown-arrow" id="arrow<?php echo $category['id']; ?>"></i>
                </div>
                <div class="forums-dropdown" id="forums-<?php echo $category['id']; ?>">
                    <?php foreach($forums[$category['id']] as $forum): ?>
                        <div class="forum-item-dropdown" onclick="navigateToForum(<?php echo $forum['id']; ?>)">
                            <div class="forum-name"><?php echo htmlspecialchars($forum['name']); ?></div>
                            <div class="forum-desc"><?php echo htmlspecialchars($forum['description'] ?? ''); ?></div>
                        </div>                    
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    function toggleCategory(categoryId) {
        const forums = document.getElementById('forums-' + categoryId);
        const arrow = document.getElementById('arrow-' + categoryId);

        if (forums.classList.contains('open')) {
            forums.classList.remove('open');
            arrow.classList.remove('rotated');
        } else {
            forums.classList.add('open');
            arrow.classList.add('rotated');
        }
    }

    function navigateToForum(forumId) {
        window.location.href = '/psuc-fullstack/forum/' + forumId;
    }

    function toggleMobileSidebar() {
        const sidebar = document.getElementById('dropdownSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const body = document.body;

        if (sidebar.classList.contains('mobile-open')) {
            closeMobileSidebar();
        } else {
            sidebar.classList.add('mobile-open');
            overlay.classList.add('active');
            body.classList.add('sidebar-open');
        }

        function closeMobileSidebar() {
            const sidebar = document.getElementById('dropdownSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const body = document.body;

            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('active');
            body.classList.remove('sidebar-open');
        }
    }
</script>