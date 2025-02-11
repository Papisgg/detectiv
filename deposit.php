<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=u2995773_default', 'u2995773_u293290', 'Egor200544');

$userId = $_SESSION['userId']; // Извлечение userId из сессии

// Получение адреса пользователя из базы данных
$addressStmt = $pdo->prepare("SELECT address FROM users WHERE id = :userId");
$addressStmt->execute(['userId' => $userId]);
$userAddress = $addressStmt->fetchColumn();

$recentTransaction = null;

// Проверка, были ли пополнения по этому адресу
if ($userAddress) {
    $transactionStmt = $pdo->prepare("SELECT * FROM transactions WHERE address = :address ORDER BY created_at DESC LIMIT 1");
    $transactionStmt->execute(['address' => $userAddress]);
    $recentTransaction = $transactionStmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Показ адреса пользователя
    
}
?>

<form method="post" id="balans_form">
    <input type="hidden" name="userId" value="<?php echo htmlspecialchars($userId); ?>">
    <button type="submit">Пополнить баланс</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function get_transaction() {
            $.ajax({
                url: 'transaction.php',
                type: 'GET',
                success: function(data) {
                    // Обработка полученных данных
                    console.log(data);
                },
                error: function(xhr, status, error) {
                    console.error('Ошибка при выполнении запроса:', error);
                }
            });
        }

        get_transaction();
    });
</script>
