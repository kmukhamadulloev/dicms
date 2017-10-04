<?php

	// require(__DIR__ . "/session.php"); Add it soon
	require(__DIR__ . "/db.connect.php");
	require(__DIR__ . "/functions.php");
	
	header("Content-type: application/json");
	$response = array(
		'result' => 'error',
		'data'   => 'No action defined'
	);
	
	if (!empty($_POST['action'])) {
		switch ($_POST['action']) {
			case 'get_posts':
				$limit = isset($_POST['limit']) ? intval($_POST['limit']) : 0;
				$type = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : '';
				$search = isset($_POST['search']) ? htmlspecialchars($_POST['search']) : '';
				$extended = isset($_POST['extended']) ? intval($_POST['extended']) : 0;
				
				$searchResult = getListPosts($limit, $type, $extended, $search);
				$response['result'] = $searchResult === false ? 'error' : 'success';
				$response['data'] = $searchResult;
				break;
			case 'get_page':
				$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
				$type = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : '';
				
				if ($id <= 0) {
					$response['result'] = 'error';
					$response['data'] = "'id' is not defined";
				} else {
					$searchResult = getPostById($id, $type);
					$response['result'] = $searchResult === false ? 'error' : 'success';
					$response['data'] = $searchResult;
				}
				break;
			case 'lastActiveProjects':
				$searchResult = getListPosts(4, '', 0);
				$response['result'] = 'success';
				$response['data'] = $searchResult;
				break;
			case 'lastArchivedProjects':
			
				break;
			case 'allProjectsMin':
			
				break;
			case 'projectPage':
				
				break;
			case 'allBlogMin':
				
				break;
			case 'blogPage':
				
				break;
			case 'allWorkMin':
				
				break;
			case 'workPage':
				
				break;
			case 'allGallery':
				
				break;
			case 'aboutMe':
				
				break;
			case 'get_template':
				$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';

				try {
					$result = getTemplate($name);
					$response['result'] = $result === false ? 'error' : 'success';
					$response['data'] = $result;
				} catch (Exception $e) {
					$response['result'] = 'error';
					$response['data'] = $e->getMessage();
				}

				break;
			default:
				$response['result'] = 'ERROR';
				$response['data'] = 'Unknown action';
				break;
		}
	} else {
		$response['result'] = 'ERROR';
		$response['data'] = 'No action defined';
	}
	
	echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

?>