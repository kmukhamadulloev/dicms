const ajax = data => {
	return new Promise((resolve, reject) => {
		let fData = new FormData();
		
		for (let item in data) {
			fData.append(item, data[item]);
		}
		
		const request = {
			method: 'post',
			body: fData,
			credentials: 'include'
		}
		
		fetch('core/api.php', request)
		.then(response => {
			if (response.ok) {
				return response.json();
			}
			
			throw new Error("HTTP Fetch Request Failed");
		})
		.catch(error => {
			reject(Error(error));
		})
		.then(json => {
			if (typeof json == 'undefined' || typeof json.result == 'undefined' || json.result === 'error') {
                const error = new Error("Request doesn't contain 'result' field");
                reject(error);
            } else {
                resolve(json);
            }
		});
	});
}

const $ = sel => document.querySelector(sel);

const initHead = _ => {
	document.querySelectorAll('#head-menu-wrapper>li>a').forEach(elem => {
		elem.addEventListener('click', ev => {
			ev.preventDefault();
			let chosenTab = elem.href.replace(/([^#]*)#/, '');
			
			setTab(chosenTab);
		});
	});
}

const setTab = chosenTab => {
	console.log(chosenTab);
			
	setHash(`tab=${chosenTab}`);
	
	if (chosenTab === 'home') {
		loadActiveProjects();
	}
}

const initPageLinks = _ => {
	document.querySelectorAll('[data-link]').forEach(elem => {
		elem.addEventListener('click', ev => {
			ev.preventDefault();
			let pageId = elem.dataset.link.replace(/page=/, '');
			
			console.log('page', pageId);
			
			loadPageById(pageId);
		});
	});
}

const loadError = error => {
	$('.mainpage').innerHTML = `
		<div class="alert"><h3>Request Failed</h3><p>${error}</p></div>
	`;
}

const loadMessage = _ => {
	$('.mainpage').innerHTML = `
		<div class="loader"><h3>Loading page</h3><p>Please wait, motherfucker.</p></div>
	`;
}

const loadPageById = id => {
	loadMessage();
	
	ajax({action: 'get_page', id: id})
	.then(d => {
		console.log(d);
		
		$('.mainpage').innerHTML = '';
		
		if (!('data' in d) || typeof d.data[0] === 'undefined') {
			loadError("Page is not found");
			return;
		}
		
		const post = d.data[0];
		
		$('#page-info-block>img').src = post.post_logo;
		$('#page-info-block>h3').innerHTML = post.title;
		$('#page-info-block>p').innerHTML = post.description;
		
		$('.mainpage').innerHTML = post.content;
		
		initPageLinks();
		
		setHash(`page=${id}`);
	})
	.catch(e => {
		loadError("Unable to connect to server, try again later");
		console.warn(e);
	});
}

const loadActiveProjects = _ => {
	loadMessage();
	
	Promise.all([
		ajax({action: 'get_posts', extended: 0, limit: 4}),
		getTemplate('project-list'),
		getTemplate('project-card')
	])
	.then(values => {
		const d = values[0];
		const minCardHolderHeader = values[1];
		const minCard = values[2];
		
		let cards = [];
		
		
		d.data.forEach(item => {
			cards.push( minCard
								.replace(/%id%/g, item.id)
								.replace(/%image%/g, item.post_logo)
								.replace(/%title%/g, item.title)
								.replace(/%description%/g, item.description)
			);
		});

		$('.mainpage').innerHTML = minCardHolderHeader.replace(/%content%/g, cards.join(''));
		
		initPageLinks();
	})
	.catch(e => {
		loadError("Unable to connect to server, try again later");
		console.warn(e);
	});
}

const setHash = address => {
	location.hash = address;
}

const checkHash = e => {
	console.log(e.oldURL, ' -> ', e.newURL);
	
	let newHash = e.newURL.match(/#(.*)/, '');
	newHash = (newHash === null || typeof newHash[1] === 'undefined' ? 'tab=home' : newHash[1]);
	
	const hashParts = newHash.split('=');
	const hashType = hashParts[0];
	const hashAddress = hashParts[1];
	
	switch (hashType) {
		case 'tab':
			setTab(hashAddress);
			break;
		case 'page':
			loadPageById(hashAddress);
			break;
		default:
			setTab('home');
			break;
	}
}

const getTemplate = name => {
	return new Promise((resolve, reject) => {
		ajax({action: 'get_template', name: name})
		.then(d => {
			if (!('data' in d) || typeof d.data[0] === 'undefined') {
				// loadError("Page is not found");
				console.warn("Template is unreadable, no data", d);
				reject(new Error("Template is unreadable, no data"));
				return;
			}
			
			// console.log(d.data);
			resolve(d.data);
		})
		.catch(e => {
			reject(e);
		});
	});
}

document.addEventListener('DOMContentLoaded', _ => {
	loadActiveProjects();
	initHead();
	
	window.addEventListener('hashchange', checkHash, false);
});


