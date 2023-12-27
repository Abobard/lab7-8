<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Ваша сторінка</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <div class="button-container">
        <button onclick="changeNeutral()">н</button>
        <button onclick="changeBlack()">ч</button>
    </div>

    <div id="clock-container">
        <div id="clock"></div>
    </div>

    <div class="header">
        <h1>Warhammer 40K</h1>
    </div>

    <div class="main-content">
        <!-- Ваші посилання тут -->
    </div>

    <div id="add-comment-container" class="comments-section">
        <h3>Додати коментар</h3>
        <form id="comment-form" onsubmit="addComment(); return false;">
            <input type="text" name="name" placeholder="Введіть нікнейм" required><br>
            <textarea name="comment" rows="4" placeholder="Введіть коментар" required></textarea><br>
            <button type="submit">Додати коментар</button>
        </form>
    </div>

    <style>
        .chat-message {
            padding: 8px;
            text-align: center;
            margin: 5px 0;
            border-radius: 10px;
            background-color: #fff;
            word-wrap: break-word;
        }

        .chat-message h1 {
            font-size: 16px;
            margin: 0;
        }

        #clock-container {
            margin-top: 20px;
        }
    </style>

    <div id="comments-container" class="comments-section">
        <h3>Коментарі</h3>
        <!-- Коментарі будуть динамічно оновлюватися тут -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function changeNeutral() {
            document.body.style.backgroundColor = 'rgb(245, 245, 245)';
            document.body.style.color = 'black';
        }

        function changeBlack() {
            document.body.style.backgroundColor = 'rgb(51, 51, 51)';
            document.body.style.color = 'white';
        }

        function addComment() {
            var formData = $("#comment-form").serialize();

            $.ajax({
                type: "POST",
                url: "com.php",
                data: formData,
                dataType: "json",
                success: function (response) {
                    updateComments(response);
                }
            });
        }

        function updateComments(comments) {
            var commentsContainer = $("#comments-container");
            commentsContainer.empty();

            $.each(comments, function (index, comment) {
                var commentHtml = '<div><b>' + comment.name + '</b>: <b>' + comment.comment + '</b></div>';
                commentsContainer.append(commentHtml);
            });
        }

        function updateClock() {
            $.ajax({
                url: 'update_clock.php', // Шлях до серверного скрипту
                method: 'GET',
                success: function (response) {
                    $('#clock').text(response);
                }
            });
        }

        // Оновлювати годинник кожні 1000 мілісекунд (1 секунда)
        setInterval(updateClock, 1000);

        // Запуск оновлення при завантаженні сторінки
        updateClock();

        // Оновлення коментарів при завантаженні сторінки
        $(document).ready(function () {
            $.ajax({
                type: "GET",
                url: "get_comments.php",
                dataType: "json",
                success: function (comments) {
                    updateComments(comments);
                }
            });
        });
    </script>

</body>

</html>
