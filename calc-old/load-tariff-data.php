<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Загрузка данных тарифов</title>
</head>
<body>

<form action="http://127.0.0.1:8000/api/load-sheet" method="post" enctype="multipart/form-data">
    <label for="fileInput">Выберите файл:</label>
    <input type="file" name="tariffs.xlsx" id="fileInput" accept=".xls, .xlsx">

    <button type="submit">Отправить файл</button>
</form>

</body>
</html>