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
	
	</style>

	<?php
	
		// Hold the file name and path.
		$Folder_Name = "Data";
		$Hold_Questions = array();

		
		// Create folder if one doesn't exsist.
		if(!file_exists($Folder_Name))
			mkdir($Folder_Name);
		else
		{

			$File_Name = "/TF.txt";

			
			if(file_exists($Folder_Name . $File_Name))
			{
				
				$R_File = fopen($Folder_Name . $File_Name, "r");
				
				while(!feof($R_File))
				{
					
					$Line = fgets($R_File);
					
					if($Line != "")
						array_push($Hold_Questions, ("TF:::" . $Line));
					
				}
			
			}
			
			$File_Name = "/MC.txt";
			
			
			if(file_exists($Folder_Name . $File_Name))
			{
				
				// Read file.
				$R_File = fopen($Folder_Name . $File_Name, "r");
				
				while(!feof($R_File))
				{
					
					$Line = fgets($R_File);
					
					if($Line != "")
						array_push($Hold_Questions, ("MC:::" . $Line));
					
				}
			
			}
			
			$File_Name = "/QA.txt";
			
			
			if(file_exists($Folder_Name . $File_Name))
			{
				
				// Read file.
				$R_File = fopen($Folder_Name . $File_Name, "r");
				
				while(!feof($R_File))
				{
					
					$Line = fgets($R_File);
					
					if($Line != "")
						array_push($Hold_Questions, ("QA:::" . $Line));
					
				}
			
			}
		
		}
		
	?>
	
	<script>

		function Display_Questions(Hold_Questions = null)
		{
		
			if(Hold_Questions == null)
				var Hold_Questions = <?php echo json_encode($Hold_Questions); ?>;
			
			if(Hold_Questions.length)
			{
				
				var Rand_Num = Math.floor(Math.random() * (Hold_Questions.length - 1));
				//alert(Hold_Questions[Rand_Num]);///////////////////////////////////////////////////////////////////////
				var Sections = Hold_Questions[Rand_Num].split(":::");
				
				Hold_Questions.splice(Rand_Num, 1);
				
				if(Sections[0] == "TF")
					Display_TF(Sections, Hold_Questions);
				else if(Sections[0] == "MC")
					Display_MC(Sections, Hold_Questions);
				else if(Sections[0] == "QA")
					Display_QA(Sections, Hold_Questions);
				
			}
			else
			{
				
				var Parent = document.getElementById("Parent");
				
				Parent.innerHTML = "";
				
				var New_Line = document.createElement("h1");
				
				New_Line.innerHTML = "All Questions Answered";
				
				Parent.appendChild(New_Line);
				
			}
			
		}
		
		function Display_TF(Sections, Questions)
		{
			
			var Parent = document.getElementById("Parent");
			
			Parent.innerHTML = null;
			
			var New_Line = document.createElement("h1");
			
			New_Line.innerHTML = Sections[2];
			
			Parent.appendChild(New_Line);
			
			
			New_Line = document.createElement("button");
			
			New_Line.innerHTML = "True";
			New_Line.setAttribute("class", "Make_Room");
			New_Line.addEventListener('click', function(){ Check_Answer(Sections[1], Questions, this.innerHTML); });

			Parent.appendChild(New_Line);
			
			
			New_Line = document.createElement("button");
			
			var Test = "123";
			
			New_Line.innerHTML = "False";
			New_Line.setAttribute("class", "Make_Room");
			New_Line.addEventListener('click', function(){ Check_Answer([Sections[1]], Questions, [this.innerHTML]); });


			Parent.appendChild(New_Line);
			
		}
		
		function Display_MC(Sections, Questions)
		{
			
			var Answers = [];
			var Table = document.createElement("table");
			var Row = document.createElement("tr");
			var Cell = document.createElement("td");
			var Parent = document.getElementById("Parent");
			
			Parent.innerHTML = null;

			//Table.setAttribute("class", "Vertical_Center");
			
			var New_Line = document.createElement("h1");
			
			New_Line.innerHTML = Sections[1];
			
			Cell.setAttribute("colspan", "2");
			Cell.setAttribute("style", "text-align: center");
			
			
			Cell.appendChild(New_Line);
			Row.appendChild(Cell);
			Table.appendChild(Row);
			//alert(Sections.length);////////////////////////////////////////////////////////////////////////////////
			for(var Count = 2; Count < (Sections.length - 1); Count += 2)
			{

				Answers.push(Sections[Count]);
				
				Row = document.createElement("tr");
				
				Cell = document.createElement("td");
				New_Line = document.createElement("input");
				
				Cell.setAttribute("class", "Vertical_Center");
				
				New_Line.setAttribute("size", "4");
				New_Line.setAttribute("onclick", "Change(this)");
				New_Line.setAttribute("value", "Incorrect");
				New_Line.setAttribute("style", "float: left");
				New_Line.setAttribute("class", "Button_Style");
				New_Line.setAttribute("unselectable", "on");
				New_Line.setAttribute("onselectstart", "return false;");
				New_Line.setAttribute("onmousedown", "return false;");
				
				Cell.appendChild(New_Line);

				New_Line = document.createElement("div");
				
				New_Line.innerHTML = Sections[Count + 1];
				New_Line.setAttribute("class", "Make_Room");
				New_Line.setAttribute("style", "float: left");
				
				Cell.appendChild(New_Line);
				Row.appendChild(Cell);
				
				Table.appendChild(Row)
				
			}
			
			var Users_Answers = document.getElementsByTagName("input");
			
			New_Line = document.createElement("button");
			
			New_Line.innerHTML = "Submit";
			New_Line.addEventListener('click', function(){ Check_Answer(Answers, Questions, Users_Answers); });
			New_Line.setAttribute("class", "Make_Room");
			
			Row = document.createElement("tr");
			Cell = document.createElement("td");
			
			Cell.setAttribute("colspan", "2");
			Cell.setAttribute("style", "text-align: center");
			
			Cell.appendChild(New_Line);
			Row.appendChild(Cell);
			Table.appendChild(Row);
			
			Parent.appendChild(Table);
			
			
		}
		
		function Display_QA(Sections, Questions)
		{
			
			var Parent = document.getElementById("Parent");
			
			Parent.innerHTML = null;
			
			var New_Line = document.createElement("h1");
			
			New_Line.innerHTML = Sections[1];
			
			Parent.appendChild(New_Line);
			
			New_Line = document.createElement("input");
			
			New_Line.setAttribute("size", "50");
			
			Parent.appendChild(New_Line);
			
			var New_Line2 = document.createElement("button");
			
			New_Line2.innerHTML = "Submit";
			New_Line2.addEventListener('click', function(){ Check_Answer([Sections[2]], Questions, [New_Line.value]); });
			New_Line2.setAttribute("class", "Make_Room");

			New_Line3 = document.createElement("br");
			
			Parent.appendChild(New_Line3);
			
			Parent.appendChild(New_Line2);

		}

		function Check_Answer(Answer, Questions, Users_Answer)
		{
			
			var Flag = true;
			
			
			if(Users_Answer[0].nodeName == "INPUT")
			{
				
				var Temp = [];
				
				for(var Count = 0; Count < Users_Answer.length; Count++)
				{
					
					Temp.push(Users_Answer[Count].value);
					
				}
			
				Users_Answer = Temp.slice();
				
			}

			
			
			for(var Count = 0; Count < Answer.length; Count++)
			{
				
				if(Users_Answer[Count] == Answer[Count])
					Flag = true;
				else
				{
					
					Flag = false;
					
					break;
					
				}
				
			}
			
			if(Flag)
			{
				
				alert("Correct");
				
				Display_Questions(Questions);
				
			}
			else
				alert("Incorrect");
			
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
				New_Line.setAttribute("href", "http://localhost/Flash%20Cards/Add%20Cards.php");
				New_Line.setAttribute("class", "Menu_Options");
				
				Ele.appendChild(New_Line);
				
				
				New_Line = document.createElement("a");
				
				
				New_Line.innerHTML = "Edit Cards";
				New_Line.setAttribute("href", "http://localhost/Flash%20Cards/edit%20Cards.php");
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

					if(sizeof($Hold_Questions) != 0)
					{

						print("<script>");
						
							print("Display_Questions();");
						
						print("</script>");
						
					}
					else
					{
						
						print("<h1>No Questions</h1>");
						
					}
				
				?>
			
			</div>
		
		</div>
	
	</body>

</html>