<html>
	<head>
	
		<link rel="stylesheet" type="text/css" href="style.css">
	
	</head>
	
	
	<title>
	
		Test Mode
	
	</title>
	
	<style>
	
		#Make_Room
		{
			
			margin: 10px 0px 10px 10px;
			padding-left: 1px;
			
		}
		
		#Button_Style
		{

			cursor: pointer;
			text-align: center;
			background-color: red;
			margin: 10px 0px 10px 10px;
			padding-left: 1px;
			
		}
		
		td#Left
		{
		
			text-align: left;
			
		}
	
	</style>
	
	<?php
	
		$Hold_Questions = array();

	?>
	
	<script>
	
		function Change(Ele, Answer = null)
		{

			Ele.setAttribute('name', 'Clicked[]');
			Ele.setAttribute('value', Ele.innerHTML);
			
			if(Ele.tagName == 'BUTTON')
				Check_Answer([Answer]);
			
		}
		
		function Check_Answer(Answer)
		{
			
			var Picked = document.getElementsByName("Clicked[]");
			var Flag = true;
			
			
			for(var Count = 0; Count < Picked.length; Count++)
			{
				
				if(Picked[Count].value != Answer[Count])
				{
					
					alert("Wrong Answer");
				
					Flag = false;
					
					if(Picked[Count].tagName == "BUTTON")
						Picked[Count].removeAttribute("name");
					
					break;
					
				}
				
			}
			
			if(Flag)
			{
				
				var Parent = document.getElementById("Parent");
				
				for(var Count = 0; Count < Parent.childNodes.length; Count)
				{
					
					Parent.childNodes[Count].remove();
					
				}
				
				New_Question();
				
			}

		}
		
		function New_Question()
		{
			
			var Hold_Questionss = <?php echo json_encode($Hold_Questions); ?>;
			
			document.write(Hold_Questionss.length);
			
			
		}
		
		function Changee(Ele)
		{
			
			
			if(Ele.getAttribute("value") == "Incorrect")
			{
				
				Ele.setAttribute("value", "Correct");
			
				Ele.setAttribute("style", "background-color: green;");
				
			}
			else
			{
				
				Ele.setAttribute("value", "Incorrect");
			
				Ele.setAttribute("style", "background-color: red;");
				
			}
			
		}
	
	</script>
	
	<body style="background-color: purple;">
	
		<div style="margin: 30px 0px 0px 0px" align="center">
		
			<h1>Level X</h1>
			
			<div id="Parent" class="Center_Of_Page">
			
				<?php

					global $Hold_Questions;
					$Flag = true;
					
					// Hold the file name and path.
					$Folder_Name = "Data";

					
					// Create folder if one doesn't exsist.
					if(!file_exists($Folder_Name))
						mkdir($Folder_Name);
					else
					{

						$File_Name = "/TF.txt";
								
						if(file_exists($Folder_Name . $File_Name))
						{
						
							$Flag = false;
							$R_File = fopen($Folder_Name . $File_Name, "r");
							
							while(!feof($R_File))
							{
								
								$Line = fgets($R_File);
								
								if($Line != "")
									array_push($Hold_Questions, "TF:::" . $Line);
								
							}
							
						}
						
						$File_Name = "/MC.txt";
								
						if(file_exists($Folder_Name . $File_Name))
						{
						
							$Flag = false;
							$R_File = fopen($Folder_Name . $File_Name, "r");
							
							while(!feof($R_File))
							{
								
								$Line = fgets($R_File);
								
								if($Line != "")
									array_push($Hold_Questions, "MC:::" . $Line);
								
							}
							
						}
						
						$File_Name = "/QA.txt";
								
						if(file_exists($Folder_Name . $File_Name))
						{
						
							$Flag = false;
							$R_File = fopen($Folder_Name . $File_Name, "r");
							
							while(!feof($R_File))
							{
								
								$Line = fgets($R_File);
								
								if($Line != "")
									array_push($Hold_Questions, "QA:::" . $Line);
								
							}
							
						}
						
						if(($Flag) or (sizeof($Hold_Questions) == 0))
							print("<h2>" . "No Items To Display" . "</h2>");
						else
						{

							$Index = mt_rand(0, (sizeof($Hold_Questions) - 1));
							
							$Sections = explode(":::", $Hold_Questions[$Index]);

							
							if($Sections[0] == "TF")
							{
								
								print("<script>");
								
									print("var Parent = document.getElementById('Parent');
									
										   var Ele = document.createElement('h2');
									
										   Ele.innerHTML = '$Sections[2]';
										   
										   Parent.appendChild(Ele);
										   
										   Ele = document.createElement('br');
										   
										   Parent.appendChild(Ele);
										   
										   Ele = document.createElement('button');
										   
										   Ele.setAttribute('onclick', 'Change(this, \'$Sections[1]\'); return false;');
										   Ele.innerHTML = 'True';
										   
										   Parent.appendChild(Ele);
										   
										   Ele = document.createElement('button');
										   
										   Ele.setAttribute('onclick', 'Change(this, \'$Sections[1]\'); return false;');
										   Ele.innerHTML = 'False';
										   Ele.setAttribute('id', 'Make_Room');
										   
										   
										   Parent.appendChild(Ele);
									
									
									");

								print("</script>");
								
							}
							elseif($Sections[0] == "MC")
							{
								
								print("<script>");
								
									print("var Parent = document.getElementById('Parent');
										   var Row = document.createElement('tr');
										   var Cell = document.createElement('td');
									
										   Cell.setAttribute('colspan', '2');
										   
										   Parent.type = 'table';
									
										   var Ele = document.createElement('h2');
									
										   Ele.innerHTML = '$Sections[1]';
										   
										   Cell.appendChild(Ele);
										   Row.appendChild(Cell);
										   Parent.appendChild(Row);
										   
										");
										   
									print("</script>");
										

									print("<script>");
									
										print("var Answers = []");
									
									print("</script>");
									
									for($Count1 = 2, $Count2 = 3; $Count1 < sizeof($Sections); $Count1 += 2, $Count2 = ($Count1 + 1))
									{
										
										print("<script>");
										
											print("Answers.push('$Sections[$Count1]');
											
												   Cell = document.createElement('td');
											       Row = document.createElement('tr');
												
												   Ele = document.createElement('input');
												
												   Ele.setAttribute('onclick', 'Changee(this)');
												   Ele.setAttribute('name', 'Clicked[]');
												   Ele.setAttribute('unselectable', 'on');
												   Ele.setAttribute('onselectstart', 'return false;');
												   Ele.setAttribute('onmousedown', 'return false;');
												   Ele.setAttribute('value', 'Incorrect');
												   Ele.setAttribute('size', '4');
												   Ele.setAttribute('id', 'Button_Style');
												  
												   Cell.appendChild(Ele);
												   Row.appendChild(Cell);
												   
												   Cell = document.createElement('td');
												   
												   Cell.setAttribute('style', 'padding-left: 10px');
												   Cell.setAttribute('width', '100%');
												   Cell.setAttribute('id', 'Left');
												   
												   Ele = document.createTextNode('$Sections[$Count2]');
												  
												   Cell.appendChild(Ele);
												   Row.appendChild(Cell);
												  
												   Parent.appendChild(Row);
											
												  ");
										
										print("</script>");
										
									}
									
									print("<script>");
									
										print("Ele = document.createElement('button');

											   
											   Ele.setAttribute('id', 'Make_Room');
											   Ele.setAttribute('onclick', 'Check_Answer(Answers); return false;');
												
											   Ele.innerHTML = 'Submit';
											   
											   Parent.appendChild(Ele);
											   
											   ");
									
									print("</script>");
								
								
							}
							elseif($Sections[0] == "QA")
							{
								
								print("<script>");
								
									print("var Parent = document.getElementById('Parent');
									
										   var Ele = document.createElement('h2');
									
										   Ele.innerHTML = '$Sections[1]';
										   
										   Parent.appendChild(Ele);
										   
										   Ele = document.createElement('br');
										   
										   Parent.appendChild(Ele);
										   
										   Ele = document.createElement('input');
										   
										   Ele.setAttribute('placeholder', 'Answer');
										   Ele.setAttribute('size', '50');
										   Ele.setAttribute('name', 'Clicked[]');
										   
										   Parent.appendChild(Ele);
										   
										   Ele = document.createElement('br');
										   
										   Parent.appendChild(Ele);
										   
										   Ele = document.createElement('button');
										   
										   Ele.setAttribute('id', 'Make_Room');
										   Ele.setAttribute('onclick', 'Check_Answer([\'$Sections[2]\'])');
											
										   Ele.innerHTML = 'Submit';
										   
										   Parent.appendChild(Ele);

									");

								print("</script>");
								
							}
							
							array_splice($Hold_Questions, $Index, 1);
						
						}
						
					}

				?>
			
			</div>
		
		</div>
	
	</body>

</html>