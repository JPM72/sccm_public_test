export class DateTime extends Date
{
	static #DAY_NAMES = [
		'Sunday'
		, 'Monday'
		, 'Tuesday'
		, 'Wednesday'
		, 'Thursday'
		, 'Friday'
		, 'Saturday'
	];
	static DayNames({
		nChars,
		weekStartingMonday = false
	} = {})
	{
		let names = [...DateTime.#DAY_NAMES];
		if (weekStartingMonday)
		{
			names = [...names.slice(1), names[0]]
		}
		return names.map(
			name => name.slice(0, nChars)
		);
	}
	static #MONTH_NAMES = [
		"January",
		"February",
		"March",
		"April",
		"May",
		"June",
		"July",
		"August",
		"September",
		"October",
		"November",
		"December"
	];

	static #SQL_REGEX_DATE = /20\d{2}(-|\/)((0[1-9])|(1[0-2]))(-|\/)((0[1-9])|([1-2][0-9])|(3[0-1]))/;
	static #SQL_REGEX_SPLIT = /(?:\s|\-|\:|\.)/;

	static #MS_DAY = (1000 * 60 * 60 * 24);

	static get [Symbol.species]()
	{
		return DateTime
	}

	clone()
	{
		return new DateTime(this.valueOf());
	}

	shiftDate(i = 1)
	{
		this.setDate(this.getDate() + i);
		return this
	}
	cshiftDate(i = 1)
	{
		return this.clone().shiftDate(i)
	}

	static dateRange(dt, ...args)
	{
		let start, stop, step;
		switch (args.length)
		{
			case 1:
				start = 0;
				stop = args[0];
				step = 1;
				break;
			case 2:
				[start, stop] = args;
				step = 1;
				break;
			case 3:
				[start, stop, step] = args;
				break;
		}

		const shifts = _.range(start, stop, step);
		const dates = shifts.map(i =>
		{
			return dt.clone().shiftDate(i)
		});

		return dates
	}

	getDay(weekStartingMonday = false)
	{
		let dayIndex = super.getDay();
		if (!weekStartingMonday) return dayIndex;

		return (dayIndex || 7) - 1
	}
	getDayString(
		weekStartingMonday = false,
		{
			strlen = 2
		} = {}
	)
	{
		const day = this.getDay(weekStartingMonday);
		let str = DateTime.#DAY_NAMES[day];
		if (strlen > 0)
		{
			str = str.slice(0, strlen)
		}
		return str
	}


	static DateStart(dt)
	{
		const ms = dt.getTime();
		return parseInt(ms - ms % DateTime.#MS_DAY)
	}
	toDateStart()
	{
		this.setTime(DateTime.DateStart(this));
		return this
	}

	daysTo(dt)
	{
		return parseInt(
			(DateTime.DateStart(dt) - DateTime.DateStart(this)) / DateTime.#MS_DAY
		)
	}

	toYMDString(delimiter = '-')
	{
		return `${this.getFullYear()
			}${delimiter
			}${(`${this.getMonth() + 1}`).padStart(2, '0')
			}${delimiter
			}${(`${this.getDate()}`).padStart(2, '0')
			}`
	}
	toHMString(delimiter = ':')
	{
		return `${(`${this.getHours()}`).padStart(2, '0')
			}${delimiter
			}${(`${this.getMinutes()}`).padStart(2, '0')
			}`
	}

	static fromSQL(s)
	{
		let arr = s
			.split(DateTime.#SQL_REGEX_SPLIT)
			.map((x, i) =>
				i === 1 ? (parseInt(x) - 1) : parseInt(x)
			);
		return new DateTime(...arr)
	}
	static toSQL(dt)
	{
		return dt.toYMDString()
	}
	toSQL()
	{
		return this.toYMDString()
	}

	static create(...arg)
	{
		return new DateTime(new Date(arg))
	}

	static parse(
		dt,
		{
			parseStrict = false
		} = {}
	)
	{
		// short-circuit for getting current date
		if (dt === null && !parseStrict)
		{
			return new DateTime();
		}

		let date = new Date(dt);
		if (!_.isNaN(date.getTime()))
		{
			return new DateTime(date.valueOf())
		} else if (parseStrict)
		{
			throw new Error(`DateTime Error: Failed to parse value ${dt} in strict mode`)
		} else
		{
			return new DateTime();
		}

	}


}

/**
 * For a DOM element, create it, add classes to it, and set the default type attr as a function of tag
 * @param {string} q - tag name optionally followed by classes, separted by spaces
 * @returns {JQuery} o - the resulting jQuery object
 */
export function _dce(q)
{
	const
		s = q.split(' '),
		tag = s[0],
		o = document.createElement(tag);

	if (s.length - 1) $(o).addClass(s.slice(1).join(' '));

	switch (tag)
	{
		case 'button':
			$(o).attr('type', 'button');
			break;
		case 'input':
			$(o).attr('type', 'text');
			break;
	}

	return $(o)

}

/**
* Create and return a boostrap svg icon
* @param {string} ifn - bootstrap icon name
* @param {number} [width = 24] - The displayed width of the rectangular viewport
* @param {number} [height = 24] - The displayed height of the rectangular viewport
* @param {string} [fill = currentColor] - Fill colour
* @param {string} [classes = ''] - classes to add to the SVG node, separated by spaces
* @returns {JQuery} _svg - resuling jQuery SVG object
*/
export function _cbi
	(
		ifn,
		{
			width = 24,
			height = width ?? 24,
			fill = 'currentColor',
			classes = 'bi'
		} = {}
	)
{
	const
		_svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg'),
		_use = document.createElementNS('http://www.w3.org/2000/svg', 'use');

	_use.setAttributeNS(
		'http://www.w3.org/1999/xlink',
		'xlink:href',
		`bootstrap-icons.svg#${ifn}`
	);
	$(_svg)
		.addClass(classes)
		.addClass(`bi-${ifn}`)
		.attr({
			width: width,
			height: height,
			fill: fill
		})
		// .css({
		// 	width: width,
		// 	height: height,
		// })
		.append(
			_use
		);

	return $(_svg)
}

export function _forceNumber(
	value,
	{
		positive = true,
		integer = false,
		clamp = null,
		allowNull = false
	} = {}
)
{
	if (_.isNil(value))
	{
		if (allowNull)
		{
			return null
		} else
		{
			return 0
		}
	}

	const valueType = typeof value;

	if (valueType !== 'number')
	{
		if (valueType === 'string')
		{
			value = Number(value);
		}

		if (!_.isFinite(value))
		{
			value = 0;
		}
	}

	if (positive)
	{
		value = Math.abs(value)
	}

	if (integer)
	{
		value = parseInt(value)
	}

	if (_.isArray(clamp))
	{
		value = _.clamp(value, ...clamp)
	}

	return value
}

export function _toFixed(
	n,
	{
		decimals = 2,
		zeroDecimals = false
	} = {}
)
{
	const m = Number.parseFloat(n);
	if (!m && !zeroDecimals)
	{
		return m.toFixed(0)
	} else
	{
		return m.toFixed(decimals)
	}
}

export function _defaults(obj, ...sources)
{
	for (const source of sources)
	{
		_.merge(
			obj,
			_.pickBy(source, (value, key) =>
			{
				return _.hasIn(obj, key)
			})
		);
	}
	return obj
}