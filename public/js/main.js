const articles = document.getElementById('table_list_articles');

if (articles) {
	articles.addEventListener('click', (e) => {
		if (e.target.classList.contains ('delete-article')) {
			if (confirm('Are you sure?')) {
				const id = e.target.getAttribute('data-id')
				fetch(`/article/delete/${id}`, {
					method: 'DELETE'
				}).then( res => {
					window.location.reload();
				}).catch(error => {
					console.error(error);
				});
			}
		}
	});
}