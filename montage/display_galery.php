<?php
require '../user/connexion.php';

$page = (!empty($_GET['page']) ? $_GET['page'] : 1);
$limite = 5;
$debut = ($page - 1) * $limite;

$query = $db->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM montage ORDER BY date_creation DESC LIMIT :limite OFFSET :debut");
$query->bindValue('debut', $debut, PDO::PARAM_INT);
$query->bindValue('limite', $limite, PDO::PARAM_INT);
$query->execute();

$resultFoundRows = $db->prepare('SELECT FOUND_ROWS()');
$resultFoundRows->execute();
$nombredElementsTotal = $resultFoundRows->fetchColumn();

		while ($content = $query->fetch())
		{
			$path = $content[path];
			$id_photo = $content[id];
			$src = "galery2.php";
			$img = "../img2/like.png";
			$style="width:50; background: #999999";

			$sql = $db->prepare("SELECT commentaire, nom_user, id_photo FROM commentaire WHERE id_photo = ?");
			$sql->execute(array($id_photo));

			$req2 = $db->prepare("SELECT COUNT(*) FROM `like` WHERE id_photo = ?");
			$req2->execute(array($id_photo));
			$req2 = $req2->fetch();

				echo "
				<div id='".galerie."'>
					<ul id='".galerie_mini."'>
						<li class='".name."'>
							<a href='".$path."'><img src='".$path."'></a>
							<form method='".post."' action='".$src."'>
							<button type='".submit."' name='".like."' id='".like."'/><img src='".$img."' style='".$style."'/></button>"
							?> 

							<?php 

							$req = $db->prepare("SELECT user FROM montage WHERE id = ?");
							$req->execute(array($id_photo));
							$req = $req->fetch();

							if($_SESSION['login'] == $req[user]) { ?>

							<button type="submit" name="del"/><img src="../img2/del.png" style="width:50; background: #999999"/></button></br>

							<?php } ?>

							<?php echo $req2['COUNT(*)'];?>
							</br>
							<?php	echo "Entrez votre commentaire </br>
								<input type='".text."' name='".com."'/>
								<input type='".submit."' name='".submit."' value='".add."'/>
								<input type='".hidden."' value='".$id_photo."' name='".id_photo."'/>
							</form>
						</li>
					</ul>
					<dl id='".photo."'></dl>
				</div>";
			?>
			<div  id="coms">
			<?php
			while ($com = $sql->fetch())
			{
				echo $com[nom_user].": ";
				print_r($com[commentaire]);
				print_r("<p>$com[commentaire]</p>");
			}
			?>
			</div>
			</div>
		<?php
		}
		if (isset($_POST['del']))
		{
			$id = $_POST['id_photo'];

			$sql6 = $db->prepare("DELETE FROM montage WHERE id = ?");
					$sql6->execute(array($id));
					$sql7 = $db->prepare("DELETE FROM commentaire WHERE id_photo = ?");
					$sql7->execute(array($id));
					$sql8 = $db->prepare ("DELETE FROM `like`WHERE id_photo = ?");
					$sql8->execute(array($id));
					echo '<script type="text/javascript"> window.location.replace("galery2.php") </script>';
		}
		$nombreDePages = ceil($nombredElementsTotal / $limite);
if ($page > 1):
    ?><a href="http://localhost:8080/camagru/montage/galery2.php?page=<?php echo $page - 1; ?>">Page précédente</a> — <?php
endif;
for ($i = 1; $i <= $nombreDePages; $i++):
    ?><a href="http://localhost:8080/camagru/montage/galery2.php?page=<?php echo $i; ?>"><?php echo $i; ?></a> <?php
endfor;
if ($page < $nombreDePages):
    ?> — <a href="http://localhost:8080/camagru/montage/galery2.php?page=<?php echo $page + 1; ?>">Page suivante</a><?php
endif;?>
