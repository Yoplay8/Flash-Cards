<html>
	<head>
	
		<link rel="stylesheet" type="text/css" href="Style.css">
	
	</head>
	
	
	<title>
	
		Edit Cards
	
	</title>
	
	
	<style>
	
		tr:hover, #Link:hover
		{
			
			background-color: D60000;
			
		}
		
		#Make_Room
		{
			
			margin: 10px 0px 10px 10px;
			padding-left: 1px;
			
		}
		
		input#Options
		{
			
			margin: 15px -5px 10px 10px;
			
		}
		
		tr
		{

			border: 10px solid black;

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
					{
						
						print("Ele.setAttribute('name', '$Key');");

						break;
						
					}
					
				}

			?>
			
			//return false;

		}
		
		function Change(Ele)
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
		
		function Delete(Elminate)
		{
			
			var Parent = document.getElementsByName(Elminate.name);
			
			Parent = Parent[0].parentElement.parentElement;
			
			Parent.parentElement.removeChild(Parent);
			
			
			Save = document.getElementsByTagName("input");
			
			Save[Save.length - 1].click();
			
		}
		
		//******************************************************************************
		//
		// Less_Lines - Will remove lines from the multiple choice and either remove the
		//              remove button or make the add button visible again.
		//
		//******************************************************************************
		function Less_Lines(Ele)
		{
			
			// Used to determine when to remove or redisplay buttons.
			var Parent = Ele.parentElement;
			var Num_Of_Children = Parent.childNodes.length;
			
			// Used to find only the buttons.
			var Buttons = Parent.getElementsByTagName('button');
			

			Parent.childNodes[Num_Of_Children - 4].remove();
			Num_Of_Children = Parent.childNodes.length;
			Parent.childNodes[Num_Of_Children - 4].remove();
			Num_Of_Children = Parent.childNodes.length;
			Parent.childNodes[Num_Of_Children - 4].remove();
			Num_Of_Children = Parent.childNodes.length;
			
			// Determine when to remove or redisplay the add/ remove buttons.
			if(Num_Of_Children == 7)
			   Buttons[1].remove();
		    else if(Num_Of_Children == 31)
			   Buttons[0].setAttribute("style", "visibility: visible");

		}
		
		//********************************************************************************
		//
		// More_Lines - Will add more lines to the multiple choice and either hide the add
		//              button or create the remove button.
		//
		//********************************************************************************
		function More_Lines(Ele)
		{
			
			// Used to determine when to create or hide the buttons and make custom place
			// holders for the new lines.
			var Parent = Ele.parentElement;
			var Num_Of_Children = Parent.childNodes.length;
		   
			
		   // Once the remove button is created we need to subtract one to keep the custom
		   // messages consistent and to make sure the new lines are inserted in the correct
		   // spot.
		    
		   
			
			// Holds the letter for the custom placeholder.
			var Letter = ((Num_Of_Children / 3) - 1);
			
			
			
			// Limit the multiple choice to 9 options.
			if(Letter <= 10)
			{
				
				
				
				var New_Line = document.createElement("br");
				
				if(Num_Of_Children >= 10)
					Num_Of_Children--;
				
				Parent.insertBefore(New_Line, Parent.childNodes[(Num_Of_Children - 1)]);
				
				
				
				Num_Of_Children = Parent.childNodes.length;
				
				var New_Line = document.createElement("input");
				
				New_Line.setAttribute("size", "4");
				New_Line.setAttribute("onclick", "Change(this)");
				New_Line.setAttribute("name", Ele.value);
				New_Line.setAttribute("value", "Incorrect");
				New_Line.setAttribute("id", "Button_Style");
				New_Line.setAttribute("unselectable", "on");
				New_Line.setAttribute("onselectstart", "return false;");
				New_Line.setAttribute("onmousedown", "return false;");
				
				if(Num_Of_Children >= 10)
					Num_Of_Children--;
				
				Parent.insertBefore(New_Line, Parent.childNodes[(Num_Of_Children - 2)]);
				
				Num_Of_Children = Parent.childNodes.length;
				
				// Holds the new line to be added.
				New_Line = document.createElement('input');
		   
		   
				New_Line.setAttribute('id', 'Options');
				New_Line.setAttribute('size', 40);
			   
			    Letter = String.fromCharCode(65 + Letter);
			   
			    New_Line.setAttribute('placeholder', 'Enter In Option ' + Letter);
			    New_Line.setAttribute('name', Ele.value);

				if(Num_Of_Children >= 10)
					Num_Of_Children--;
				
			    Parent.insertBefore(New_Line, Parent.childNodes[(Num_Of_Children - 2)]);
				
				Num_Of_Children = Parent.childNodes.length;
				
		   }

		   
		   // Determine when to create the remove button or hide the add button.
		   if(Num_Of_Children >= 9)
		   {
			   
			   var Find_Btns = Parent.getElementsByTagName("button");
			   
			   if(Find_Btns.length < 2)
			   {
			   
				   // Holds the remove button.
				   var Remove_Btn = document.createElement('button');
				   
				   Remove_Btn.setAttribute("onclick", "Less_Lines(this); return false;");
				   Remove_Btn.setAttribute("style", "margin-left: 10px");
				   Remove_Btn.innerHTML = "Remove An Option";
				   Remove_Btn.setAttribute('value', ' ');
				   
				   Parent.appendChild(Remove_Btn);
			   
			   }
			   else if(Num_Of_Children == 34)
			   {
				   
				   // Holds the add button.
				   var Button = Parent.getElementsByTagName('button')[0];

				   Button.setAttribute("style", "visibility: hidden");
			   
			   }
			   
		   }
		   
  
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

				
				<table id="Parent" style="border-collapse:collapse; display: block; overflow: auto; height: 65%; text-align: center" class="Center_Of_Page">
				
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
												   var Cell = document.createElement('td');
												   
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
												   
												   Cell.appendChild(Ele);
												   
												   Ele = document.createElement('input');
												   
												   Ele.setAttribute('id', 'Make_Room');
												   Ele.setAttribute('value', '$Sections[1]');
												   Ele.setAttribute('size', '50');
												   Ele.setAttribute('name', Parent_Size + '[]');
												   
												   Cell.appendChild(Ele);

												   
												   Ele = document.createElement('br');
												   
												   Cell.appendChild(Ele);
												   
												   
												   Ele = document.createElement('input');
												   Ele.setAttribute('name', Parent_Size + '[]');
												   Ele.setAttribute('type', 'submit');
												   Ele.setAttribute('onclick', 'Delete(this)');
												   Ele.setAttribute('value', 'Delete');
												   Ele.setAttribute('id', 'Make_Room');
												   
												   Cell.appendChild(Ele);

												   
												   var Row = document.createElement('tr');
												   
												   
												   Row.appendChild(Cell);
												   Parent.appendChild(Row);
												   
												   ");
										
										print("</script>");

								}
								
								fclose($R_File);

							}
							
						}
						elseif(isset($_POST["2"]))
						{
							
							$File_Name = "/MC.txt";
							
							if((file_exists($Folder_Name . $File_Name)) and (filesize($Folder_Name . $File_Name) > 0))
							{
								
								$Flag = False;
								$R_File = fopen($Folder_Name . $File_Name, "r");
								
								while(!feof($R_File))
								{

									$Sections = explode(":::", fgets($R_File));
					

									print("<script>");
									
										print("var Parent = document.getElementById('Parent');
											   var Parent_Size = Parent.childNodes.length + 4;
											   var Row = document.createElement('tr');
											   var Cell = document.createElement('td');
											   
											   var Ele = document.createElement('input');
											   
											   Ele.setAttribute('id', 'Make_Room');
											   Ele.setAttribute('value', '$Sections[0]');
											   Ele.setAttribute('size', '51');
											   Ele.setAttribute('name', Parent_Size + '[]');
											   
											   Cell.appendChild(Ele);
											   
											   ");
									
									print("</script>");

									$Count_Lines = 0;
									
									for($Count = 1, $Countt = 2; $Count < (sizeof($Sections) - 1); $Count += 2, $Countt = ($Count + 1))
									{
										
										$Count_Lines++;
										
										print("<script>");
									
											print("Ele = document.createElement('br');
											
												   Cell.appendChild(Ele);
											
												   Ele = document.createElement('input');

											
												   Ele.setAttribute('onmousedown', 'return false;');
												   Ele.setAttribute('onselectstart', 'return false;');
												   Ele.setAttribute('unselectable', 'on');
												   Ele.setAttribute('onclick', 'Change(this)');
												   Ele.setAttribute('value', '$Sections[$Count]');
												   Ele.setAttribute('size', '4');
												   Ele.setAttribute('name', Parent_Size + '[]');
												   Ele.setAttribute('id', 'Button_Style');
												   
												   if('$Sections[$Count]' == 'Incorrect')
													   Ele.setAttribute('style', 'cursor: pointer; text-align: center; background-color: red;');
												   else
													   Ele.setAttribute('style', 'cursor: pointer; text-align: center; background-color: green;');
												   
												   Cell.appendChild(Ele);
												   
												   Ele = document.createElement('input');
												   
												   Ele.setAttribute('id', 'Make_Room');
												   Ele.setAttribute('value', '$Sections[$Countt]');
												   Ele.setAttribute('size', '40');
												   Ele.setAttribute('name', Parent_Size + '[]');
												   
												   Cell.appendChild(Ele);
												   
												   ");
									
										print("</script>");
										
									}
									
									print("<script>");
									
										print("Ele = document.createElement('br');
											
											   Cell.appendChild(Ele);
										
											   Ele = document.createElement('button');
										
											   Ele.setAttribute('onclick', 'More_Lines(this); return false;');
											   Ele.innerHTML = 'Add An Option';
											   Ele.setAttribute('value', Parent_Size + '[]');
											   
											   Cell.appendChild(Ele);

											   ");
									
									print("</script>");
									
									if(($Count_Lines >= 2) and ($Count_Lines <= 9))
									{
										print("<script>");
										
											print('var Remove_Btn = document.createElement("button");
						   
												   Remove_Btn.setAttribute("onclick", "Less_Lines(this); return false;");
												   Remove_Btn.setAttribute("style", "margin-left: 10px");
												   Remove_Btn.innerHTML = "Remove An Option";
												   Remove_Btn.setAttribute("value", " ");
												   
												   Cell.appendChild(Remove_Btn);
												   
												   ');
											   
										print("</script>");
										
									}
									elseif($Count_Lines == 10)
									{
										
										print('Cell[Cell.childNodes.length - 1].setAttribute("style", "visibility: hidden");');
										
									}
									
									print("<script>");
									
										print("var Row = document.createElement('tr');
													   
											   Row.appendChild(Cell);
											   
											   Cell = document.createElement('td');
											   
											   
											   Ele = document.createElement('input');
											   Ele.setAttribute('name', Parent_Size + '[]');
											   Ele.setAttribute('type', 'submit');
											   Ele.setAttribute('onclick', 'Delete(this)');
											   Ele.setAttribute('value', 'Delete');
											   Ele.setAttribute('id', 'Make_Room');
											   
											   
											   Cell.appendChild(Ele);
											   
											   Row.appendChild(Cell);
											   
											   Parent.appendChild(Row);
											   
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
											   var Parent_Size = Parent.childNodes.length + 4;
											   var Row = document.createElement('tr');
											   var Cell = document.createElement('td');

											   
											   var Ele = document.createElement('input');
											   
											   Ele.setAttribute('id', 'Make_Room');
											   Ele.setAttribute('value', '$Sections[0]');
											   Ele.setAttribute('size', '50');
											   Ele.setAttribute('name', Parent_Size + '[]');
											   
											   Cell.appendChild(Ele);
											   
											   
											   
											   Ele = document.createElement('input');
											   
											   Ele.setAttribute('id', 'Make_Room');
											   Ele.setAttribute('value', '$Sections[1]');
											   Ele.setAttribute('size', '50');
											   Ele.setAttribute('name', Parent_Size + '[]');
											   
											   Cell.appendChild(Ele);

											   Row.appendChild(Cell);
											   
											   Cell = document.createElement('td');
											   
											   
											   Ele = document.createElement('input');
											   Ele.setAttribute('name', Parent_Size + '[]');
											   Ele.setAttribute('type', 'submit');
											   Ele.setAttribute('onclick', 'Delete(this)');
											   Ele.setAttribute('value', 'Delete');
											   Ele.setAttribute('id', 'Make_Room');
											   
											   
											   Cell.appendChild(Ele);
											   
											   Row.appendChild(Cell);
											   
											   Parent.appendChild(Row);
	
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
				
				</table>
				
			</div>
				
		</form>
		
	</body>	
	
</html>