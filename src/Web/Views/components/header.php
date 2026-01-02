<?php
$auth = new Auth();
$user = $auth->getCurrentUser();
?>

<header class="header">
    <div class="container">
        <div>
            <a href="/index.php" class="logo">
                <img src="/assets/imgs/suc-logo.png" alt="PSUC logo" style="height: 40px;">
                PSUC Forum
            </a>
            <nav class="nav-menu">
                <a href="/index.php"><i class="fas fa-home"></i> Home</a>
                <?php if ($user): ?>
                    <a href="/messages.php"><i class="fas fa-envelope"></i> Messages</a>                
                    <a href="/profile.php"><i class="fas fa-user"></i> Profile</a>
                    <?php if ($auth->isAdmin()): ?>
                        <a href="/admin/index.php"><i class="fas fa-cog"></i> Admin</a>
                    <?php endif; ?>
                    <a href="/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                <?php else: ?>
                    <a href="/login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
                    <a href="/register.php"><i class="fas fa-user-plus"></i> Register</a>
                <?php endif; ?>
            </nav>
        </div>
    </div>
</header>