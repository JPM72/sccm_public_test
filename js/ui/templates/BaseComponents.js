export const Components = {
	Navigation: {},
	Main: {},
	Misc: {},
	AddComponent: function (keyPath, templateString, dataProperties)
	{
		const component = _.set(Components, keyPath, {
			keyPath, dataProperties,
			Renderer: _.template(templateString)
		});
		_.mixin(_.get(Components, keyPath), component);
		return Components
	}
}

Components.AddComponent(
	'Navigation.Top',
	`<nav class="navbar navbar-expand-lg navbar navbar-dark fixed-top" id="nav-header">
	<div class="container-fluid">
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#\${ id }"
			aria-controls="\${ id }" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarToggler">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="/img/\${ src }.png" alt="" width="32" height="32">
				</a>
			</div>
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="#">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Link</a>
			</ul>
		</div>
	</div>
</nav>`,
);
Components.AddComponent(
	'Navigation.Bottom',
	`<nav class="navbar navbar-expand-lg navbar navbar-dark fixed-top" id="nav-header">
	<div class="container-fluid">
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#\${ id }"
			aria-controls="\${ id }" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarToggler">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="/img/\${ src }.png" alt="" width="32" height="32">
				</a>
			</div>
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="#">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Link</a>
			</ul>
		</div>
	</div>
</nav>`,
);

// console.log(
// 	_.get(Components, 'Navigation.Top').Renderer({
// 		'id': 'supercare',
// 		'src': 'supercare_logo_circle_bg_white_transparent'
// 	})
// )
