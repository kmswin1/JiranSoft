<?php
ini_set( 'display_errors', 1 );


require_once __DIR__.'/common/autoload.php';
require_once APP_PATH.'/vendor/autoload.php';

$db = new DB('wp_ondana');

$a = OndanaApi::getBook('i', 1, 'jsecurity');
print_r($a);


// $loader = new Twig_Loader_Filesystem(APP_PATH.'/twig/templates');
// $twig = new Twig_Environment($loader, array(
//     'cache' => APP_PATH.'/twig/cache',
// ));

// $curId = isset($_GET['id'])?$_GET['id']:"";

// $url = 'https://api.ondana.jp/api/books';

// $file = file_get_contents($url);

// $json = json_decode($file, true);
// foreach ($json['bookList'] as $key => $value) {
//     if ($value['OBJID'] == $curId) {
//         $curBook = $value;
//         $curBook['added_time'] = time();
//         break;
//     }
// }

// $bookLists = array();
// if (isset($_COOKIE["book-list"])) {
//     $bookLists = json_decode($_COOKIE["book-list"],true);
// }

// if (!empty($curBook)) {
//     if (!array_key_exists($curId, $bookLists)) {
//         $bookLists[$curId] = $curBook['added_time'];
//     }

//     $tags = $curBook['TAGS'];
//     $tags = explode(",",$tags);
// }

// setcookie('book-list', json_encode($bookLists), time()+365*24*3600);
// // unset($bookLists[$curId]);
// foreach ($bookLists as $id => $time) {
//     foreach ($json['bookList'] as $n => $book) {
//         if ($book['OBJID'] == $id) {
//             $book['added_time'] = $time;
//             $bookLists[$id] = $book;
//             break;
//         }
//     }
// }

// $bookLists = array_reverse($bookLists);


// $template = $twig->load('index.twig');
// $template->display(array('the' => 'variables', 'go' => 'here'));
