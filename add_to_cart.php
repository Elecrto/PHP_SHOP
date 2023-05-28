<?php
// Подключение к базе данных PostgreSQL
$conn = pg_connect("host=localhost dbname=postgres user=postgres password=admin");

// Получение данных из запроса
$productId = $_POST['productId'];

// Уменьшение количества товара в базе данных
$query = "UPDATE products SET quantity = quantity - 1 WHERE id = $productId";
$result = pg_query($conn, $query);

if ($result) {
    echo "Товар успешно добавлен в корзину.";
} else {
    echo "Ошибка при добавлении товара в корзину.";
}

// Закрытие соединения с базой данных
pg_close($conn);
?>
