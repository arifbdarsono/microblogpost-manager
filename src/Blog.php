
<?php
require_once __DIR__ . '/Post.php';

class Blog {
    public $posts = [];

    public static function loadFromFile($filename) {
        $blog = new self();
        if (file_exists($filename)) {
            $data = json_decode(file_get_contents($filename), true);
            foreach ($data as $item) {
                $blog->posts[] = Post::fromArray($item);
            }
        }
        return $blog;
    }

    public function saveToFile($filename) {
        $data = array_map(function($post) {
            return $post->toArray();
        }, $this->posts);
        file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function addPost(Post $post) {
        $this->posts[] = $post;
    }

    public function removePostById($id) {
        $this->posts = array_filter($this->posts, function($post) use ($id) {
            return $post->getId() !== $id;
        });
    }

    public function getAllPostsDesc() {
        usort($this->posts, function($a, $b) {
            return strtotime($b->toArray()['created_at']) - strtotime($a->toArray()['created_at']);
        });
        return $this->posts;
    }
}
