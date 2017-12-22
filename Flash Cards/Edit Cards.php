<html>
	<head>
	
		<link rel="stylesheet" type="text/css" href="style.css">
	
	</head>
	
	
	<title>
	
		Edit Cards
	
	</title>
	
	
	<style>
	
		#Link:hover
		{
			
			background-color: D60000;
			
		}
		
		#Make_Room
		{
			
			margin: 10px 0px 10px 10px
			
		}
	
	</style>
	
	
	<script>
	
		function Validate_Form()
		{
			
			//var php_var = "<?php echo 123; ?>";
			
			//document.write(php_var);
			
			return true;
			
		}
		
		function Save(var Array, var Question, $Located_At)
		{
			
			
		}
	
	</script>
	
	
	<body style="background-color: 79EA13">
	
	</body>
		<form action="" onsubmit="return Validate_Form();" name="Add" method="post">
			<div id="Super_Parent" style="margin: 30px 0px 0px 0px" align="center">	
				<input type="submit" onclick="Testing(this)" id="Link" name="1" value="True/ False">
				
				<input type="submit" id="Link" name="2" value="Multiple Choice">
				
				<input type="submit" id="Link" name="3" value="QnA">

				
				<div id="Parent" style="overflow: auto; height: 65%; width: 50%;" class="Center_Of_Page">
				
					<?php
					
						// Hold the file name and path.
						$Folder_Name = "Data";
						$File_Name = "/Cards.txt";
						
						$TF = array();
						$MC = array();
						$QA = array();
						
						// Create folder if one doesn't exsist.
						if(!file_exists($Folder_Name))
							mkdir($Folder_Name);
						elseif(file_exists($Folder_Name . $File_Name))
						{
						
							$R_File = fopen($Folder_Name . $File_Name, "r");
							
							
							// Loop through all fields.
							while(!feof($R_File))
							{
								
								$Line = fgets($R_File);
								$Sections = explode(":::", $Line);
								
								if($Sections[0] == "TF")
									array_push($TF, $Line);
								elseif($Sections[0] == "MC")
									array_push($MC, $Line);
								else
									array_push($QA, $Line);
								
							}
					
						}
						
						

						$Flag = false;

						if(isset($_POST["1"]))
						{
							
							if(sizeof($TF) > 0)
							{
								
								foreach($TF as $Question)
								{
									
									$Sections = explode(":::", $Question);
					
										print("<script>");
										
											print("var Parent = document.getElementById('Parent');");
											
											print("var Ele = document.createElement('select');");
											print("var Child_1 = document.createElement('option');");
											print("var Child_2 = document.createElement('option');");
											
											print("Child_1.innerHTML = 'True';");
											
											print("Child_2.innerHTML = 'False';");
											
											print("Ele.setAttribute('id', 'Make_Room');");
											
											print("if('$Sections[1]' == 'True')
													   Child_1.setAttribute('selected', 'true');
												   else
													   Child_2.setAttribute('selected', 'true');");
											
											
											print("Ele.appendChild(Child_1);");
											print("Ele.appendChild(Child_2);");
											
											print("Parent.setAttribute('name', 'Parent.length');");
											
											print("Parent.appendChild(Ele);");
											
											
											print("Ele = document.createElement('input');");
											
											print("Ele.setAttribute('id', 'Make_Room');");
											
											print("Ele.setAttribute('value', '$Sections[2]');");
											print("Ele.setAttribute('size', '40');");
											
											print("Parent.setAttribute('name', 'Parent.length');");
											
											print("Parent.appendChild(Ele);");

											
											print("Ele = document.createElement('button');");
											
											print("Parent.setAttribute('name', 'Parent.length');");
											
											print("Ele.setAttribute('onclick', 'Save($TF, $Question, this.name)');");
											
											print("Ele.innerHTML = 'Save';");
											print("Ele.setAttribute('id', 'Make_Room');");
											
											print("Parent.appendChild(Ele);");
											
											print("Ele = document.createElement('br');");
											
											print("Parent.appendChild(Ele);");
										
										print("</script>");
									
								}
								
							}
							else
								$Flag = true;
							
						}
						elseif(isset($_POST["2"]))
						{
							
							if(sizeof($MC) > 0)
							{
								print("dfghj");
							}
							else
								$Flag = true;
							
						}
						elseif(isset($_POST["3"]))
						{
							
							if(sizeof($QA) > 0)
							{
								print("dfghj");
							}
							else
								$Flag = true;
							
						}
						
						if($Flag)
							print("<h2>" . "No Items To Display" . "</h2>");

					
					?>
				
				</div>
				
			</div>
				
		</form>
		
</html>