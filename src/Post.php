
<?php
class Post {
    private static $nextId = 1;
    private $id;
    private $title;
    private $content;
    private $author;
    private $createdAt;

    public function __construct($title, $content, $author) {
        $this->id = self::$nextId++;
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->createdAt = date('Y-m-d H:i:s');
    }

    public static function fromArray(array $data) {
        $post = new self($data['title'], $data['content'], $data['author']);
        $post->id = $data['id'];
        $post->createdAt = $data['created_at'];
        if ($post->id >= self::$nextId) {
            self::$nextId = $post->id + 1;
        }
        return $post;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'author' => $this->author,
            'created_at' => $this->createdAt,
        ];
    }

    public function getId() {
        return $this->id;
    }

    public function update($title, $content, $author) {
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
    }

    public function display() {
        $data = $this->toArray();
        echo "<div style='border:1px solid #ccc; padding:10px; margin-bottom:10px'>";
        echo "<h3>" . htmlspecialchars($data['title']) . "</h3>";
        echo "<p>" . nl2br(htmlspecialchars($data['content'])) . "</p>";
        echo "<small>Author: " . htmlspecialchars($data['author']) . " | " . htmlspecialchars($data['created_at']) . "</small>";
        echo "<form method='get' style='display:inline;'><input type='hidden' name='edit_id' value='" . $data['id'] . "'><button>Edit</button></form> ";
        echo "<form method='post' style='display:inline;' onsubmit='return confirm(\"Delete this post?\");'>";
        echo "<input type='hidden' name='csrf_token' value='" . htmlspecialchars($_SESSION['csrf_token']) . "'>";
        echo "<input type='hidden' name='delete_id' value='" . $data['id'] . "'>";
        echo "<button type='submit'>Delete</button>";
        echo "</form>";
        echo "</div>";
    }
}
