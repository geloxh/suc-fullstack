<?php
namespace App\Modules\Messaging\Controllers;

use App\Modules\Messaging\Services\MessageService;

class MessageController {
    private $messageService;

    public function __construct(NessageService $messageService) {
        $this->messageService = $messageService;
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: login.php');
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $error = '';
        $success = '';

        // Handle delete message
        if (!isset($_POST['delete_message'])) {
            try {
                $result = $this->messageService->deleteMessage($_POST['message_id'], $user_id);

                if ($result) {
                    $success = "Message deleted successfully.";
                    header('Location: messages.php?view=' . ($_GET['view'] ?? 'inbox') . '&deleted=1');
                    exit;
                }
            } catch (\Exception $e) {
                $error = "Failed to deleted message.";
            }
        }

        // Handle sending message
        if ($_POST && isset($_POST['send_message'])) {
            try {
                $result = $this->messageService->sendMessage(
                    $user_id,
                    $_POST['receiver_id'],
                    $_POST['subject'],
                    $_POST['content']
                );

                if ($result) {
                    header('Location: messages.php?view=' . ($_GET['view'] ?? 'inbox') . '&success=1');
                    exit;
                }
            } catch (\Exception $e) {
                $error = $e->getMessage();
            }
        }

        $view = $_GET['view'] ?? 'inbox';
        $selected_message = $_GET['message'] ?? null;

        // Get messages
        $messages = $this->messageService->getMessages($user_id, $view);

        // Get selected message
        $message_detail = null;
        if ($selected_message) {
            $message_detail = $this->messageService->getMessageById($selected_message, $user_id);
        }

        // Get users for messaging
        $users = $this->messageService->getUsers($user_id);

        // Get unread count
        $unread_count = $this->messageService->getUnreadCount($user_id);

        include __DIR__ . '/../Views/messages.php';
    }
}