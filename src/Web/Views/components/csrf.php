<?php
use App\Web\Middleware\CSRFMiddleware;
$csrf_token = CSRFMiddleware::generateToken();
?>

<input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">