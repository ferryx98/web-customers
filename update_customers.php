<?php
    include "includes/bootstrap.php";
    include "includes/connexio.php";
    $operacio="";
    if (isset($_REQUEST["operacio"])) $operacio=$_REQUEST["operacio"];
    if ($operacio!="new" && $operacio!="edit") header("Location: list_customers.php");
    $id_customer=$_REQUEST["id_customer"];
	$surname=$_REQUEST["surname"];
	$name=$_REQUEST["name"];
	$phonenumber=$_REQUEST["phonenumber"];
	$correu1=$_REQUEST["correu1"];
    $correu2=$_REQUEST["correu2"];
	$hora=$_REQUEST["hora"];
	$dia=$_REQUEST["dia"];
	$mes=$_REQUEST["mes"];
	$any=$_REQUEST["any"];
	$tecnic=$_REQUEST["tecnic"];
	$parroquia=$_REQUEST["parroquia"];
	$tipus=$_REQUEST["tipus"];
	$estat=$_REQUEST["estat"];
	$observacions=$_REQUEST["observacions"];
	$idioma=$_REQUEST["idioma"];
	$dificultat=$_REQUEST["dificultat"];
	$descripcio=$_REQUEST["descripcio"];
    if ($operacio=="new") {
        $sql="INSERT INTO incidencies (id_customer,surname,name,phonenumber,correu1,correu2,hora,dia,mes,any,tecnic,parroquia,tipus,estat,observacions,idioma,dificultat,descripcio) VALUES ($id_customer, \"$surname\", \"$name\", \"$phonenumber\", \"$correu1\", \"$correu2\", \"$hora\", $dia, $mes, $any, \"$tecnic\", \"$parroquia\", \"$tipus\", \"$estat\", \"$observacions\", \"$idioma\", \"$dificultat\", \"$descripcio\");";
    } else {
        $sql="UPDATE incidencies SET surname=\"$surname\",name=\"$name\",phonenumber=\"$phonenumber\",correu1=\"$correu1\",correu2=\"$correu2\",hora=\"$hora\",dia=$dia,mes=$mes,any=$any,tecnic=\"$tecnic\",parroquia=\"$parroquia\",tipus=\"$tipus\",estat=\"$estat\",observacions=\"$observacions\",idioma=\"$idioma\",dificultat=$dificultat,descripcio=\"$descripcio\" WHERE id_customer=$id_customer;";
    }
    obrirConnexioBD();
    if ($conn->query($sql) === TRUE) {
        tancarConnexioBD();
        header("Location: llistat_incidencies.php");
    } else { ?>
        <!DOCTYPE html>
        <html lang="en">
            <?php bsHead("Creat/modificat"); ?>
            <body>
                <div class="alert alert-danger" role="alert">
                    <h3>Error creant/modificant incidència</h3>
                    <p><?=$conn->error?></p>
                </div>
            </body>
        </html>
<?php
    }
    tancarConnexioBD();
?>
