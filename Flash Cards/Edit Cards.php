<html>
	<head>
	
		<link rel="stylesheet" type="text/css" href="Style.css">
	
	</head>
	
	
	<title>
	
		Edit Cards
	
	</title>
	
	
	<style>
	
		tr:hover, .Link:hover, .Menu_Style:hover
		{
			
			background-color: D60000;
			
		}
		
		tr
		{

			border: 10px solid black;

		}
		
		.Menu_Options:hover
		{

			background-color: 79EA13;

		}
	
	</style>
	
	
	<script>
		
		////////////////////////////////////////////////////////////////////////////////////
		//
		// Validate_Form - Looks for any fields that are empty before the form is submitted.
		//
		// Note: Users cant leave page unless fields are filled. Fix this so users can leave
		//       but the page wont be saved.
		//
		////////////////////////////////////////////////////////////////////////////////////
		function Validate_Form()
		{
			
			// Look through all the input fields.
			for(var Count = 0; Count < document.forms[0].length; Count++)
			{
				
				// If input is emepty create an alert message.
				if(document.forms[0][Count].value == "")
				{
					
					alert("Please Make Sure All Fields Are Filled In");
					
					return false;
					
				}
				
			}
			
			return true;
			
		}
		
		//////////////////////////////////////////////////////////////////////////////////////
		//
		// Change_Value - Is used on the save button so we know which tab was clicked on so we
		//                save to the correct file.
		//
		//////////////////////////////////////////////////////////////////////////////////////
		function Change_Value(Ele)
		{

			Ele.setAttribute('name', '1');
		
			<?php
					
				// Loop through all the fields from form.
				foreach($_POST as $Key=>$Val)
				{

					// Find the tab that was clicked on.
					if(($Key >= "1") and ($Key <= "3"))
					{
						
						print("Ele.setAttribute('name', '$Key');");

						break;
						
					}
					
				}

			?>
			
			//return false;

		}
		
		///////////////////////////////////////////////////////////////////////
		//
		// Change - Will make the multiple choice input fields change on click.
		//
		///////////////////////////////////////////////////////////////////////
		function Change(Ele)
		{
			
			// Change element to either Incorrect or Correct depending on current state.
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
		
		///////////////////////////////////////////
		//
		// Delete - Will delete the passed element.
		//
		///////////////////////////////////////////
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

				// Holds the next element to be added.
				var New_Line = document.createElement("br");
				
				
				// Position the next element in the correct spot.
				if(Num_Of_Children >= 10)
					Num_Of_Children--;
				
				Parent.insertBefore(New_Line, Parent.childNodes[(Num_Of_Children - 1)]);

				Num_Of_Children = Parent.childNodes.length;
				
				New_Line = document.createElement("input");
				
				New_Line.setAttribute("size", "4");
				New_Line.setAttribute("onclick", "Change(this)");
				New_Line.setAttribute("name", Ele.value);
				New_Line.setAttribute("value", "Incorrect");
				New_Line.setAttribute("class", "Button_Style");
				New_Line.setAttribute("unselectable", "on");
				New_Line.setAttribute("onselectstart", "return false;");
				New_Line.setAttribute("onmousedown", "return false;");
				
				// Position the next element in the correct spot.
				if(Num_Of_Children >= 10)
					Num_Of_Children--;
				
				Parent.insertBefore(New_Line, Parent.childNodes[(Num_Of_Children - 2)]);
				
				Num_Of_Children = Parent.childNodes.length;
				
				// Holds the new line to be added.
				New_Line = document.createElement('input');
		   
		   
				New_Line.setAttribute('class', 'Options');
				New_Line.setAttribute('size', 40);
			   
			    Letter = String.fromCharCode(65 + Letter);
			   
			    New_Line.setAttribute('placeholder', 'Enter In Option ' + Letter);
			    New_Line.setAttribute('name', Ele.value);

				// Position the next element in the correct spot.
				if(Num_Of_Children >= 10)
					Num_Of_Children--;
				
			    Parent.insertBefore(New_Line, Parent.childNodes[(Num_Of_Children - 2)]);
				
				Num_Of_Children = Parent.childNodes.length;
				
		   }

		   
		   // Determine when to create the remove button or hide the add button.
		   if(Num_Of_Children >= 9)
		   {
			   
			   // Holds the forum buttons.
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
				
				
				New_Line.innerHTML = "Test";
				New_Line.setAttribute("href", "http://localhost:8080/Flash%20Cards/test.php");
				New_Line.setAttribute("class", "Menu_Options");
				
				
				Ele.appendChild(New_Line);
				
				Ele.setAttribute("name", "Opened");
				Ele.setAttribute("style", "width: 12%");
				
			}
			else
			{
				
				Ele.innerHTML = "Menu";
				
				Ele.setAttribute("name", "Closed");
				Ele.setAttribute("style", "width: 10%");
				
				
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
			
			// Used to help indicate if file has data.
			$Flag = True;
			
			
			// Pick the correct file name.
			if((isset($_POST["1"]) and ($_POST["1"]) == "Save"))
				$File_Name = "/TF.txt";
			elseif((isset($_POST["2"]) and ($_POST["2"]) == "Save"))
				$File_Name = "/MC.txt";
			elseif((isset($_POST["3"]) and ($_POST["3"]) == "Save"))
				$File_Name = "/QA.txt";
			else
				$Flag = False;
			
			
			// If save was clicked enter.
			if($Flag)
			{
				
				// Write to file.
				$W_File = fopen($Folder_Name . $File_Name, "w");
				
				
				// Loop through all input from form.
				foreach($_POST as $Question)
				{
					
					// Exclude the save button.
					if($Question != "Save")
					{

						clearstatcache();
						
						// Add a new line if file has data already.
						if(filesize($Folder_Name . $File_Name) > 0)
							fwrite($W_File, "\r\n");
						
						// Add all parts from the question.
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
	

	<center>
		<div class="Menu_Style" name="Closed" onclick="Menu_Options(this)">
	
			Menu
	
		</div>
	</center>

	<body class="Border_Style" style="background-color: 79EA13">
		<form action="" onsubmit="return Validate_Form();" name="Add" method="post">
			<div style="margin: 30px 0px 0px 0px" align="center">	
				<input type="submit" class="Link" name="1" value="True/ False">
				
				<input type="submit" class="Link" name="2" value="Multiple Choice">
				
				<input type="submit" class="Link" name="3" value="QnA">

				
				<table id="Parent" style="border-collapse:collapse; display: block; overflow: auto; height: 65%; text-align: center" class="Center_Of_Page">
				
					<?php

						$Flag = True;
						
						clearstatcache();
						
						// Create a different page depending on what tab was clicked on.
						if(isset($_POST["1"]))
						{
							
							$File_Name = "/TF.txt";

							// If file exsists and has data we will display something.
							if((file_exists($Folder_Name . $File_Name)) and (filesize($Folder_Name . $File_Name) > 0))
							{
								
								$Flag = False;
								$R_File = fopen($Folder_Name . $File_Name, "r");
								
								// Loop through all questions in file.
								while(!feof($R_File))
								{
										
										// Hold each section of the question.
										$Sections = explode(":::", fgets($R_File));
						
										// Create all necessary components to display question.
										print("<script>");
										
											print("var Parent = document.getElementById('Parent');
												   var Parent_Size = (Parent.childNodes.length + 4);
												   var Cell = document.createElement('td');
												   
												   var Ele = document.createElement('select');
												   var Child_1 = document.createElement('option');
												   var Child_2 = document.createElement('option');
												   
												   Child_1.innerHTML = 'True';
												   Child_2.innerHTML = 'False';
												   
												   Ele.setAttribute('class', 'Make_Room');
												   
												   if('$Sections[0]' == 'True')
													   Child_1.setAttribute('selected', 'true');
												   else
													   Child_2.setAttribute('selected', 'true');
												   
												   
												   Ele.appendChild(Child_1);
												   Ele.appendChild(Child_2);
												   
												   Ele.setAttribute('name', Parent_Size + '[]');
												   
												   Cell.appendChild(Ele);
												   
												   Ele = document.createElement('input');
												   
												   Ele.setAttribute('class', 'Make_Room');
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
												   Ele.setAttribute('class', 'Make_Room');
												   
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
							
							// If file exsists and has data we will display something.
							if((file_exists($Folder_Name . $File_Name)) and (filesize($Folder_Name . $File_Name) > 0))
							{
								
								$Flag = False;
								$R_File = fopen($Folder_Name . $File_Name, "r");
								
								
								// Loop through all questions in file.
								while(!feof($R_File))
								{

									// Hold each section of the question.
									$Sections = explode(":::", fgets($R_File));
					
					
									// Create all necessary components to display question.
									print("<script>");
									
										print("var Parent = document.getElementById('Parent');
											   var Parent_Size = Parent.childNodes.length + 4;
											   var Row = document.createElement('tr');
											   var Cell = document.createElement('td');
											   
											   var Ele = document.createElement('input');
											   
											   Ele.setAttribute('class', 'Make_Room');
											   Ele.setAttribute('value', '$Sections[0]');
											   Ele.setAttribute('size', '51');
											   Ele.setAttribute('name', Parent_Size + '[]');
											   
											   Cell.appendChild(Ele);
											   
											   ");
									
									print("</script>");

									// Used to keep track of the number of options in form.
									$Count_Lines = 0;
									
									// Add each option for the question.
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
												   Ele.setAttribute('class', 'Button_Style');
												   
												   if('$Sections[$Count]' == 'Incorrect')
													   Ele.setAttribute('style', 'cursor: pointer; text-align: center; background-color: red;');
												   else
													   Ele.setAttribute('style', 'cursor: pointer; text-align: center; background-color: green;');
												   
												   Cell.appendChild(Ele);
												   
												   Ele = document.createElement('input');
												   
												   Ele.setAttribute('class', 'Make_Room');
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
									
									// Determine if we need to remove or hide buttons.
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
											   Ele.setAttribute('class', 'Make_Room');
											   
											   
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
							
							// If file exsists and has data we will display something.
							if((file_exists($Folder_Name . $File_Name)) and (filesize($Folder_Name . $File_Name) > 0))
							{
								
								$Flag = False;
								$R_File = fopen($Folder_Name . $File_Name, "r");
								
								
								// Loop through all questions in file.
								while(!feof($R_File))
								{
										
									// Hold each section of the question.
									$Sections = explode(":::", fgets($R_File));
					
									// Create all necessary components to display question.
									print("<script>");
									
										print("var Parent = document.getElementById('Parent');
											   var Parent_Size = Parent.childNodes.length + 4;
											   var Row = document.createElement('tr');
											   var Cell = document.createElement('td');

											   
											   var Ele = document.createElement('input');
											   
											   Ele.setAttribute('class', 'Make_Room');
											   Ele.setAttribute('value', '$Sections[0]');
											   Ele.setAttribute('size', '50');
											   Ele.setAttribute('name', Parent_Size + '[]');
											   
											   Cell.appendChild(Ele);
											   
											   
											   
											   Ele = document.createElement('input');
											   
											   Ele.setAttribute('class', 'Make_Room');
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
											   Ele.setAttribute('class', 'Make_Room');
											   
											   
											   Cell.appendChild(Ele);
											   
											   Row.appendChild(Cell);
											   
											   Parent.appendChild(Row);
	
											   ");
									
									print("</script>");

								}
								
								fclose($R_File);

							}
							
						}

						
						// If no data in file display message else make a submit button.
						if($Flag)
							print("<h2>" . "No Items To Display" . "</h2>");
						else
						{
							
							print("<script>");
								
								print("Ele = document.createElement('input');
								
									   Ele.setAttribute('type', 'submit');
									   Ele.setAttribute('onclick', 'Change_Value(this)');
									   Ele.setAttribute('value', 'Save');
									   Ele.setAttribute('class', 'Make_Room');
									   
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