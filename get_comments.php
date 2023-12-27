<?php
$comments = [];
$lines = file("aboba.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($lines as $line) {
    list($name, $comment) = explode(": ", $line, 2);
    $comments[] = ["name" => $name, "comment" => $comment];
}

header('Content-Type: application/json');
echo json_encode($comments);
?>
