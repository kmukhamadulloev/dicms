<?php

	// require(__DIR__ . "/session.php"); Add it soon
	require(__DIR__ . "/db.connect.php");
	require(__DIR__ . "/functions.php");
	
	class ApiResult {
		public $result;
		public $data;
		
		public function __construct() {
			$this->setResult(false);
			$this->setData('No action defined');
			return $this;
		}
		
		public function setResult(bool $result) {
			$this->result = $result;
			return $this;
		}
		
		public function setData($data) {
			$this->data = $data;
			return $this;
		}
		
		public function print() {
			echo json_encode([
				'result' => $this->result ? 'success' : 'error',
				'data'   => $this->data
			], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
		}
	}
	
	header("Content-type: application/json");
	$response = new ApiResult();
	
	if (!empty($_POST['action'])) {
		switch ($_POST['action']) {
			case 'get_posts':
				$limit = isset($_POST['limit']) ? intval($_POST['limit']) : 0;
				$type = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : '';
				$search = isset($_POST['search']) ? htmlspecialchars($_POST['search']) : '';
				$extended = isset($_POST['extended']) ? intval($_POST['extended']) : 0;
				
				$searchResult = getListPosts($limit, $type, $extended, $search);
				try {
					$response->setResult(!!$searchResult);
					$response->setData($searchResult);
				} catch (Exception $e) {
					$response->setResult(false);
					$response->setData($e->getMessage);
				}
				break;
			case 'get_page':
				$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
				$type = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : '';
				
				if ($id <= 0) {
					$response->setResult(false);
					$response->setData("'id' is not defined");
				} else {
					$searchResult = getPostById($id, $type);
					$response->setResult(!!$searchResult);
					$response->setData($searchResult);
				}
				break;
			case 'lastActiveProjects':
				$searchResult = getListPosts(4, '', 0);
				$response->setResult(true);
				$response->setData($searchResult);
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
					$response->setResult(!!$result);
					$response->setData($result);
				} catch (Exception $e) {
					$response->setResult(false);
					$response->setData($e->getMessage());
				}

				break;
			default:
				$response->setResult(false);
				$response->setData('Unknown action');
				break;
		}
	} else {
		$response->setResult(false);
		$response->setData('No action defined');
	}

	$response->print();
?>