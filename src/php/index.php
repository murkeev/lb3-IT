<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Зміна чергувань</title>
</head>
<body>
<h2>Палати, де чергує медсестра</h2>
<form method="get" action="query1.php">
    Ім'я медсестри: <input type="text" name="nurse_name" value="ivanova">
    <input type="submit" value="Пошук">
</form>


<h2>Медсестри обраного відділення</h2>
<form method="get" action="query2.php">
    Відділення: <input type="text" name="department" value="1">
    <input type="submit" value="Пошук">
</form>

<h2>Чергування за зміною</h2>
<form method="get" action="query3.php">
    Зміна:
    <select name="shift">
        <option value="First">Перша</option>
        <option value="Second">Друга</option>
        <option value="Third">Третя</option>
    </select>
    <input type="submit" value="Пошук">
</form>

<button onclick="loadHTML()">Отримати HTML</button>
<button onclick="loadXML()">Отримати XML</button>
<button onclick="loadJSON()">Отримати JSON</button>

<div id="result"></div>

<script src="main.js"></script>
</body>
</html>
