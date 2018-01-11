<html>
	<head>
	
		<link rel="stylesheet" type="text/css" href="Style.css">
	
	</head>
	
	
	<title>
	
		Test Mode
	
	</title>
	
	<style>
	
		.Menu_Style:hover
		{
			
			background-color: #F6EA62;
			
		}
		
		.Menu_Options:hover
		{

			background-color: purple;

		}
		
		/***************************************************************************************
		*
		* I DONT WANT TO DEAL WITH THIS RIGHT NOW. This is differnt that whats in the style file
		* but I dont want to bother fixing this right now. Ill come back to this later.
		*
		***************************************************************************************/
		.Button_Style
		{

			cursor: pointer;
			text-align: center;
			background-color: red;
			margin: 10px 0px 10px 10px;
			padding-left: 1px;
			
		}
		
		td.Left
		{
		
			text-align: left;
			
		}
	
	</style>
	
	<?php
	
		// Used as a global variable to hold all the questions.
		$Hold_Questions = array();

	?>
	
	<script>
	
		/////////////////////////////////////////////////////////////////////////////////
		//
		// Change - Used for the true and false part so we know which button was clicked.
		//
		/////////////////////////////////////////////////////////////////////////////////
		function Change(Ele, Answer = null)
		{

			Ele.setAttribute('name', 'Clicked[]');
			Ele.setAttribute('value', Ele.innerHTML);
			
			// This was in case we ran into the multiple choice part. Not sure ill be using this way still.
			if(Ele.tagName == 'BUTTON')
				Check_Answer([Answer]);
			
		}
		
		//////////////////////////////////////////////////////////////////////
		//
		// Check_Answer - Is what checks to see if the users input is correct.
		//
		//////////////////////////////////////////////////////////////////////
		function Check_Answer(Answer)
		{
			
			// Find all the multiple choice answers.
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
		
		function Display_TF(var Sections)
		{
			
			document.write("adasdsdasdasdas");
			
		}
		
		function Display_MC()
		{
			
			
		}
		
		function Display_QA()
		{
			
			
		}
		
		function New_Question()
		{
			
			var Hold_Questionss = <?php echo json_encode($Hold_Questions); ?>;
			
			
			
			
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
		
		//////////////////////////////////////////////////////////////////////
		//
		// Menu_Options - Will be the click event to help the user get around.
		//
		//////////////////////////////////////////////////////////////////////
		function Menu_Options(Ele)
		{
			
			// Depending on the current state change the menu options.
			if(Ele.getAttribute("name") == "Closed")
			{
				
				Ele.innerHTML = "";
				
				var New_Line = document.createElement("a");
				
				New_Line.innerHTML = "Add Cards";
				New_Line.setAttribute("href", "http://localhost:8080/Flash%20Cards/Add%20Cards.php");
				New_Line.setAttribute("class", "Menu_Options");
				
				Ele.appendChild(New_Line);
				
				
				New_Line = document.createElement("a");
				
				
				New_Line.innerHTML = "Edit Cards";
				New_Line.setAttribute("href", "http://localhost:8080/Flash%20Cards/edit%20Cards.php");
				New_Line.setAttribute("class", "Menu_Options");
				
				
				Ele.appendChild(New_Line);
				
				Ele.setAttribute("name", "Opened");
				Ele.setAttribute("style", "width: 16%");
				
			}
			else
			{
				
				Ele.innerHTML = "Menu";
				
				Ele.setAttribute("name", "Closed");
				Ele.setAttribute("style", "width: 10%");
				
				
			}
			
		}	
	
	</script>
	
	<center>
		<div class="Menu_Style" name="Closed" onclick="Menu_Options(this)">
	
			Menu
	
		</div>
	</center>
	
	<body class="Border_Style" style="background-color: purple;">
	
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
								
									print("alert(123);Display_TF('&$Sections');");
								
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