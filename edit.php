<?php
include('inc/head.php');
$showFile = $_GET['f'];
if (isset($_POST['content'])) {
    $file = fopen($showFile, "w");
    fwrite($file, $_POST['content']);
    fclose($file);
}
if (isset($_POST['delete'])) {
    unlink($showFile);
    header('Location: index.php');
}

$infoFile = pathinfo($showFile);
if ($infoFile['extension'] == 'txt' || $infoFile['extension'] == 'html') {
    ?>
<form method="post">
    <label for="content">Moditifer le fichier : <?= $showFile ?></label>
    <textarea name="content" id="content" rows="10"><?= file_get_contents($showFile) ?></textarea>
    <input type="hidden" name="file" value="<?= $showFile ?>">
    <input style="margin-top:2rem;" class="btn btn-warning" type="submit" value="Edit" name="send">
    <input style="margin-top:2rem;" class="btn btn-danger" type="submit" value="Delete" name="delete">
</form>
<?php
    } else {
    ?>
    <img src="<?= $showFile ?>">
    <form method="post">
        <input style="margin-top:2rem;" class="btn btn-danger" type="submit" name="delete" value="Supprimer">
    </form>
<?php
}
?>

<hr>
<a href="/">Retour ?</a>

<?php include('inc/foot.php'); ?>