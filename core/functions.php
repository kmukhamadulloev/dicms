<?php

	function addType($title, $description, $logo) {
		global $pdo;
		
		try {
			$stmt = $pdo->prepare("INSERT INTO types (title, description, logo) VALUES (:newTitle, :newDescription, :newLogo);");
			$stmt->bindParam(':newTitle', htmlspecialchars($title));
			$stmt->bindParam(':newDescription', htmlspecialchars($description));
			$stmt->bindParam(':newLogo', htmlspecialchars($logo)); // find a way to fix it
			$stmt->execute();
			
			return true;
			
		} catch (PDOException $e) {
			throw new Exception("Database returned an error: " . $e->getMessage());
			return false;
		}
	}
	
	function editType($id, $title, $description, $logo) {
		global $pdo;
		
		try {
			$stmt = $pdo->prepare("UPDATE types SET types.title = :newTitle, types.description = :newDescription, types.logo = :newLogo WHERE id = :typeID;");
			$stmt->bindParam(':typeID', htmlspecialchars($id));
			$stmt->bindParam(':newType', htmlspecialchars($newType));
			$stmt->bindParam(':newDescription', htmlspecialchars($newDescription));
			$stmt->bindParam(':newLogo', htmlspecialchars($newLogo));
			$stmt->execute();
			
			return true;
		} catch (PDOException $e) {
			throw new Exception("Database returned an error: " . $e->getMessage());
			return false;
		}
	}
	
	function deleteType($id) {
		global $pdo;
		
		try {
			$stmt = $pdo->prepare("DELETE FROM types WHERE types.id = :typeID;");
			$stmt->bindParam(':typeID', htmlspecialchars($id));
			$stmt->execute();
			
			return true;
		} catch (PDOException $e) {
			throw new Exception("Database returned an error: " . $e->getMessage());
			return false;
		}
	}
	
	function viewType($id) {
		global $pdo;
		
		try {
			$stmt = $pdo->prepare("SELECT types.id, types.title, types.description, types.logo FROM types WHERE types.id = :typeID;");
			$stmt->bindValue(':typeID', htmlspecialchars($id));
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_OBJ);
			$answer = $stmt->fetchAll();
			
			return $answer;
		} catch (PDOException $e) {
			return false;
		}
	}
	
	function viewAllType() {
		global $pdo;
		
		try {
			$stmt = $pdo->prepare("SELECT types.id, types.title, types.description, types.logo FROM types;");
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_OBJ);
			$answer = $stmt->fetchAll();
			
			return $answer;
		} catch (PDOException $e) {
			return false;
		}
	}
	
	function viewLastType($limit) {
		global $pdo;
		
		try {
			$stmt = $pdo->prepare("SELECT types.id, types.title, types.description, types.logo FROM types ORDER BY types.id DESC LIMIT :limitValue;");
			$stmt->bindValue(':limitValue', htmlspecialchars($limit));
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_OBJ);
			$answer = $stmt->fetchAll();
			
			return $answer;
		} catch (PDOException $e) {
			return false;
		}
	}
	
	function searchType($search) {
		global $pdo;
		
		try {
			$stmt = $pdo->prepare("SELECT types.id, types.title, types.description, types.logo FROM types WHERE types.title LIKE :search;");
			$stmt->bindValue(':search', htmlspecialchars($search));
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_OBJ);
			$answer = $stmt->fetchAll();
			
			return $answer;
		} catch (PDOException $e) {
			return false;
		}
	}
	
	function addPost($title, $description, $status, $type, $content, $logo, $author, $keywords) {
		global $pdo;
		
		try {
			$stmt = $pdo->prepare("INSERT INTO posts (title, description, post_status, content, post_type, author, post_logo, keywords) VALUES (:newTitle, :newDescription, :newStatus, :newContent, :newType, :newAuthor, :newLogo, :newKeywords);");
			$stmt->bindParam(':newTitle', htmlspecialchars($title));
			$stmt->bindParam(':newDescription', htmlspecialchars($description));
			$stmt->bindParam(':newStatus', htmlspecialchars($status));
			$stmt->bindParam(':newContent', htmlspecialchars($content));
			$stmt->bindParam(':newType', htmlspecialchars($type));
			$stmt->bindParam(':newAuthor', htmlspecialchars($author));
			$stmt->bindParam(':newLogo', htmlspecialchars($newLogo)); // find a way to fix it
			$stmt->bindParam(':newKeywords', htmlspecialchars($keywords));
			$stmt->execute();
			
			return true;
		} catch (PDOException $e) {
			throw new Exception("Database returned an error: " . $e->getMessage());
			return false;
		}
	}
	
	function editPost($id, $title, $description, $status, $type, $content, $logo, $author, $keywords) {
		global $pdo;
		
		try {
			$stmt = $pdo->prepare("UPDATE posts SET posts.title = :newTitle, posts.description = :newDescription, posts.status = :newStatus, posts.content = :newContent, posts.type = :newType, posts.Author = :newAuthor, posts.logo = :newLogo, post.keywords = :newKeywords);");
			$stmt->bindParam(':newTitle', htmlspecialchars($title));
			$stmt->bindParam(':newDescription', htmlspecialchars($description));
			$stmt->bindParam(':newStatus', htmlspecialchars($status));
			$stmt->bindParam(':newContent', htmlspecialchars($content));
			$stmt->bindParam(':newType', htmlspecialchars($type));
			$stmt->bindParam(':newAuthor', htmlspecialchars($author));
			$stmt->bindParam(':newLogo', htmlspecialchars($newLogo)); // find a way to fix it
			$stmt->bindParam(':newKeywords', htmlspecialchars($keywords));
			$stmt->execute();
			
			return true;
		} catch (PDOException $e) {
			throw new Exception("Database returned an error: " . $e->getMessage());
			return false;
		}
	}
	
	function deletePost($id) {
		global $pdo;
		
		try {
			$stmt = $pdo->prepare("DELETE FROM posts WHERE posts.id = :postID;");
			$stmt->bindParam(':postID', htmlspecialchars($id));
			$stmt->execute();
			
			return true;
		} catch (PDOException $e) {
			throw new Exception("Database returned an error: " . $e->getMessage());
			return false;
		}
	}
	
	function viewPost($id) {
		global $pdo;
		
		try {
			$stmt = $pdo->prepare("SELECT posts.id, posts.title, posts.post_date, posts.post_logo, posts.post_status, posts.post_type, posts.author, posts.content, posts.description, posts.keywords FROM posts WHERE posts.id = :postID;");
			$stmt->bindParam(':postID', htmlspecialchars($id));
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_OBJ);
			$answer = $stmt->fetchAll();
			
			return true;
		} catch (PDOException $e) {
			throw new Exception("Database returned an error: " . $e->getMessage());
			return false;
		}
	}
	
	function getPostById($id, $type = '') {
		return getListPosts(1, $type, 1, '', $id);
	}
	
	function getListPosts($limit = 0, $type = '', $extended = 0, $search = '', $id = 0) {
		global $pdo;
		
		$search = trim(htmlspecialchars($search));
		$type = trim(htmlspecialchars($type));
		$id = intval($id);
		
		try {
			$extendedFields = $extended === 0 ? "" : ", P.content";
			
			$whereFilters = array();
			
			if (strlen($type) > 0) $whereFilters[] = "T.code_name = :type";
			if (strlen($search) > 0) $whereFilters[] = "P.title LIKE :search";
			if ($id > 0) $whereFilters[] = "P.id = :id";
			
			$limitFilter = $limit > 0 ? " LIMIT :limitValue" : '';
			
			$whereClause = (count($whereFilters) === 0) ? '' : 'WHERE ' . implode(' AND ', $whereFilters);
			
			$query = "
				SELECT
					P.id,
					P.title,
					P.post_date,
					P.post_logo,
					P.post_status,
					P.post_type,
					P.author,
					P.description,
					P.keywords,
					T.code_name,
					T.title AS 'type_title'
					{$extendedFields}
				FROM posts P
				INNER JOIN types T ON P.post_type = T.id
				{$whereClause}
				ORDER BY P.id DESC
				{$limitFilter}
				";
			// var_dump($query);
			
			$stmt = $pdo->prepare($query);
			
			if (strlen($type) > 0) {
				$stmt->bindValue(':type', $type, PDO::PARAM_STR);
			}
			
			if ($limit > 0) {
				$stmt->bindValue(':limitValue', intval($limit), PDO::PARAM_INT);
			}
			
			if ($id > 0) {
				$stmt->bindValue(':id', $id, PDO::PARAM_INT);
			}
			
			if (strlen($search) > 0) {
				$stmt->bindValue(':search', "%{$search}%", PDO::PARAM_STR);
			}
			
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_OBJ);
			$answer = $stmt->fetchAll();
			
			return $answer;
		} catch (PDOException $e) {
			throw new Exception("Database returned an error: " . $e->getMessage());
			return false;
		}
	}
	
	function addParam($paramName, $paramValue) {
		global $pdo;
		
		try {
			$stmt = $pdo->prepare("INSERT INTO params (param_name, param_value) VALUES (:paramName, :paramValue);");
			$stmt->bindParam(':paramName', htmlspecialchars($paramName));
			$stmt->bindParam(':paramValue', htmlspecialchars($paramValue));
			$stmt->execute();
			
			return true;
		} catch (PDOException $e) {
			throw new Exception("Database returned an error: " . $e->getMessage());
			return false;
		}
	}
	
	function editParam($id, $paramName, $paramValue) {
		global $pdo;
		
		try {
			$stmt = $pdo->prepare("INSERT INTO params (param_name, param_value) VALUES (:paramName, :paramValue) WHERE params.id = :paramID;");
			$stmt->bindParam(':paramID', htmlspecialchars($id));
			$stmt->bindParam(':paramName', htmlspecialchars($paramName));
			$stmt->bindParam(':paramValue', htmlspecialchars($paramValue));
			$stmt->execute();
			
			return true;
		} catch (PDOException $e) {
			throw new Exception("Database returned an error: " . $e->getMessage());
			return false;
		}
	}
	
	function deleteParam() {
		global $pdo;
		
		try {
			$stmt = $pdo->prepare("DELETE FROM params WHERE param.id = :paramID;");
			$stmt->bindParam(':paramID', htmlspecialchars($id));
			$stmt->execute();
			
			return true;
		} catch (PDOException $e) {
			throw new Exception("Database returned an error: " . $e->getMessage());
			return false;
		}
	}
	
	function viewParam($id) {
		global $pdo;
		
		try {
			$stmt = $pdo->prepare("SELECT params.id, params.param_name, params.value FROM params WHERE params.id LIKE :paramID;");
			$stmt->bindValue(':paramID', htmlspecialchars($id));
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_OBJ);
			$answer = $stmt->fetchAll();
			
			return $answer;
		} catch (PDOException $e) {
			return false;
		}
	}
	
	function viewAllParam() {
		global $pdo;
		
		try {
			$stmt = $pdo->prepare("SELECT params.id, params.param_name, params.value FROM params;");
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_OBJ);
			$answer = $stmt->fetchAll();
			
			return $answer;
		} catch (PDOException $e) {
			return false;
		}
	}
	
	function viewLastParam($limit) {
		global $pdo;
		
		try {
			$stmt = $pdo->prepare("SELECT params.id, params.param_name, params.value FROM params ORDER BY params.id DESC LIMIT :limitValue;");
			$stmt->bindValue(':limitValue', htmlspecialchars($limit));
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_OBJ);
			$answer = $stmt->fetchAll();
			
			return $answer;
		} catch (PDOException $e) {
			return false;
		}
	}
	
	function searchParam($search) {
		global $pdo;
		
		try {
			$stmt = $pdo->prepare("SELECT params.id, params.param_name, params.value FROM params WHERE params.param_name LIKE :search;");
			$stmt->bindValue(':search', '%'.htmlspecialchars($search).'%', PDO::PARAM_STR);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_OBJ);
			$answer = $stmt->fetchAll();
			
			return $answer;
		} catch (PDOException $e) {
			return false;
		}
	}
	
	function userAuthorize($login, $password) {
		// will add soon
	}
	
	/**
		Get template file by name
		@var $name string Template name
	*/
	function getTemplate($name = '') {
		if (trim($name) === '') throw new Exception("Name if not defined");
		if (!preg_match("/^[\w\-]+$/", $name)) throw new Exception("Invalid name");
		
		$tplPath = __DIR__ . '/../tpl/' . $name . '.tpl';
		
		if (!file_exists($tplPath)) throw new Exception("File doesn't exist");
		$tplFile = @file_get_contents($tplPath);
		if ($tplFile === false) throw new Exception("File is unreadable");
		
		return $tplFile;
	}
?>