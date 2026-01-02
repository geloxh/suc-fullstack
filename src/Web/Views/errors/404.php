<div class="error-page">
    <div class="error-container">
        <div class="error-code">404</div>
        <h1><?php echo $title; ?></h1>
        <p><?php echo $message; ?></p>
        <a href="/index.php" class="btn btn-primary">
            <i class="fas fa-home"></i> Go Home
        </a>
    </div>
</div>

<style>
    .error-page {
        min-height: 60vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .error-container {
        max-width: 500px;
        padding: 2rem;
    }

    .error-code {
        font-size: 6rem;
        font-weight: bold;
        color: #3b82f6;
        margin-bottom: qrem;
    }

    .error-container h1 {
        font-size: 2rem;
        margin-bottom: 1rem;
        color: #1f2937;
    }

    .error-container p {
        color: #6b7280;
        margin-bottom: 2rem;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        background: #3b82f6;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 500;
        transition: background 0.2s;
    }

    .btn:hover {
        background: #2563eb;
    }
</style>