
<?php
session_start();
require_once __DIR__ . '/src/Blog.php';
require_once __DIR__ . '/includes/csrf.php';

$dataFile = __DIR__ . '/data/posts.json';
$blog = Blog::loadFromFile($dataFile);
$csrf_token = get_csrf_token();
$editPost = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf($_POST['csrf_token'] ?? '');
    if (!empty($_POST['delete_id'])) {
        $blog->removePostById((int)$_POST['delete_id']);
    } elseif (!empty($_POST['edit_id'])) {
        foreach ($blog->posts as $post) {
            if ($post->getId() == $_POST['edit_id']) {
                $post->update($_POST['title'], $_POST['content'], $_POST['author']);
                break;
            }
        }
    } else {
        $post = new Post($_POST['title'], $_POST['content'], $_POST['author']);
        $blog->addPost($post);
    }
    $blog->saveToFile($dataFile);
    header("Location: index.php");
    exit;
}

if (isset($_GET['edit_id'])) {
    foreach ($blog->posts as $post) {
        if ($post->getId() == $_GET['edit_id']) {
            $editPost = $post;
            break;
        }
    }
}

include __DIR__ . '/templates/form.php';
include __DIR__ . '/templates/post_list.php';
