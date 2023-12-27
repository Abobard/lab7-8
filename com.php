<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $comments = [];
    $lines = file("aboba.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        list($name, $comment) = explode(": ", $line, 2);
        $comments[] = ["name" => $name, "comment" => $comment];
    }

    $newComment = [
        "name" => $_POST["name"],
        "comment" => $_POST["comment"],
    ];
    $comments[] = $newComment;

    $fileContent = "";
    foreach ($comments as $comment) {
        $fileContent .= "{$comment['name']}: {$comment['comment']}\n";
    }
    file_put_contents("aboba.txt", $fileContent);

    header('Content-Type: application/json');
    echo json_encode($comments);
    exit;
}
?>


