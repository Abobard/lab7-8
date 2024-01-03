<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div id="comments-container"></div>

    <script>
        $.ajax({
            url: 'json.php',
            dataType: 'json',
            success: function(data) {
                var html = '<p>Total Comments: ' + data.count + '</p>';
                $.each(data.comments, function(index, comment) {
                    html += '<p><strong>' + comment.user + ':</strong> ' + comment.comment + '</p>';
                });
                $('#comments-container').html(html);
            },
            error: function() {
                alert('Error fetching data');
            }
        });
    </script>
</body>
</html>