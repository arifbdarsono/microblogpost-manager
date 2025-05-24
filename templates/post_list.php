
<h2>All Posts</h2>
<?php
$posts = $blog->getAllPostsDesc();
if (empty($posts)) {
    echo "<p>No posts yet.</p>";
} else {
    foreach ($posts as $post) {
        $post->display();
    }
}
?>
