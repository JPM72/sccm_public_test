import { _dce } from '../../jc.js';

$.fn.extend({
	attachFocusIndicator(io = true)
	{
		if (!io) return this;
		const input = this.children('input, select').first();
		if (!input.length) return this;

		const element = _dce('div rounded border-bottom border-3 border-primary')
			.addClass('ui_input-focus_indicator ui_input-focus_indicator_focusout')
			.on({
				'focus:in': function ()
				{
					$(this).bswapClass(
						true,
						'ui_input-focus_indicator_focusin',
						'ui_input-focus_indicator_focusout'
					);
				},
				'focus:out': function ()
				{

					$(this).bswapClass(
						false,
						'ui_input-focus_indicator_focusin',
						'ui_input-focus_indicator_focusout'
					);
				}
			})

		input.on({
			'focusout': function (e) { element.trigger('focus:out') },
			'focusin': function (e) { element.trigger('focus:in') },
		})

		this.append(element)

		return this
	}
});
$.fn.extend({
	bswapClass: function (b, cOn, cOff)
	{
		if (_.isUndefined(cOff))
		{
			this.toggleClass(cOn, b);
			return this
		}

		this
			.toggleClass(cOn, b)
			.toggleClass(cOff, !b);

		return this
	},
	pulseClass: function (class_es, delay = 0)
	{
		if (delay)
		{
			this.toggleClass(class_es).delay(delay).toggleClass(class_es)
			return this
		} else
		{
			this.toggleClass(class_es).toggleClass(class_es)
			return this
		}
	}
});