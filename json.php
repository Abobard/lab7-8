<?php
$reviewsContent = file_get_contents('aboba.txt');
$reviewsArray = array_filter(explode("\n", $reviewsContent));
$comments = array();
foreach ($reviewsArray as $review) {
    $parts = explode(':', $review, 2);
    $comments[] = array(
        'user' => trim($parts[0]),
        'comment' => isset($parts[1]) ? trim($parts[1]) : ''
    );
}
echo json_encode(array('comments' => $comments, 'count' => count($comments)));
?>