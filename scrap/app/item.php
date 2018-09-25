<?php
require_once '../common/autoload.php';

try {
	if($_SERVER['REQUEST_METHOD'] == 'DELETE') {

		$deleteParam = json_decode(file_get_contents('php://input'), true);
		$scrapId = $_COOKIE["scrap_id"];
		$bookId = isset($deleteParam['book-id'])?$deleteParam['book-id']:"";

		$db = new DB('pubtree');

		$sql = "UPDATE pts_scrap_books
				   SET deleted_at = NOW()
				 WHERE pub_id = :pub_id
				   AND book_id = :book_id";
		$stmt = $db->prepare($sql);
	    $stmt->bindValue(':pub_id', $scrapId);
	    $stmt->bindValue(':book_id', $bookId);
	    $stmt->execute();

	    $result = array('result' => true);
	    echo json_encode($result);

	    exit;
	}

	header('HTTP', true, 400);
	$result = array('result' => false);
	echo json_encode($result);
} catch (Exception $e) {
	header('HTTP', true, 400);
	$result = array('result' => false);
	echo json_encode($result);
}

