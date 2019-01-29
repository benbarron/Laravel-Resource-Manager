<header class="l-header">
  <div class="l-header__inner clearfix">
    <div class="c-search">
      <input class="c-search__input u-input" id="global-search-input" placeholder="Search..." type="text"/>
    </div>
    <div class="header-icons-group">
      <div class="c-header-icon logout"><a href="/admin/logout/{{ Auth::user()->id }}"><i class="fas fa-sign-out-alt"></i></a></div>
    </div>
	</div>
</header>

<script>
  let globalSearchInput = document.getElementById('global-search-input');
  globalSearchInput.addEventListener('keyup', runQuery);
  function runQuery () {
  	var status = false;
  	let searchValue = document.getElementById('global-search-input').value;
  	if(searchValue == '') {
  		document.getElementById('search-results-users').innerHTML = '';
  		document.getElementById('search-results-models').innerHTML = '';
  		document.getElementById('search-results-entries').innerHTML = '';
  	} else {
  		//users query
	  	var xhr = new XMLHttpRequest();
	  	xhr.open('GET', '/global-search/api/users/'+searchValue ,true);
	  	xhr.onload = function () {
	  		if (this.status == 200) {
	  			var users = JSON.parse(this.response);
	  			console.log(users);
	  			var items = '';
	  			for(i in users) {
	  				if (users[i].IsAdmin == 0) {

	  					var userType = "Normal User";
	  				} else {
	  					var userType = "Admin";
	  				}
	  				items +=
	  				"<li class='list-group-item'>" +
	  				"<h5 class='mr-50'><b>"+ users[i].name + "  |  " + userType +"</b></h5>" + "<h5 class='mr-50'>"+ users[i].email +"</h5>" +
	  				"</li>";
	  			}
	  			if (users.length > 0) {
	  				var usersOutput = "<div class='mb-50'><ul class='list-group rounded-0'><li class='list-group-item list-group-item-sedondary'><h2 style='font-weight:lighter;'>Users</h2></li>"+items+"</ul></div>";
	  				document.getElementById('search-results-users').innerHTML = usersOutput;
	  			} else {
	  				document.getElementById('search-results-users').innerHTML = '';
	  			}
	  		}
	  		if (this.status == 404) {
	  			status = false;
	  		}
	  	}
	  	xhr.send();

	  	//models query
	  	var xhr = new XMLHttpRequest();
	  	xhr.open('GET', '/global-search/api/models/'+searchValue ,true);
	  	xhr.onload = function () {
	  		if (this.status == 200) {
	  			var models = JSON.parse(this.response);
	  			console.log(models);
	  			var items = '';
	  			for(i in models) {
	  				items +=
	  				"<a href='/admin/models/edit/"+ models[i].name +"/"+ models[i].tableName +"'><li class='list-group-item list-group-item-action'>" +
	  				"<h5>Model name: "+models[i].name +"</h5>" + "<h5>Table name: "+models[i].tableName +"</h5>" +
	  				"</li></a>";
	  			}
	  			if (models.length > 0) {
	  				var modelsOutput = "<div class='mb-50'><ul class='list-group rounded-0'><li class='list-group-item list-group-item-sedondary'><h2 style='font-weight:lighter;'>Models</h2></li>"+items+"</ul></div>";
	  				document.getElementById('search-results-models').innerHTML = modelsOutput;
	  			} else {
	  				document.getElementById('search-results-models').innerHTML = '';
	  			}
	  		}
	  		if (this.status == 404) {
	  			status = false;
	  		}
	  	}
	  	xhr.send();

	  	//entries query
	  	var xhr = new XMLHttpRequest();
	  	xhr.open('GET', '/global-search/api/entries/'+searchValue ,true);
	  	xhr.onload = function () {
	  		if (this.status == 200) {
	  			var entries = JSON.parse(this.response);
	  			console.log(entries);
	  			var items = '';
	  			for(var i in entries) {
		  				items+=
		  				"<a href='/admin/models/edit/entry/"+ entries[i].modelName +"/"+ entries[i].tableName +"/"+entries[i].id +"' class='list-group-item list-group-item-action'>" +
		  				"<h5>Title: "+entries[i].title +"</h5>" + "<h5>Parent Table: "+entries[i].tableName+"</h5>" +
		  				"</a>";
	  			}
	  			if ( entries.length > 0 ) {
	  				var entriesOutput = "<div class='mb-50'><ul class='list-group rounded-0'><li class='list-group-item list-group-item-sedondary'><h2 style='font-weight:lighter;'>Entries</h2></li>"+items+"</ul></div>";
	  				document.getElementById('search-results-entries').innerHTML = entriesOutput;
	  			} else {
	  				document.getElementById('search-results-entries').innerHTML = '';
	  			}
	  		}
	  		if ( this.status = 404) {

	  		}
	  		if ( this.status == 500 ) {
	  			document.getElementById('search-results-entries').innerHTML = '';
	  		}
	  	}
	  	xhr.send();
	  }
  }
</script>
