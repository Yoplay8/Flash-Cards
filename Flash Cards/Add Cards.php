<html>
	<head>
	
		<link rel="stylesheet" type="text/css" href="style.css">
	
	</head>
	
	
	<title>
	
		Add Cards
	
	</title>
	
	
	<style>

		#Link:hover
		{
			
			background-color: orange;
			
		}
		
		input#Options
		{
			
			margin: 15px 10px 10px 70px;
			
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
			
			
			// Determine when to remove or redisplay the add/ remove buttons.
			if(Num_Of_Children == 6)
			   Buttons[1].remove();
		    else if(Num_Of_Children == 14)
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
		   
		   
		   // Once the remove button is created we need to subtract one to keep the custom
		   // messages consistent and to make sure the new lines are inserted in the correct
		   // spot.
		    if(Num_Of_Children > 5)
				Num_Of_Children--;
		   
			
			// Holds the letter for the custom placeholder.
			var Letter = (Num_Of_Children - 3);

			
			// Limit the multiple choice to 9 options.
			if(Letter <= 9)
			{

				// Holds the new line to be added.
				var New_Line = document.createElement('input');
		   
		   
				New_Line.setAttribute('id', 'Options');
				New_Line.setAttribute('size', 40);
			   
			    Letter = String.fromCharCode(65 + Letter);
			   
			    New_Line.setAttribute('placeholder', 'Enter In Option ' + Letter);
			    New_Line.setAttribute('name', Letter);


			    Parent.insertBefore(New_Line, Parent.childNodes[(Num_Of_Children - 2)]);
				
		   }

		   
		   // Determine when to create the remove button or hide the add button.
		   if(Num_Of_Children == 4)
		   {
			   
			   // Holds the remove button.
			   var Remove_Btn = document.createElement('button');
			   
			   
			   Remove_Btn.setAttribute("onclick", "Less_Lines(); return false;");
			   Remove_Btn.setAttribute("style", "margin-left: 10px");
			   Remove_Btn.innerHTML = "Remove An Option";
			   
			   Parent.appendChild(Remove_Btn);
			   
		   }
		   else if(Num_Of_Children == 12)
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
		
	</script>
	
	
	<?php
	
		// Look to see if the save button was flaged to save question and prevent the user
		// from clicking the save button over and over on a sucessful save.
		if((isset($_POST["Clicked"])) and (sizeof($_POST) > 1))
		{
			
			// Hold the file name and path.
			$Folder_Name = "Data";
			$File_Name = "/Cards.txt";
			
			
			// Create folder if one doesn't exsist.
			if(!file_exists($Folder_Name))
				mkdir($Folder_Name);

			
			// Hold file.
			$W_File = fopen($Folder_Name . $File_Name, "a");
			
			// Used to help skip the save button.
			$Count = sizeof($_POST);
			
			
			// Loop through all fields.
			foreach($_POST as $Key=>$Val)
			{
				
				// Add the type of question first.
				// Note: This only needs to be ran once.
				if($Count == sizeof($_POST))
					fwrite($W_File, ($Key . ":::"));
				
				// Skip the save button.
				if($Count != 1)
					fwrite($W_File, ($Val . ":::"));
				
				$Count--;
				
			}
			
			fwrite($W_File, "\r\n");
			
			
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
				<input type="submit" id="Link" name="1" value="True/ False">
				
				<input type="submit" id="Link" name="2" value="Multiple Choice">
				
				<input type="submit" id="Link" name="3" value="QnA">
				
				<?php
				
					print('<div id="Parent" class="Center_Of_Page">');
						
						// Depending on what submit button was pressed will determine what
						// the page will display.
						if(isset($_POST["1"]))
						{

							print("<select name='TF'>");
								print("<option>" . "True" . "</option>");
								print("<option>" . "False" . "</option>");
										
							print("</select>");
											
							print("<input name='B' style='margin-left: 20px;' type='text'
							       size='50' placeholder='Enter In Question'>");

						}
						elseif(isset($_POST["2"]))
						{

							print("<input name='MC' type='text' size='50'
							       placeholder='Enter In Question'>");
							
							print("<input name='B' id='Options' size='40'
							       placeholder='Enter In Option A'>");
							
							print("<br/>" . "<button onclick='More_Lines(); return false;'>
							       Add An Option</button>");

						}
						elseif(isset($_POST["3"]))
						{
								
							print("<input name='QA' type='text' size='50'
							       placeholder='Enter In Question'>");
								
							print("<input name='B' style='margin: 10px 0px 0px 0px'
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