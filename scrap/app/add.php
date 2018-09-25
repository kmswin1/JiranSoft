<?php
ini_set( 'display_errors', 1 );

require_once '../common/autoload.php';

$siteId = isset($_GET['site_id'])?$_GET['site_id']:"";
$bookId = isset($_GET['book_id'])?$_GET['book_id']:"";

$db = new DB('pubtree');

$scrapId = "";

if(isset($_COOKIE["scrap_id"])) {
    $sid = $_COOKIE["scrap_id"];
    $sql = "SELECT 1 
              FROM pts_scraps 
             WHERE pub_id = :pub_id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':pub_id', $sid);
    $stmt->execute();
    $exists = $stmt->fetchColumn();
    if ($exists) {
        $scrapId = $sid;
    }
}

if ($scrapId == "") {
    $scrapId = createScrapPubId($db);

    $sql = "INSERT INTO pts_scraps (pub_id)
                VALUES (:pub_id)";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':pub_id', $scrapId);
    $stmt->execute();
}

setcookie('scrap_id', $scrapId, time()+365*24*3600);

$params = array('book_objid'=>$bookId);

$item = OndanaApi::getItem('i', 1, $siteId, $params);
$sql = "SELECT COUNT(1) cnt
          FROM pts_scrap_books
         WHERE pub_id = :pub_id
           AND book_id = :book_id";
$stmt = $db->prepare($sql);
$stmt->bindValue(':pub_id', $scrapId);
$stmt->bindValue(':book_id', $bookId);
$stmt->execute();
$dataBook = $stmt->fetch(PDO::FETCH_ASSOC);

if ($dataBook['cnt'] == 0) {
    $sql = "INSERT INTO pts_scrap_books (pub_id, book_id, site_id, book_title)
                VALUES (:pub_id, :book_id, :site_id, :book_title)";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':pub_id', $scrapId);
    $stmt->bindValue(':book_id', $bookId);
    $stmt->bindValue(':site_id', $siteId);
    $stmt->bindValue(':book_title', $item['TITLE']);
    $stmt->execute();
}
else {
    $sql = "UPDATE pts_scrap_books
               SET readded_at = NOW()
                  ,deleted_at = NULL
             WHERE pub_id = :pub_id
               AND book_id = :book_id";
    $stmt = $db->prepare($sql);
    // $stmt->bindValue(':book_title', $item['TITLE']);
    $stmt->bindValue(':pub_id', $scrapId);
    $stmt->bindValue(':book_id', $bookId);
    $stmt->execute();
}

header("Location:/app/list.php?book_id=".$bookId);

function createScrapPubId($db) {
    $sql = "SELECT COUNT(B.pub_id) cnt, MAX(A.pub_id) new_pub_id
              FROM (SELECT CONCAT(SUBSTR(str, CEIL( RAND() * len), 1),
                                   SUBSTR(str, CEIL( RAND() * len), 1),
                                   SUBSTR(str, CEIL( RAND() * len), 1),
                                   SUBSTR(str, CEIL( RAND() * len), 1),
                                   SUBSTR(str, CEIL( RAND() * len), 1),
                                   SUBSTR(str, CEIL( RAND() * len), 1),
                                   SUBSTR(str, CEIL( RAND() * len), 1),
                                   SUBSTR(str, CEIL( RAND() * len), 1),
                                   SUBSTR(str, CEIL( RAND() * len), 1),
                                   SUBSTR(str, CEIL( RAND() * len), 1),
                                   SUBSTR(str, CEIL( RAND() * len), 1),
                                   SUBSTR(str, CEIL( RAND() * len), 1),
                                   SUBSTR(str, CEIL( RAND() * len), 1)
                                ) pub_id
                      FROM (SELECT '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' str, 62 len) SA
                  ) A LEFT OUTER JOIN pts_scraps B
               ON A.pub_id = B.pub_id";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $dataPubId = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($dataPubId['cnt'] == 0) {
        return $dataPubId['new_pub_id'];
    }
    else {
        createScrapPubId($db);
    }
}