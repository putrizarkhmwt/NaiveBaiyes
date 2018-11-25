<?php 
	$f1 = $_POST['f1'];
	$f2 = $_POST['f2'];
	$f3 = $_POST['f3'];
	$txt_file1    = file_get_contents('data.txt');
	$rows1        = explode("\n", $txt_file1); // Memisahkan Item Data dariPemisah enter
	
	$n_ya = 0;
	$n_tidak = 0;
	$n_f1_ya = 0;
	$n_f1_tidak = 0;
	$n_f2_ya = 0;
	$n_f2_tidak = 0;
	$n_f3_ya = 0;
	$n_f3_tidak = 0;
	
	$n_data = count($rows1);
	
	foreach($rows1 as $row1 => $data)
	{
		$row_data = explode('|', $data);// Memisahkan Item Data dariPemisah |
		if($row_data[3]=="YA"){
			$n_ya++;
		}else{
			$n_tidak++;
		}
	}
	
	$P_ya = $n_ya/$n_data;
	$P_tidak = $n_tidak/$n_data;
	
	//proses mencari fakta
	
	foreach($rows1 as $row1 => $data)
	{
		$row_data = explode('|', $data);// Memisahkan Item Data dariPemisah |
		if($row_data[0]==$f1){
			if($row_data[3]=="YA"){
				$n_f1_ya++;
			}else{
				$n_f1_tidak++;
			}
		}
		
		if($row_data[1]==$f2){
			if($row_data[3]=="YA"){
				$n_f2_ya++;
			}else{
				$n_f2_tidak++;
			}
		}
		
		if($row_data[2]==$f3){
			if($row_data[3]=="YA"){
				$n_f3_ya++;
			}else{
				$n_f3_tidak++;
			}
		}
	}
	
	$P_f1_ya = $n_f1_ya / $n_ya;
	$P_f1_tidak = $n_f1_tidak / $n_tidak;
	$P_f2_ya = $n_f2_ya / $n_ya;
	$P_f2_tidak = $n_f2_tidak / $n_tidak;
	$P_f3_ya = $n_f2_ya / $n_ya;
	$P_f3_tidak = $n_f3_tidak / $n_tidak;
	
	//proses perhitungan
	
	$prosentase_ya = $P_ya * $P_f1_ya * $P_f2_ya * $P_f3_ya;
	$prosentase_tidak = $P_tidak * $P_f1_tidak * $P_f2_tidak * $P_f3_tidak;
	
	//hasil akhir
	echo "Hasil Perihtungan Naive Bayes :<br><br>";
	echo "P(X1=".$f1.",X2=".$f2.",X3=".$f2." | Y=YA) <br>= {P(X1=".$f1."|Y=YA) . {P(X2=".$f2."|Y=YA)} . {P(X3=".$f3."|Y=YA)} . P(Y=YA) <br>";
	echo "= ".$P_f1_ya." . ".$P_f2_ya." . ".$P_f3_ya." . ".$P_ya."<br>";
	echo "= ".$prosentase_ya;
	echo "<BR><BR>";
	echo "P(X1=".$f1.",X2=".$f2.",X3=".$f2." | Y=TIDAK) <br>= {P(X1=".$f1."|Y=TIDAK) . {P(X2=".$f2."|Y=TIDAK)} . {P(X3=".$f3."|Y=TIDAK)} . P(Y=TIDAK) <br>";
	echo "= ".$P_f1_tidak." . ".$P_f2_tidak." . ".$P_f3_tidak." . ".$P_tidak."<br>";
	echo "= ".$prosentase_tidak;
	echo "<BR><BR>";
	if($prosentase_ya > $prosentase_tidak){
		echo "KEPUTUSAN BEROLAHRAGA ADALAH YA <br>";
	}else{
		echo "KEPUTUSAN BEROLAHRAGA ADALAH TIDAK <br>";
	}
?>

<html>
<body>
	<p><a href="index.php">Kembali Ke Halaman Utama</a></p>
</body>
</html>