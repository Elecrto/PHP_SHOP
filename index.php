<!DOCTYPE html>
<html>
<head>
    <title>Магазин вещей</title>
</head>
<body>
<?php
// Подключение к базе данных PostgreSQL
$conn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=admin");

// Получение списка товаров из базы данных
$query = "SELECT * FROM products";
$result = pg_query($conn, $query);

if (pg_num_rows($result) > 0) {
    // Отображение списка товаров
    while ($row = pg_fetch_assoc($result)) {
        echo "<div>";
        echo "<h3>".$row['name']."</h3>";
        echo "<img src='".$row['image_url']."' alt='Product Image'>";
        echo "<p>Цена: ".$row['price']."</p>";
        echo "<p>Доступное количество: ".$row['quantity']."</p>";
        echo "<button onclick='addToCart(".$row['id'].")'>Добавить в корзину</button>";
        echo "</div>";
    }
} else {
    echo "Нет доступных товаров.";
}

// Закрытие соединения с базой данных
pg_close($conn);
?>

<script>
    function addToCart(productId) {
        // Отправка запроса на сервер для добавления товара в корзину
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "addToCart.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert(xhr.responseText);
            }
        };
        xhr.send("productId=" + productId);
    }
</script>
</body>
</html>
