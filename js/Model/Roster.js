import { DateTime, _defaults } from '../jc.js';

const DayNamesIndexed = _(DateTime.DayNames({ weekStartingMonday: true })).map(
	(name, i) => [_.toLower(name), i]
).thru(
	(arr) => _.fromPairs(arr)
).value();

export class Day
{
	static Constraints = {
		hours: {
			max: 12,
			min: 6,
		},
	}
	static Test = {
		hours: function (h)
		{
			if (h instanceof Day)
			{
				h = h.hours;
			}
			return _.overSome([
				(h) => _.includes([undefined, null, 0, ''], h),
				(h) => _.inRange(
					h,
					this.Constraints.hours.min,
					this.Constraints.hours.max + 1,
				)
			])
		}
	}

	#day = 0;
	get day() { return this.#day }
	#hours = null;

	get hours() { return this.#hours }
	set hours(hours)
	{
		const prev = this.#hours;
		this.#hours = hours
		if (
			this.callbacks.onChange
			&&
			prev !== this.#hours
		)
		{
			this.callbacks.onChange.fire(this, this.#hours, hours, prev)
		}
	}

	#week = 0;
	get week() { return this.#week }

	constructor(
		day, hours,
		{
			callbacks
		} = {}
	)
	{
		// _defaults(this, { day, hours });
		this.#hours = hours ?? null;
		this.#day = day ?? 0;
		this.#week = parseInt(day / 7);

		_.assign(
			this.callbacks,
			callbacks ?? {},
		)
	}

	static create(...p)
	{
		return new this(...p)
	}

	get scheduled() { return this.#hours !== null }
	get isOn()
	{
		return new Proxy(
			this, {
			get: (object, key, proxy) =>
			{
				if (_.has(DayNamesIndexed, key))
				{
					return (object.day % 7) === DayNamesIndexed[key]
				} else
				{
					return false
				}
			}
		}
		)
	}
}
window.Day = Day;

export class Pattern
{
	seq = 1;
	#days = _.range(0, 28).map(i => Day.create(i));
	#aggregates;
	callbacks = {
		days: {
			onChange: $.Callbacks('unique'),
			onValidationFail: $.Callbacks('unique'),
		}
	}
	constructor(seq, days)
	{
		days = days ?? this.#days;
		_defaults(this, { seq });

		if (_.isArray(days))
		{
			if (_.every(days, (d) => d instanceof Day))
			{
				this.#days = days;
			} else
			{
				this.schedule(days);
			}
		}
		this.#init();
	}

	#init()
	{
		const { onChange, onValidationFail } = this.callbacks.days;
		this.#days.forEach(d =>
		{
			_.assign(d, { callbacks: { onChange } })
		});

		onChange.add((day, hours, input, prev) =>
		{
			const { week } = day;
			const weekHours = _(this.#days).filter(
				'scheduled'
			).filter(
				d => d.week == week
			).sumBy('hours');
			// console.log(day, week, weekHours)

			if (weekHours > Pattern.Constraints.week.max)
			{
				onValidationFail.fire({
					pattern: this, day,
					cPath: 'Pattern.Constraints.week.max',
					reason: `Week total exceeded legal maximum (${Pattern.Constraints.week.max
						} hours).`,
				})
			}
		});

		// onValidationFail.add((day, cPath, reason) => {
		// 	const days = _.filter(this.#days, d => (d.week === day.week));
		// })

		this.#setDays();
		this.#aggregates = Pattern.AggregateFunctions({ days: this.#days });
	}

	static Constraints = {
		week: {
			max: 55
		},
		count: {
			min: 7,
			max: 28,
		}
	}

	static #Constants = {
		WeeksPerMonth: 4.33
	}
	static get Constants()
	{
		return _.cloneDeep(Pattern.#Constants)
	}

	on(callbackPath_s, handler)
	{
		_(_.castArray(callbackPath)).forEach(cbp =>
		{
			_.at(this.callbacks, cbp).add(handler);
		})

		return this
	}

	get aggregates()
	{
		return this.#aggregates = this.#aggregates ?? Pattern.AggregateFunctions({ days: this.#days })
	}

	#setDays()
	{
		const _this = this;
		_(this.#days).forEach(day =>
		{
			Object.defineProperty(day, 'getPattern', {
				get()
				{
					return _this;
				},
				enumerable: true
			})
		});
		const days = this.#days;
		this.days = new Proxy({}, {
			get(t, prop, receiver)
			{
				if (prop in days)
				{
					return days[prop];
				}
				if (_.startsWith(prop, 'day_'))
				{
					let key = parseInt(prop.split('day_', 2)[1]);
					return days[key]
				}
			}
		});
	}

	static AggregateFunctions({ days })
	{
		return {
			get scheduled()
			{
				return _(days).filter('scheduled').value();
			},
			get count()
			{
				return this.scheduled.length;
			},
			get inPattern()
			{
				return this.count || null
			},
			get patternValid()
			{
				const { inPattern: daysInPattern } = this;
				if (_.isNull(daysInPattern)) return null;

				const { min, max } = Pattern.Constraints.count;

				if (daysInPattern < min)
				{
					return {
						valid: false,
						reason: 'Pattern too short',
						value: min
					}
				} else if (daysInPattern > max)
				{
					return {
						valid: false,
						reason: 'Pattern too long',
						value: max
					}
				} else if (this.min > 0)
				{
					return {
						valid: false,
						reason: 'At least one day off required per week'
					}
				} else
				{
					return {
						valid: true,
					}
				}
			},
			get sum()
			{
				return _(this.scheduled).sumBy('hours');
			},
			get sumBy()
			{
				return function (...args)
				{
					return _.sumBy(days, ...args)
				}
			},
			get avg()
			{
				const len = this.count;
				if (!len) return 0;
				return this.sum / len;
			},
			get max()
			{
				return _.maxBy(this.scheduled, 'hours')?.hours ?? null;
			},
			get min()
			{
				return _.minBy(this.scheduled, 'hours')?.hours ?? null;
			},
			get avgHrFactors()
			{
				const {
					inPattern: daysInPattern,
					scheduled,
					sum: hourSum
				} = this;

				const ahf = {
					weekly: {
						normal: null,
						overtime: null,
						sunday: null,
					},
					monthly: {
						normal: null,
						overtime: null,
						sunday: null
					}
				}

				if (_.isNil(daysInPattern)) return ahf;
				const _this = this;

				let dividend = scheduled;
				if (daysInPattern && (daysInPattern % 7 === 0))
				{
					dividend = 7 * _(dividend).reject('isOn.sunday').sumBy('hours');
				} else
				{
					dividend = 6 * hourSum;
				}

				const weekly_nt_ot = dividend / daysInPattern;

				ahf.weekly = {
					normal: _.clamp(weekly_nt_ot, 0, 45),
					overtime: weekly_nt_ot,
					sunday: (7 * hourSum) / daysInPattern,
				}

				const weeksPerMonth = Pattern.Constants.WeeksPerMonth;
				const [
					m_nt,
					m_ot,
					m_st
				] = [
					ahf.weekly.normal,
					weekly_nt_ot - ahf.weekly.normal,
					ahf.weekly.sunday - weekly_nt_ot,
				].map(h => h * weeksPerMonth);

				ahf.monthly = {
					normal: m_nt,
					overtime: m_ot,
					sunday: m_st,
				}

				return ahf
			}
		}
	}

	static create(...args)
	{
		return new this(...args);
	}
	schedule(arr = [])
	{
		arr.forEach((h, i) =>
		{
			this.days[i].hours = h;
		})
		return this
	}
	clear()
	{
		_(this.#days).forEach(d => d.hours = null);
	}

	_getDays()
	{
		return this.#days
	}
}
window.Pattern = Pattern;

export class Shift
{
	static PatternsAreEqual(firstPattern, columnAverages)
	{
		const keys = [
			'daysInPattern',
			'avgHrFactors.weekly.normal.value',
			'avgHrFactors.weekly.sunday'
		];

		const values = {
			columnAverages: _.at(columnAverages, [
				'daysInPattern',
				'avgHrFactors.weekly.normal',
				'avgHrFactors.weekly.sunday'
			]),
			firstPattern: _.at(firstPattern, [
				'daysInPattern',
				'avgHrFactors.weekly.normal.value',
				'avgHrFactors.weekly.sunday'
			])
		}

		// console.log(values)

		if (_.includes(values.columnAverages, null)) return null;

		return _.isEqual(values.columnAverages, values.firstPattern)
	}
	constructor()
	{

	}
}
window.Shift = Shift;