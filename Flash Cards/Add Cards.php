<html>
	<head>
	
		<link rel="stylesheet" type="text/css" href="Style.css">
	
	</head>
	
	
	<title>
	
		Add Cards
	
	</title>
	
	
	<style>

		.Link:hover
		{
			
			background-color: orange;
			
		}

	</style>
	
	
	<script>
	
		//******************************************************************************
		//
		// Less_Lines - Will remove lines from the multiple choice and either remove the
		//              remove button or make the add button visible again.
		//
		//******************************************************************************
		function Less_Lines()
		{
			
			// Used to determine when to remove or redisplay buttons.
			var Parent = document.getElementById('Parent');
			var Num_Of_Children = Parent.childNodes.length;
			
			// Used to find only the buttons.
			var Buttons = document.getElementsByTagName('button');
			

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
		function More_Lines()
		{
			
			// Used to determine when to create or hide the buttons and make custom place
			// holders for the new lines.
			var Parent = document.getElementById('Parent');
			var Num_Of_Children = Parent.childNodes.length;
			
			// Holds the letter for the custom placeholder.
			var Letter = (((Num_Of_Children / 3) - 2) + 1);
			
			
			
			// Limit the multiple choice to 9 options.
			if(Letter <= 10)
			{

				// Holds the new element to be added.
				var New_Line = document.createElement("br");
				
				
				// Position the next element in the correct spot.
				if(Num_Of_Children >= 10)
					Num_Of_Children--;
				
				Parent.insertBefore(New_Line, Parent.childNodes[(Num_Of_Children - 2)]);
				

				Num_Of_Children = Parent.childNodes.length;
				New_Line = document.createElement("input");
				
				New_Line.setAttribute("size", "4");
				New_Line.setAttribute("onclick", "Change(this)");
				New_Line.setAttribute("name", "MC[]");
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
				New_Line = document.createElement('input');

				New_Line.setAttribute('class', 'Options');
				New_Line.setAttribute('size', 40);
			   
			    Letter = String.fromCharCode(65 + Letter);
			   
			    New_Line.setAttribute('placeholder', 'Enter In Option ' + Letter);
			    New_Line.setAttribute('name', "MC[]");

				// Position the next element in the correct spot.
				if(Num_Of_Children >= 10)
					Num_Of_Children--;
				
			    Parent.insertBefore(New_Line, Parent.childNodes[(Num_Of_Children - 2)]);
				
				Num_Of_Children = Parent.childNodes.length;
				
		   }

		   
		   // Determine when to create the remove button or hide the add button.
		   if(Num_Of_Children == 9)
		   {
			   
			   // Holds the remove button.
			   var Remove_Btn = document.createElement('button');
			   
			   
			   Remove_Btn.setAttribute("onclick", "Less_Lines(); return false;");
			   Remove_Btn.setAttribute("style", "margin-left: 10px");
			   Remove_Btn.innerHTML = "Remove An Option";
			   
			   Parent.appendChild(Remove_Btn);
			   
		   }
		   else if(Num_Of_Children == 34)
		   {
			   
			   // Holds the add button.
			   var Button = document.getElementsByTagName('button')[0];
			   
			   
			   Button.setAttribute("style", "visibility: hidden");
		   
		   }
  
		}
	
		//*******************************************************************************
		//
		// Validate_Form - Is to check for any blank fields in the form before submission
		//                 else stop the submission.
		//
		//*******************************************************************************
		function Validate_Form()
		{
			
			// Holds the form name.
			var Form_Name = "Add";
			
			
			// Only run this if the Save button was clicked on and check to see if the form
			// has any blank spaces.
			if(document.forms[Form_Name][(document.forms[Form_Name].length - 1)].name == 'Clicked')
			{

				// The first 3 values are submit buttons, skip them. Loop through all form
				// fields. 
				for(var Count = 3; Count < (document.forms[Form_Name].length - 1); Count++)
				{
					
					// If field is blank stop submission. The and part is only for the
					// multiple choice. We dont want to check the button values, so skip them.
					if((document.forms[Form_Name][Count].value == "") &&
					   (document.forms[Form_Name][Count].name != ""))
					{
						
						// Holds the save button.
						var Save_Btn = document.getElementsByName("Clicked");
				
				
						Save_Btn[0].setAttribute("name", "Saved");
						
						
						alert("Please Fill In All Fields");
						
						
						return false;
						
					}
						
				}

			}
			else
				return true;

		}
		
		//**********************************************************************************
		//
		// Change_Value - Will be used to help create a flag value in the save button. This
		//                will let us determine when we should add the question to the file.
		//
		//**********************************************************************************
		function Change_Value(Ele)
		{
			
			Ele.setAttribute("name", "Clicked");
			
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
		
	</script>
	
	
	<?php
	
		// Look to see if the save button was flaged to save question and prevent the user
		// from clicking the save button over and over on a sucessful save.
		if((isset($_POST["Clicked"])) and (sizeof($_POST) > 1))
		{
			
			// Hold the file name and path.
			$Folder_Name = "Data";
			
			
			// Create folder if one doesn't exsist.
			if(!file_exists($Folder_Name))
				mkdir($Folder_Name);
			
			// Get the correct file name based on form post.
			if(isset($_POST["TF"]))
				$File_Name = "/TF.txt";
			elseif(isset($_POST["MC"]))
				$File_Name = "/MC.txt";
			elseif(isset($_POST["QA"]))
				$File_Name = "/QA.txt";
				
				
			// Write to file.
			$W_File = fopen($Folder_Name . $File_Name, "a");
			
			
			// Only add a new line in file if file already has data.
			if(filesize($Folder_Name . $File_Name) > 0)
				fwrite($W_File, "\r\n");
			
			/////////////////////////////////////////////////////////////////////////////////////////////
			foreach($_POST as $Question)
			{

				if($Question != "Save")
				{
					
					foreach($Question as $Val)
							fwrite($W_File, ($Val . ":::"));
					
				}
				
			}

			fclose($W_File);
			
			
			// Assure the user the question was saved.
			print('<div class="Center_Of_Page">');
		
				print("<h2>" . "Question Was Saved" . "</h2>");
		
			print("</div>");
		
		}
		elseif(isset($_POST["Clicked"]))
		{
			
			// Inform the user to add another question if they keep pressing the save button.
			print('<div class="Center_Of_Page">');
			
				print("<h2>" . "Please Enter In Another Question" . "</h2>");
			
			print("</div>");
			
		}
	?>
	
	<body style="background-color: #0066ff">
		<form action="" onsubmit="return Validate_Form();" name="Add" method="post">
			<div style="margin: 30px 0px 0px 0px" align="center">	
				<input type="submit" class="Link" name="1" value="True/ False">
				
				<input type="submit" class="Link" name="2" value="Multiple Choice">
				
				<input type="submit" class="Link" name="3" value="QnA">
				
				<?php
				
					print('<div id="Parent" class="Center_Of_Page">');
						
						// Depending on what submit button was pressed will determine what
						// the page will display.
						if(isset($_POST["1"]))
						{

							print("<select name='TF[]'>");
								print("<option>" . "True" . "</option>");
								print("<option>" . "False" . "</option>");
										
							print("</select>");
											
							print("<input name='TF[]' style='margin-left: 20px;' type='text'
							       size='50' placeholder='Enter In Question'>");

						}
						elseif(isset($_POST["2"]))
						{

							print("<input name='MC[]' type='text' size='51'
							       placeholder='Enter In Question'>");
							
							
							print("<br/>" . "<input onclick='Change(this)' name='MC[]' class='Button_Style' unselectable='on' onselectstart='return false;' onmousedown='return false;' value='Incorrect' size='4'>");
							
							print("<input name='MC[]' class='Options' size='40'
							       placeholder='Enter In Option A'>");
								   
							print("<br/>" . "<button onclick='More_Lines(); return false;'>
							       Add An Option</button>");

						}
						elseif(isset($_POST["3"]))
						{
								
							print("<input name='QA[]' type='text' size='50'
							       placeholder='Enter In Question'>");
								
							print("<input name='QA[]' style='margin: 10px 0px 0px 0px'
							       type='text' size='50' placeholder='Enter In Answer'>");

						}
					
					print("</div>");
					
				?>
	
			</div>

			
			<?php

				print('<div class="Center_Of_Page" style="position: fixed; top: 90%;
				       transform: translateX(-50%) translateY(-90%);">');
			
					print('<input type="submit" onclick="Change_Value(this)" name="Saved"
					       value="Save"');
				
				print("</div>");
				
			?>
		
		</form>
		
	</body>

</html>