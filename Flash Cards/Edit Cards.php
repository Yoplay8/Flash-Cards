<html>
	<head>
	
		<link rel="stylesheet" type="text/css" href="Style.css">
	
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
			
			margin: 10px 0px 10px 10px;
			padding-left: 1px;
			
		}
	
	</style>
	
	
	<script>
		
		function Validate_Form()
		{
			
			for(var Count = 0; Count < document.forms[0].length; Count++)
			{
				
				if(document.forms[0][Count].value == "")
				{
					
					alert("Please Make Sure All Fields Are Filled In");
					
					return false;
					
				}
				
			}
			
			return true;
			
		}
		
		function Change_Value(Ele)
		{

			Ele.setAttribute('name', '1');
		
			<?php
					
				foreach($_POST as $Key=>$Val)
				{

					if(($Key >= "1") and ($Key <= "3"))
						print("Ele.setAttribute('name', '$Key');");

					
				}

			?>
			
			//return false;

		}
		
		function Delete(Elminate)
		{
			
			var Parent = document.getElementById("Parent");
			var Ele = document.getElementsByName(Elminate.name);
			
			var Count = 0;
			
			
			while(Ele.length > 0)
				Parent.removeChild(Ele[Count]);


			var Save = document.getElementsByTagName("input");
			
			Save[Save.length - 1].click();
			
		}
	
	</script>
	
	
	<?php

		// Hold the file name and path.
		$Folder_Name = "Data";

		
		// Create folder if one doesn't exsist.
		if(!file_exists($Folder_Name))
			mkdir($Folder_Name);
		else
		{
			
			$Flag = True;
			
			if((isset($_POST["1"]) and ($_POST["1"]) == "Save"))
				$File_Name = "/TF.txt";
			elseif((isset($_POST["2"]) and ($_POST["2"]) == "Save"))
				$File_Name = "/MC.txt";
			elseif((isset($_POST["3"]) and ($_POST["3"]) == "Save"))
				$File_Name = "/QA.txt";
			else
				$Flag = False;
			
			
			if($Flag)
			{
				
				$W_File = fopen($Folder_Name . $File_Name, "w");
				
				foreach($_POST as $Question)
				{
					
					if($Question != "Save")
					{

						clearstatcache();
						
						if(filesize($Folder_Name . $File_Name) > 0)
							fwrite($W_File, "\r\n");
						
						foreach($Question as $Val)
							fwrite($W_File, ($Val . ":::"));

						
					}
					
				}
				
				fclose($W_File);
				
				print("<script>");
				
					print("confirm('Questions Saved');");
			
				print("</script>");
				
			}
			
		}

	?>
	

	
	<body style="background-color: 79EA13">
		<form action="" onsubmit="return Validate_Form();" name="Add" method="post">
			<div style="margin: 30px 0px 0px 0px" align="center">	
				<input type="submit" id="Link" name="1" value="True/ False">
				
				<input type="submit" id="Link" name="2" value="Multiple Choice">
				
				<input type="submit" id="Link" name="3" value="QnA">

				
				<div id="Parent" style="overflow: auto; height: 65%; width: 55%;" class="Center_Of_Page">
				
					<?php
					
						$Flag = True;
						
						clearstatcache();
						
						if(isset($_POST["1"]))
						{
							
							$File_Name = "/TF.txt";

							
							if((file_exists($Folder_Name . $File_Name)) and (filesize($Folder_Name . $File_Name) > 0))
							{
								
								$Flag = False;
								$R_File = fopen($Folder_Name . $File_Name, "r");
								
								while(!feof($R_File))
								{
										
										$Sections = explode(":::", fgets($R_File));
						
										print("<script>");
										
											print("var Parent = document.getElementById('Parent');
												   var Parent_Size = (Parent.childNodes.length + 4);
												   
												   var Ele = document.createElement('select');
												   var Child_1 = document.createElement('option');
												   var Child_2 = document.createElement('option');
												   
												   Child_1.innerHTML = 'True';
												   Child_2.innerHTML = 'False';
												   
												   Ele.setAttribute('id', 'Make_Room');
												   
												   if('$Sections[0]' == 'True')
													   Child_1.setAttribute('selected', 'true');
												   else
													   Child_2.setAttribute('selected', 'true');
												   
												   
												   Ele.appendChild(Child_1);
												   Ele.appendChild(Child_2);
												   
												   Ele.setAttribute('name', Parent_Size + '[]');
												   
												   Parent.appendChild(Ele);
												   
												   Ele = document.createElement('input');
												   
												   Ele.setAttribute('id', 'Make_Room');
												   Ele.setAttribute('value', '$Sections[1]');
												   Ele.setAttribute('size', '40');
												   Ele.setAttribute('name', Parent_Size + '[]');
												   
												   Parent.appendChild(Ele);

												   Ele = document.createElement('input');
												   Ele.setAttribute('name', Parent_Size + '[]');
												   Ele.setAttribute('type', 'submit');
												   Ele.setAttribute('onclick', 'Delete(this)');
												   Ele.setAttribute('value', 'Delete');
												   Ele.setAttribute('id', 'Make_Room');
												   
												   Parent.appendChild(Ele);
												   
												   
												   Ele = document.createElement('br');
												   
												   Ele.setAttribute('name', Parent_Size + '[]');
												   
												   Parent.appendChild(Ele);
												   
												   ");
										
										print("</script>");

								}
								
								fclose($R_File);

							}
							
						}
						elseif(isset($_POST["2"]))
						{
							
							$File_Name = "/QA.txt";
							
							if((file_exists($Folder_Name . $File_Name)) and (filesize($Folder_Name . $File_Name) > 0))
							{
								
								$Flag = False;
								$R_File = fopen($Folder_Name . $File_Name, "r");
								
								while(!feof($R_File))
								{
										
										$Sections = explode(":::", fgets($R_File));
						
										print("<script>");
										
											print("var Parent = document.getElementById('Parent');
												   var Parent_Size = Parent.childNodes.length;

												   
												   Ele = document.createElement('input');
												   
												   Ele.setAttribute('id', 'Make_Room');
												   Ele.setAttribute('value', '$Sections[0]');
												   Ele.setAttribute('size', '40');
												   Ele.setAttribute('name', Parent_Size + '[]');
												   
												   Parent.appendChild(Ele);
												   
												   
												   
												   Ele = document.createElement('input');
												   
												   Ele.setAttribute('id', 'Make_Room');
												   Ele.setAttribute('value', '$Sections[1]');
												   Ele.setAttribute('size', '40');
												   Ele.setAttribute('name', Parent_Size + '[]');
												   
												   Parent.appendChild(Ele);

												   
												   Ele = document.createElement('input');
												   Ele.setAttribute('name', Parent_Size + '[]');
												   Ele.setAttribute('type', 'submit');
												   Ele.setAttribute('onclick', 'Delete(this)');
												   Ele.setAttribute('value', 'Delete');
												   Ele.setAttribute('id', 'Make_Room');
												   
												   Parent.appendChild(Ele);
												   
												   
												   Ele = document.createElement('br');
												   
												   Ele.setAttribute('name', Parent_Size + '[]');
												   
												   Parent.appendChild(Ele);
		
												   ");
										
										print("</script>");

								}
								
								fclose($R_File);

							}
							
						}
						elseif(isset($_POST["3"]))
						{
							
							$File_Name = "/QA.txt";
							
							if((file_exists($Folder_Name . $File_Name)) and (filesize($Folder_Name . $File_Name) > 0))
							{
								
								$Flag = False;
								$R_File = fopen($Folder_Name . $File_Name, "r");
								
								while(!feof($R_File))
								{
										
										$Sections = explode(":::", fgets($R_File));
						
										print("<script>");
										
											print("var Parent = document.getElementById('Parent');
												   var Parent_Size = Parent.childNodes.length;

												   
												   Ele = document.createElement('input');
												   
												   Ele.setAttribute('id', 'Make_Room');
												   Ele.setAttribute('value', '$Sections[0]');
												   Ele.setAttribute('size', '40');
												   Ele.setAttribute('name', Parent_Size + '[]');
												   
												   Parent.appendChild(Ele);
												   
												   
												   
												   Ele = document.createElement('input');
												   
												   Ele.setAttribute('id', 'Make_Room');
												   Ele.setAttribute('value', '$Sections[1]');
												   Ele.setAttribute('size', '40');
												   Ele.setAttribute('name', Parent_Size + '[]');
												   
												   Parent.appendChild(Ele);

												   
												   Ele = document.createElement('input');
												   Ele.setAttribute('name', Parent_Size + '[]');
												   Ele.setAttribute('type', 'submit');
												   Ele.setAttribute('onclick', 'Delete(this)');
												   Ele.setAttribute('value', 'Delete');
												   Ele.setAttribute('id', 'Make_Room');
												   
												   Parent.appendChild(Ele);
												   
												   
												   Ele = document.createElement('br');
												   
												   Ele.setAttribute('name', Parent_Size + '[]');
												   
												   Parent.appendChild(Ele);
		
												   ");
										
										print("</script>");

								}
								
								fclose($R_File);

							}
							
						}

						
						
						if($Flag)
							print("<h2>" . "No Items To Display" . "</h2>");
						else
						{
							
							print("<script>");
								
								print("Ele = document.createElement('input');
								
									   Ele.setAttribute('type', 'submit');
									   Ele.setAttribute('onclick', 'Change_Value(this)');
									   Ele.setAttribute('value', 'Save');
									   Ele.setAttribute('id', 'Make_Room');
									   
									   Parent.appendChild(Ele);
								");

							print("</script>");
							
						}

					
					?>
				
				</div>
				
			</div>
				
		</form>
		
	</body>	
	
</html>