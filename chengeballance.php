<?php

// Проверяем, установлен ли username в сессии
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Подключение к базе данных
    $conn = new mysqli('localhost', 'u2995773_u293290', 'Egor200544', 'u2995773_default');

    // Проверка соединения
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    // Подготовка и выполнение запроса
    $stmt = $conn->prepare("SELECT summa, comment FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($summa, $comment);
    $stmt->fetch();

    // Закрытие запроса и соединения
    $stmt->close();
    $conn->close();

    // Здесь переменные $summa и $comment будут содержать значения из колонн summa и comment
    echo "<script>
            var summa = '$summa';
            var comment = '$comment';
          </script>";
}
?>
