<?php
	session_start();
	include_once('../include/database.php');

	if(isset($_POST['update'])){
		$database = new Connection();
		$db = $database->open();
		try{
			date_default_timezone_set('Asia/Manila');
            $curr_date = date('Y-m-d H:i:s');

			//make use of prepared statement to prevent sql injection
			$sql = $db->prepare("UPDATE subject SET subject_code = :subject_code, course_id = :course_id, course_description = :course_description, total_units = :total_units, with_lab_components = :with_lab_components, updated_at = :updated_at WHERE id = :id ");

			if(empty($_POST['subject_code'] && $_POST['course_id'] && $_POST['description'] && $_POST['units'] && $_POST['components'])){
				$_SESSION['message'] = 'Fill up add form first';
			}
			elseif(ctype_space($_POST['subject_code']) || ctype_space($_POST['course_id']) || ctype_space($_POST['description']) || ctype_space($_POST['units']) || ctype_space($_POST['components'])){
				$_SESSION['message'] = 'Please enter a valid value';
			}
			else{
				$sql->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
				$sql->bindParam(':subject_code', $_POST['subject_code']);
				$sql->bindParam(':course_id', $_POST['course_id']);
				$sql->bindParam(':course_description', $_POST['description']);
				$sql->bindParam(':total_units', $_POST['units']);
				$sql->bindParam(':with_lab_components', $_POST['components']);
				$sql->bindParam(':updated_at', $curr_date);

				//if-else statement in executing our prepared statement
				$_SESSION['message'] = ( $sql->execute()) ? 'Subject Updated successfully': 'Something went wrong. Cannot Update subject.';
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