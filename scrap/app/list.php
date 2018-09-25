<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>	<meta charset="UTF-8">
  	<title>ONDANA</title>
  </head>
  <body>
    <div class="">
      <a href="http://scrap.jiransoft.jp/app/grid.php">그리드</a>
    </div>
  </body>
</html>
<?php
ini_set( 'display_errors', 1 );
require_once "../common/autoload.php";
require_once APP_PATH.'/vendor/autoload.php';

$bookId = isset($_GET['book_id'])?$_GET['book_id']:"";

$scrapId = isset($_COOKIE["scrap_id"])?$_COOKIE["scrap_id"]:"";

$db = new DB('pubtree');

$sql = "SELECT A.title
              ,A.owner_email
              ,B.book_id
              ,B.site_id
              ,IFNULL(C.TITLE, B.book_title) book_title
              ,IFNULL(B.readded_at,B.added_at) added_at
              ,C.`THUMBNAIL_FILEID`
              ,C.TAGS
              ,C.`SUMMARY`
              ,(SELECT COUNT(1)
              	  FROM pts_scrap_books
              	 WHERE book_id = B.book_id) scrap_cnt
              ,C.SITE_ID
			  ,D.DOMAIN
			  ,D.STATUS
          FROM pts_scraps A, pts_scrap_books B LEFT OUTER JOIN pti_document C
            ON B.book_id = C.OBJID
           AND C.PUBLISH_FLAG = 'Y'
          LEFT OUTER JOIN pti_site D
            ON C.SITE_ID = D.SITE_ID
         WHERE A.pub_id = B.pub_id
           AND B.deleted_at IS NULL
           AND A.pub_id = :scrap_id
         ORDER BY IFNULL(B.readded_at, B.added_at) DESC";
$stmt = $db->prepare($sql);
$stmt->bindValue(':scrap_id', $scrapId);
$stmt->execute();
$list = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($list as $key => $item) {
	$tags = $item['TAGS'];
	if ($tags != "") {
	    $item['TAGS'] = explode(",",$tags);
	}
	$item['added_ago'] = timeago($item['added_at']);
	$list[$key] = $item;
}

$loader = new Twig_Loader_Filesystem(APP_PATH.'/twig/templates');
$twig = new Twig_Environment($loader, array(
    // 'cache' => APP_PATH.'/twig/cache',
));

$template = $twig->load('scrapList.twig');
$template->display(array('scrap_list' => $list));



function timeago($date) {
	   $timestamp = strtotime($date);

	   $strTime = array("秒", "分", "時間", "日", "月", "年");
	   $length = array("60","60","24","30","12","10");

	   $currentTime = time();
	   if($currentTime >= $timestamp) {
			$diff     = time()- $timestamp;
			for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
			$diff = $diff / $length[$i];
			}

			$diff = round($diff);
			return $diff . " " . $strTime[$i] . "前";
	}
}
?>
