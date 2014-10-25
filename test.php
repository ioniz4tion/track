<?php 
namespace WebDesign;
spl_autoload_extensions(".class.php");
spl_autoload_register();

$tbStateChampions = New Database("tb_state_champions",array("Name","Year","Image"));

if (isset($_POST["save"])) {
	$tbStateChampions->save(array("Name","Year"));
}

if (isset($_POST["add"])) {
	$tbStateChampions->add();
}

for ($i=0; $i < $tbStateChampions->rowNumber; $i++) { 
	if (isset($_POST["delete" . $i])) {
		$tbStateChampions->delete($i);
	}
}

if (isset($_POST["upload"])) {
	$tbStateChampions->saveFile(array("Image"),"images/");
}

?>

<html>

	<body>

		<form action="test.php" method="post" enctype="multipart/form-data">

			<?php for ($i=0; $i < $tbStateChampions->rowNumber; $i++) { ?>

				<input type="text" value="<?= $tbStateChampions->Name[$i] ?>" name="Name<?= $i ?>">

				<input type="text" value="<?= $tbStateChampions->Year[$i] ?>" name="Year<?= $i ?>">

				<input type="submit" value="delete" name="delete<?= $i ?>">

				<img src="images/<?= $tbStateChampions->Image[$i] ?>">

				<input type="file" name="Image<?= $i ?>">

				<input type="submit" value="upload" name="upload">

				<br/>

			<?php } ?>

			<input type="submit" name="save">

			<input type="submit" name="add" value="add">

		</form>

		<?php echo $tbStateChampions->rowNumber; ?>