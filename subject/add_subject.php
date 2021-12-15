<?php
	session_start();
	include_once('../include/database.php');

	if(isset($_POST['add'])){
		$database = new Connection();
		$db = $database->open();
		try{
			//make use of prepared statement to prevent sql injection
			$sql = $db->prepare("INSERT INTO subject (subject_code, course_id, course_description, total_units, with_lab_components) VALUES (:subject_code, :course_id, :course_description, :total_units, :with_lab_components)");

			if(empty($_POST['subject_code'] && $_POST['course_id'] && $_POST['description'] && $_POST['units'] && $_POST['components'])){
				$_SESSION['message'] = 'Fill up add form first';
			}
			elseif(ctype_space($_POST['subject_code']) || ctype_space($_POST['course_id']) || ctype_space($_POST['description']) || ctype_space($_POST['units']) || ctype_space($_POST['components'])){
				$_SESSION['message'] = 'Please enter a valid value';
			}
			else{
				//bind
				$sql->bindParam(':subject_code', $_POST['subject_code']);
				$sql->bindParam(':course_id', $_POST['course_id']);
				$sql->bindParam(':course_description', $_POST['description']);
				$sql->bindParam(':total_units', $_POST['units']);
				$sql->bindParam(':with_lab_components', $_POST['components']);

				//if-else statement in executing our prepared statement
				$_SESSION['message'] = ( $sql->execute()) ? 'Subject added successfully' : 'Something went wrong. Cannot add subject.';
			}
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//close connection
		$database->close();
	}

	else{
		$_SESSION['message'] = 'Fill up add form first';
	}

	header('location: ../index.php');
	
?>