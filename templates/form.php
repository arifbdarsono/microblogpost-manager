
<?php
$isEdit = $editPost !== null;
$formAction = $isEdit ? "Edit Post" : "Add New Post";
$data = $isEdit ? $editPost->toArray() : ['title'=>'', 'content'=>'', 'author'=>''];
?>
<h2><?php echo $formAction; ?></h2>
<form method="post">
    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
    <?php if ($isEdit): ?>
        <input type="hidden" name="edit_id" value="<?php echo $data['id']; ?>">
    <?php endif; ?>
    <p><label>Title:<br><input type="text" name="title" value="<?php echo htmlspecialchars($data['title']); ?>" required maxlength="100"></label></p>
    <p><label>Content:<br><textarea name="content" rows="5" cols="40" maxlength="1000" required><?php echo htmlspecialchars($data['content']); ?></textarea></label></p>
    <p><label>Author:<br><input type="text" name="author" value="<?php echo htmlspecialchars($data['author']); ?>" required maxlength="50"></label></p>
    <button type="submit"><?php echo $formAction; ?></button>
    <?php if ($isEdit): ?><a href="index.php">Cancel</a><?php endif; ?>
</form>
