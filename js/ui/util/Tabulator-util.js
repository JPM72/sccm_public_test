import { Day as RosterDay, Pattern as RosterPattern } from '../../Model/Roster.js';
const aggr = (data) => RosterPattern.AggregateFunctions(data);

Tabulator.extendModule('format', 'formatters', {
	fadeZero: function (cell, formatterParams)
	{
		const v = cell.getValue() ?? 0;
		return `<span class="${v ? 'text-dark' : 'text-muted'
			}">${v}</span>`
	},
	toggleButton: function (cell, formatterParams, onRendered)
	{
		const defaultParams = {
			button: {
				classes: {
					on: 'btn-success',
					off: 'btn-light bg-transparent border border-secondary border-opacity-50',
				}
			},
			icon: {
				src: 'check',
				classes: {
					on: 'text-dark',
					off: 'text-secondary',
				}
			},
		};
		const params = _.defaultsDeep({}, formatterParams, defaultParams);

		const {
			button: {
				classes: {
					on: b_c_on,
					off: b_c_off,
				}
			},
			icon: {
				src,
				classes: {
					on: i_c_on,
					off: i_c_off,
				}
			},
		} = params;

		const $btn = _dce('button btn shadow-none RosterTable-btn')
			.addClass(b_c_off);

		const $icon = _cbi(src, { classes: 'RosterTable-btn-svg' })
			.appendTo($btn);

		function bswp(cell)
		{
			const val = !!cell.getValue();
			$btn.bswapClass(val, b_c_on, b_c_off);
			$icon.bswapClass(val, i_c_on, i_c_off);
		}

		bswp(cell);

		onRendered(() =>
		{
			bswp(cell);
		});

		$btn
			.on(
				'click',
				function (e)
				{
					cell.edit();
					let v = !!cell.getValue();
					cell.setValue(!v);
					$btn.trigger('change');
				}
			);

		return $btn[0]
	}
});
Tabulator.extendModule('edit', 'editors', {
	toggleButton: function (cell, onRendered, success, cancel, editorParams)
	{
		const $btn = $(cell.getElement()).find('button.RosterTable-btn');

		function sf()
		{
			success(!!cell.getValue())
		};
		// onRendered(() => { $btn[0].focus() });

		function cf() { cancel(); }
		$btn.on('change', sf)
		$btn.on('blur', cf)

		return $btn[0];
	}
});

Tabulator.extendModule("validate", "validators", {
	notNil: function (cell, value, parameters)
	{
		const cellValue = cell.getValue();

		if (_.isNil(cellValue)) return true;

		return !!cellValue.valid;
	},
	RosterDay: function (cell, value, parameters)
	{
		const rosterDay = cell.getValue();
		if (rosterDay === value)
		{
			value = rosterDay.hours;
		};

		if (RosterDay.Test.hours(value))
		{
			return true
		} else
		{
			return false
		}
	},
	RosterPattern: function (cell, value, parameters)
	{
		const weekMax = parameters?.week?.max ?? RosterPattern.Constraints.week.max;

		const thisWeek = cell.getValue().week;
		const data = cell.getData();
		const weekSum = _(data.days)
			.filter({ week: thisWeek, scheduled: true })
			.sumBy('hours');

		if (RosterDay.Test.hours(value) === false) return false;

		let hours = value;
		if (value instanceof RosterDay)
		{
			hours = value.hours;
		}

		return weekSum + hours <= weekMax
	}
});