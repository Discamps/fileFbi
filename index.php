<?php
include('inc/head.php');
if(!empty($_GET['supp'])){
	$dir = $_GET['supp'];
define('FILE_PATH', $dir); // definit constante
function removeAll($path){
	foreach( new DirectoryIterator($path) as $item) :
		if($item->isFile() ) unlink($item->getRealPath());
		if(!$item->isDot() && $item->isDir() ) removeAll($item->getRealPath()); 
	endforeach;
	rmdir($path);
}
removeAll(FILE_PATH);
}

if (isset($_GET['dir'])) { // si GET dir n'est pas vide
    $scanDir = scandir($_GET['dir']); // On fait une liste des fichiers et dossier
    foreach ($scanDir as $file) { // on crée une boucle
        $infoFile = pathinfo($file); // retourne des information sur le chemin système
        if (!isset($infoFile['extension'])) { // Si il n'y as pas d'extension on affiche 
            echo '<strong><a href="?dir=' . $_GET['dir'].$file . '/">' . $file . '</a></strong> ';
            echo '<a href="?supp=' . $_GET['dir'].$file.'">Supp</a><br>';

        } elseif (strlen($infoFile['extension']) != 0) {
            echo '<strong><a href="edit.php?f=' . $_GET['dir'].$file . '">' . $file . '</a><br></strong>';

        }
    }
?>
    <p><a href="/">Retour</a></p>
<?php
} else {
    $dir = opendir("files");
    while ($file = readdir($dir)) {
        if (!in_array($file,array(".",".."))) {
            echo '<li><a href="?dir=files/'.$file.'/">';
            echo $file;
            echo '</a></li>';
        }

    }
}
?>



<?php include('inc/foot.php'); ?>