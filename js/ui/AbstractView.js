const FrontEnd = {
	_ctnMain: null,
	get ctnMain()
	{
		return this._ctnMain = this._ctnMain ?? $('#ctn-main')
	},

	elements: {},

	buildNav()
	{
		const nav = _dce('nav navbar navbar-expand-md fixed-top').addClass(
			'navbar-light bg-orange'
		);

		const container = _dce('div container-fluid ps-0').appendTo(nav);
		const brand = _dce('a navbar-brand bg-white p-0')
			.append(
				_dce('img')
					.attr('src', 'images/supercare_logo_square_bg_white.png')
					.css({
						width: '47px'
					})
			).appendTo(container);

		const navCollapseId = 'nav-collapse';

		const toggler = _dce('button navbar-toggler')
			.attr({
				'data-bs-toggle': 'collapse',
				'data-bs-target': `#${navCollapseId}`
			})
			.append(_dce('span navbar-toggler-icon'))
			.appendTo(container);

		const linkContainer = _dce('div collapse navbar-collapse bg-orange').attr(
			'id', navCollapseId
		).appendTo(container);
		const linkList = _dce('ul navbar-nav me-auto my-0').appendTo(linkContainer);

		function addLink(instance, openArgs, callback = _.noop)
		{
			const link_li = _dce('li nav-item text-center');
			const link_a = _dce('a nav-link')
				.attr({
					id: `navlink-${instance.key}`,
				})
				.text(instance.navName)
				.on('click', function (e)
				{
					linkList.find('a.nav-link').removeClass('active');
					$(this).addClass('active');

					instance.open(openArgs);
					document.title = instance.navName;

					callback();
				}).appendTo(link_li);

			link_li.appendTo(linkList);
		};

		$('body').prepend(nav);

		return {
			nav, container, brand, toggler,
			linkContainer, linkList,
			addLink
		}
	},

	init()
	{
		const {
			nav, container, brand, toggler,
			linkContainer, linkList,
			addLink
		} = this.buildNav();
		this.elements.nav = {
			nav, container, brand, toggler,
			linkContainer, linkList
		};
		this.addNavLink = function (text, callback)
		{
			addLink(text, callback)
		}
	},

	views: {
		saved: new Map(),
		save: function (abstractView)
		{
			this.saved.set(
				abstractView.key,
				abstractView
			)
		},

		getView(key)
		{
			return this.saved.get(key)
		},

		setActive(key)
		{
			for (const view of this.saved.values())
			{
				view.isActive = false;
			}
			this.getView(key).isActive = true;

			return this
		},

		setViewElement(key)
		{
			const view = this.getView(key);

			const viewContainer = FrontEnd.ctnMain;

			viewContainer.children().detach();
			viewContainer.append(
				view.container
			);

			this.setActive(key);

			return view
		},

		open(key, openArg)
		{
			return this.getView(key).open(openArg)
		},

		triggerNav(key)
		{
			if (key instanceof AbstractView) key = key.key;
			$(`#navlink-${key}`).trigger('click');
		}
	},
}

class AbstractView
{
	constructor(params)
	{
		this.key = params.key;
		this.navName = params.navName;
		this.container = params.container;

		this.isActive = false;

		FrontEnd.views.save(this);
		FrontEnd.addNavLink(this);
	}

	open()
	{
		FrontEnd.views.setViewElement(this.key);
		return this
	}

}