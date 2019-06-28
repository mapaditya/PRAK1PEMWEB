<?php 

error_reporting(0);

function fsize($file){
    $a = array("B", "KB", "MB", "GB", "TB", "PB");
    $pos = 0;
    $size = filesize($file);
    while ($size >= 1024)
    {
    $size /= 1024;
    $pos++;
    }
    return round ($size,2)." ".$a[$pos];
}

function draw(){
    $folder = getcwd();
    $namefile = array();

    if(is_dir($folder)){
        if($open = opendir($folder)){
            while(($file = readdir($open)) !== FALSE){
                if($file !== '.' && $file !== '..'){
                    $namefile[count($namefile)] = "$file";
                }
            }
            closedir($open);
        }
    }

    $arrlength = count($namefile);
    for($i = 0; $i < $arrlength; $i++){
        echo "<tr><td>".$namefile[$i]."</td><td>".fsize($namefile[$i])."</td></tr>";
    }
}
?>   
<!DOCTYPE html>
<html>
    <head>
    <style>
        th{
			font-weight: normal; 
			color: #1F75CC; 
			background-color: 
			#F0F9FF; 
			padding:.5em 1em .5em .2em;
			text-align: left;
			cursor:pointer;
			user-select: 
			none;
		}
        table{
			border-collapse: 
			;width:100%;
		}
        body{
			font-family: "lucida grande","Segoe UI",Arial, sans-serif; 
			font-size: 14px;
			width:1024;
			padding:1em;
			margin:0;
		}
    </style>

    </head>
    <body>
        <div>
            <form action=" " method="post">
                Folder Name = 
                <input type="text" name="nama">
                <input type="submit" name="submit" value="Create">                    
            </form>
            <?php
                if(isset($_POST['submit'])){
                    if(!empty($_POST['nama'])){
                        $fname = $_POST['nama'];
                        if((file_exists($fname))&&(is_dir($fname))){
                            echo "Folder/file already exist";
                        }else{
                            mkdir($fname);
                        }
                    }
                }
            ?>
            <br><br>
        </div>
        <div>
            <form action=" " method="post">
                Folder/File Name = 
                <input type="text" name="f">
                <input type="submit" name="del" value="Delete">                    
            </form>
            <?php
                if(isset($_POST['del'])){
                    if(!empty($_POST['f'])){
                        $fname = $_POST['f'];
                        if(file_exists($fname)){
							if(is_dir($fname)){
								rmdir($fname);	
							} else{
								unlink($fname);
							}
                        }else{
                            echo"folder/file not found";
                        }
                    }
                }
            ?>
            <br><br>
			
        </div>
		<div>
			<form action="tes.php" method="post" enctype="multipart/form-data">
				<table>
					<tr><td>Upload File</td><td><input type="file" name="upload"></td></tr>
					<tr><td></td><td><button type="submit" name="submit">Upload</button></td></tr>
				</table>
			</form>
			<?php
				$tmp = $_FILES['upload']['tmp_name'];
				$fname = $_FILES['upload']['name'];
				move_uploaded_file($tmp, $folder . $fname);
			?>
		</div>
        <div>
            <table id="table">
                <tr>
                    <th>Name</th>
                    <th>Size</th>
                </tr>
                <?php
                    draw();
                ?>
            </table>
        </div>
    </body>
</html>