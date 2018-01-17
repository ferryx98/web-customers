<?php
    include "includes/bootstrap.php";
    include "includes/connexio.php";
    $operacio="";
    if (isset($_REQUEST["operacio"])) $operacio=$_REQUEST["operacio"];
    if ($operacio!="new" && $operacio!="edit") header("Location: list_customers.php");
    obrirConnexioBD();
    if ($operacio=="edit") {
        if (isset($_REQUEST["id_customer"])) {
            $id_customer=$_REQUEST["id_customer"];
            $sql = "SELECT * FROM customers WHERE id_customer=" . $id_customer;
            $result = $conn->query($sql);
            if ($result->num_rows == 0) {
                tancarConnexioBD();
                header("Location: list_customers.php?");
            } else {
                $row = $result->fetch_assoc();
            }
        } else {
            header("Location: list_customers.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php bsHead("list"); ?>
    <body>
	<div class="container">
		<h3><center><?php if ($operacio=="new") echo "New Customer"; else echo "Modify Customer"; ?></center></h3>
        <br>
		<div class="row myform">
			<div class="col-md-7 col-md-offset-3">
                <div class="alert alert-info" role="alert">
				<form name="form_customers" action="update_customers.php?operacio=<?=$operacio?>" role="form" method="post">
					<div class="form-group">
						<label class="control-label" for="id_customer">Customer Number:</label>
						<input required type="number" name="id_customer" id="id_customer" min="1" max="10000" class="form-control" placeholder="Insert customer number" value="<?=$row["id_customer"]?>"<?php if ($operacio=="edit") echo "readonly" ?>/>
					</div>
                    <div class="form-group">
						<label class="control-label" for="Surname">Surname:</label>
						<input required type="text" name="Surname" id="Surname" maxlength="25" class="form-control" placeholder="Insert Surname" value="<?php if (isset($row)) echo $row["Surname"]?>"/>
					</div>
					<div class="form-group">
						<label class="control-label" for="Name">Name:</label>
						<input required type="text" name="Name" id="Name" maxlength="25" class="form-control" placeholder="Insert Name" value="<?php if (isset($row)) echo $row["Name"]?>"/>
					</div>
					<div class="form-group">
						<label class="control-label" for="Phonenumber">Phonenumber:</label>
						<input required type="text" name="Phonenumber" id="Phonenumber" maxlength="25" class="form-control" placeholder="Insert Phonenumber" value="<?php if (isset($row)) echo $row["Phonenumber"]?>"/>
					</div>
					<div class="form-group">
						<label class="control-label" for="Mail">Mail:</label>
						<input required type="text" name="Mail" id="Mail" maxlength="50" class="form-control" placeholder="Insert Mail" value="<?php if (isset($row)) echo $row["Mail"]?>"/>
					</div>
                    <div class="form-group">
                        <label class="control-label" for="Address">Address:</label>
                        <input required type="text" name="Address" id="Address" maxlength="25" class="form-control" placeholder="Insert Address" value="<?php if (isset($row)) echo $row["Address"]?>"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="parroquia">Parròquia:</label>
                <?php   $sql = "SELECT * FROM parroquies ORDER BY id_parroquia;";
                        $resultSelect = $conn->query($sql);
                        while($rowSelect = $resultSelect->fetch_assoc()) { ?>
                            <div class="radio">
                               <label>
                                    <input type="radio" name="parroquia" id="parroquia" value="<?=$rowSelect["id_parroquia"]?>"<?php if (isset($row)) if ($row["parroquia"]==$rowSelect["id_parroquia"]) echo " checked";?>>
                                    <?=$rowSelect["nom_parroquia"]?>
                               </label>
                            </div>
                <?php   } ?>
                    </div>
                    <br>
                    
                    <div class="form-group">
                        <center>
                            <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-send"></span> Enviar</button>
                            <button type="button" onClick="window.print();" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span> imprimir</button>
                        </center>
                    </div>
				</form>
			</div>
            </div>
    	</div>
	</div>
    <?php tancarConnexioBD(); ?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
