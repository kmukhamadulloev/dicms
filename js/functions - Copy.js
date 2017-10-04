$(document).ready(() => {
	$.ajax({
		type: 'POST',
		url: 'core/api.php',
		data: {action: 'lastActiveProjects'},
		dataType: 'json',
		success: function(d) {
			$('.mainpage').empty();
			
			var minCardHolderHeader = "<div class='mainpage-title'><h2><span><span class='icon-folder'></span> Active Projects</span></h2><p>This projects are in update or development mode.</p></div><div class='mainpage-content'><div class='minCardHolder'><ul>";
			var minCard = "<li><a href='%link%' class='minCard'><div class='minCard-object' style='background-image: url(%image%)'></div><div class='minCard-content'><h3>%title%</h3><p>%description%</p></div></a></li>";
			var minCardHolderFooter = "</ul></div></div>";
			
			for (i=0; i<d.data.length; i++) {
				var item = d.data[i];
				
				minCardHolderHeader += minCard
										.replace(/%link%/g, 'page.php?post=' + item.id)
										.replace(/%image%/g, item.post_logo)
										.replace(/%title%/g, item.title)
										.replace(/%description%/g, item.description);
			}
			
			minCardHolderHeader += minCardHolderFooter;
			
			$('.mainpage').append(minCardHolderHeader);
		}
	});
});