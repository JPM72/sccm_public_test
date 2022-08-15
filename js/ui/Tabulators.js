import { DateTime, _cbi, _dce, _toFixed } from "../jc.js";
import { LocalData } from "../Model/localData.js";
import './util/common.js';
import './util/Tabulator-util.js';

import { Day as RosterDay, Pattern as RosterPattern, Shift } from "../Model/Roster.js";

const DayNames = DateTime.DayNames({ weekStartingMonday: true });

export class RosterTabulator
{
	static get RootContainer()
	{
		// return $('#ctn-main')
		// return $('#ctn-content')
		return $('#ctn-content-col')
	}
	#table_id = null;
	get table_id()
	{
		return this.#table_id = this.#table_id ?? _.uniqueId(
			'roster'
		)
	}

	static #components = {
		containers: {
			root: _dce('div shadow-lg bg-white rounded RosterTable-ctn mb-3'),
			head: _dce('div row g-2 bg-warning bg-gradient border border-warning rounded-top'),
			table: _dce('div row g-2 border border-top-0 border-warning rounded-bottom'),
			summary: _dce('div row g-2 border border-top-0 border-warning rounded-bottom'),
			assemble()
			{
				const root = this.root.clone();
				const head = this.head.clone(true).appendTo(root);
				const table = this.table.clone().appendTo(root);
				// const summary = this.summary.clone().appendTo(root);
				return {
					root, head, table,
					// summary
				}
			}
		},
		table: {
			wrapper: _dce('div w-100 py-1 bg-white')
			// .addClass('rounded-bottom')
			,
			element: _dce('div'),
			assemble(id)
			{
				const wrapper = this.wrapper.clone();
				const element = this.element.clone().attr('id', id).appendTo(wrapper);

				return {
					wrapper, element
				}
			}
		},
		controls: {
			container: _dce('div mb-1 mt-0 col col-lg-auto'),
			wrapper: _dce('div position-relative h-100 d-flex align-items-end justify-content-center'),


			buttonGroup: _dce('div btn-group'),
			assemble()
			{
				const container = this.container.clone();
				const wrapper = this.wrapper.clone();
				const buttonGroup = this.buttonGroup.clone();
				container.append(wrapper.append(buttonGroup));
				return {
					container,
					wrapper,
					buttonGroup,
					addBtn(...btn)
					{
						return buttonGroup.append(...btn)
					}
				}
			}
		},
		summary: {

		},
		job_title: {
			container: _dce('div mb-1 mt-0 me-auto')
				.addClass('col-12 col-lg-5'),
			spacer: _dce('div mb-1 mt-0 col-12 col-lg-1'),
			wrapper: _dce('div position-relative'),

			select: _dce('select form-select shadow-none form-select-sm')
				.append(
					_dce('option')
						.prop({
							selected: true,
							value: null
						})
						.text('Select Labour Category')
				)
			,

			label: _dce('label form-label form-label-snug')
				.text('Labour Category'),

			assemble(id)
			{
				const selId = `${id}_job_title`;

				const select = this.select.clone(true)
					.attr('id', selId);
				const label = this.label.clone()
					.attr('for', selId);

				const wrapper = this.wrapper.clone().append(label, select).attachFocusIndicator();

				const spacer = this.spacer.clone();
				const container = this.container.clone().append(wrapper);

				return {
					container,
					spacer,
					wrapper,
					select,
					label,
					get value()
					{
						return parseInt(select.prop('value'))
					}
				}
			}
		},
	}

	assemble()
	{
		const table_id = this.table_id;

		const components = RosterTabulator.#components;

		this.containers = components.containers.assemble();

		this.job_title = components.job_title.assemble(table_id);
		this.controls = components.controls.assemble(table_id);

		this.containers.head.append(
			this.job_title.container,
			this.job_title.spacer,
			this.controls.container
		);

		const opts = _(LocalData.JobTitles).map((name, id) =>
		{
			return _dce('option')
				.prop('value', parseInt(id))
				.text(name)
		});

		this.job_title.select.append(...opts);

		this.tableElement = components.table.assemble(table_id);
		this.tableElement.wrapper.appendTo(this.containers.table);

		return this
	}

	static #DefaultTableOptions = {
		columnDefaults: {
			headerSort: false,
			headerHozAlign: 'center',
			hozAlign: 'center',
			vertAlign: 'middle',
			resizable: false,
		},

		clipboard: true,
		clipboardPasteAction: "replace",
		// clipboardCopyConfig: {
		// 	columnHeaders: false,
		// 	columnGroups: false,
		// 	rowGroups: false,
		// 	columnCalcs: false,
		// 	dataTree: false,
		// 	// formatCells:false,
		// },

		clipboardPasteParser: function (s)
		{
			let rows = _.split(s, /\n|\r/gmi);

			let columns = _(rows).map(r => _.split(r, /\t/gmi)).value()

			columns = _.filter(columns, c => c.length > 1).map(
				(r) => r.map(
					(cell, i) => RosterDay.create(i, _.toNumber(cell))
				)
			).map((days, seq) => new RosterPattern(seq + 1, days));

			console.log(columns)
			return columns
		},

		// maxHeight: '100%',
		// maxHeight: 768,
		height: '100%',
		maxHeight:"100%",
		// maxHeight: 'calc(100vh - 48px)',
		// maxHeight: 850,
		// width: '100%',
		// rowHeight: 24,
		layout: 'fitColumns',
		columnHeaderVertAlign: 'bottom',
		// reactiveData: true,
		// nestedFieldSeparator: false,

		index: 'seq',
		validationMode: 'highlight',
		// validationMode: 'blocking',
	}

	static ColumnMethods = {
		Formatters: {
			NumericNullable: (cell, formatterParams, onRendered) =>
			{
				const { replacer = _toFixed } = formatterParams;

				const value = cell.getValue();
				if (_.isNil(value)) return '';

				return replacer(value);
			},
		},
		bottomCalc: {
			AvgNonZero: (values, data, calcParams) =>
			{
				let {
					dataKey = null,
					callbacks = {}
				} = calcParams;

				const columnValues = _.filter(values, (v) => !_.isNil(v));
				if (!columnValues.length) return 0;

				const newValue = (
					dataKey ?
						_.sumBy(columnValues, dataKey) :
						_.sum(columnValues)
				) / columnValues.length;

				// _.forIn(callbacks, cb => cb.fire(newValue));

				return newValue
			},
		}
	}

	static get BaseDayColumn()
	{
		return {
			cssClass: 'roster-lastGroupColumn roster-day-cell',
			width: 36,
			minWidth: 36,
			validator: [
				{
					type: 'RosterDay',
					parameters: RosterDay.Constraints,
				},
				{
					type: 'RosterPattern',
					parameters: RosterPattern.Constraints
				}
			],
			titleFormatter: (cell, formatterParams, onRendered) =>
			{
				const { charLength = 1 } = formatterParams;

				const index = parseInt(cell.getValue().index);

				return `${DayNames[index % 7].slice(0, charLength)}`
			},
			mutatorEdit: (value, data, type, params, cell) =>
			{

				/** see editor */
				let inputValue = value === '' ? null : value;

				cell.getValue().hours = inputValue;
				return cell.getValue()
			},
			mutatorClipboard: (value, data, type, params, cell) =>
			{
				return value instanceof RosterDay ? value.hours : value
			},
			accessorData: (rosterDay) =>
			{
				return rosterDay
			},
			accessor: (rosterDay) =>
			{
				return rosterDay.hours
			},
			formatter: (cell, formatterParams, onRendered) =>
			{
				const rosterDay = cell.getValue();

				return rosterDay.scheduled ? rosterDay.hours : '';
			},
			editor: (cell, onRendered, success, cancel, editorParams) =>
			{
				const rosterDay = cell.getValue();

				/**type: 'number' does not play nice with null values */
				const inputAttr = _.assign(
					{},
					// { type: 'number' },
					RosterDay.Constraints.hours
				);

				const $input = _dce('input').attr(
					inputAttr
				).css({
					width: '100%',
					'boxSizing': 'border-box'
				}).val(
					rosterDay.hours
				).on('keydown', function (ev)
				{
					const e = ev.originalEvent;
					switch (e.keyCode)
					{
						/* Enter */
						case 13:
							onChange();
							break;
						/* Esc */
						case 27:
							cancel();
							break;

						/* End */
						case 35:
						/* Home */
						case 36:
							e.stopPropagation();
							break;
					}
				});

				function onChange()
				{
					let inputVal = _.trim($input.val());

					/** handle empty inputs to not be parsed as zero */
					if (inputVal === '')
					{
						inputVal = null
					} else
					{
						inputVal = Number(inputVal);
					}

					if (inputVal === rosterDay.hours)
					{
						cancel();
					}
					else if (success(inputVal))
					{
						// rosterDay.hours = inputVal
					}
				}
				const onBlur = function (e)
				{
					onChange();
				}

				onRendered(() =>
				{

					$input.off('blur', onBlur);

					$input.css('height', '100%')[0].focus({ preventScroll: true });

					$input.on('blur', onBlur);

					$input[0].select();
				})

				return $input[0]
			},
			mutateLink: [
				'daysInPattern',
				'avgHrFactors.weekly.overtime',
				'avgHrFactors.weekly.normal',
				'avgHrFactors.weekly.sunday',

				'avgHrFactors.monthly.normal',
				'avgHrFactors.monthly.overtime',
				'avgHrFactors.monthly.sunday',
			],
		}
	}
	static DayColumn(index = 0)
	{
		const col = _.assign({
			title: { index },
			field: `days.day_${index}`,
		}, RosterTabulator.BaseDayColumn
		);

		if (index && (index + 1) % 7 == 0)
		{
			_.assign(col, { cssClass: 'roster-lastGroupColumn roster-day-cell' });
		}
		return col
	}

	static generateColumns(rosTabInstance)
	{
		const weeksPerMonth = RosterPattern.Constants.WeeksPerMonth;
		/** workaround for column calculations
		 * not being able to access the table directly
		 */
		const hwColCalc = () =>
		{
			const { calcResults } = rosTabInstance;
			return calcResults ?? null
		}
		function botCalcMonthAvg(values, data, calcParams)
		{
			const normal_overtime = calcParams?.bottom?.avgHrFactors.weekly.overtime ?? null;

			if (_.isNil(normal_overtime)) return 0;
			const columnValues = _.filter(values, (v) => !_.isNil(v));
			if (!columnValues.length) return 0;

			return _.sum(columnValues) / columnValues.length;
		}

		const aggr = (data) => RosterPattern.AggregateFunctions(data);

		const formatNumNull = RosterTabulator.ColumnMethods.Formatters.NumericNullable;
		const bcAvgNonZero = RosterTabulator.ColumnMethods.bottomCalc.AvgNonZero;

		const dayColumns = _([0, 28]).thru(
			v => _.range(...v)
		).map(
			RosterTabulator.DayColumn
		).chunk(
			7
		).map(
			(days, weekIndex) =>
			({
				title: `Week ${weekIndex + 1}`,
				columns: days,
				cssClass: 'roster-lastGroupColumn',
			})
		).value();

		const columns = [
			{
				frozen: true,
				maxWidth: 128,
				title: 'SAP EE No',
				field: 'sapEeNo',
				cssClass: 'roster-lastGroupColumn',
				editor: true,
			},
			{
				frozen: true,
				title: 'Seq'
				, field: 'seq'
				, cssClass: 'roster-lastGroupColumn'
				, width: 40
			},
			{
				width: 40,
				title: 'DIP',
				field: 'daysInPattern',
				mutator: (value, data, type, params, column) =>
				{
					return aggr(data).inPattern
				},
				bottomCalc: bcAvgNonZero,
				formatter: (cell) =>
				{
					const value = cell.getValue();
					return !!value ? value : ''
				},
				bottomCalcFormatter: formatNumNull,
				bottomCalcFormatterParams: {
					replacer: (v) =>
					{
						return _.isInteger(v) ? v : _toFixed(v)
					}
				}
			},
			{
				minWidth: 64,
				title: 'NT AHF',
				field: 'avgHrFactors.weekly.normal',
				cssClass: 'roster-lastGroupColumn',
				mutator: (value, data, type, params, column) =>
				{
					const {
						patternValid,
						avgHrFactors: {
							weekly: {
								normal: ntHours
							}
						}
					} = aggr(data);

					if (patternValid?.valid === true)
					{
						return {
							valid: true,
							value: ntHours
						}
					} else
					{
						return patternValid
					}
				},
				formatter: (cell, formatterParams, onRendered) =>
				{
					const value = cell.getValue();
					if (_.isNil(value)) return '';

					// if (value?.valid === true) return _toFixed(value);

					if (_.isPlainObject(value))
					{
						const {
							valid: isValid,
							value: cellValue
						} = value;

						rosTabInstance.$footerElement.css('height', '100%');

						if (isValid === true)
						{
							rosTabInstance.$footerElement.empty();
							return _toFixed(cellValue);
						} else
						{
							rosTabInstance.$footerElement.text(value.reason);
							return ''
						}
					} else
					{
						return '?';
					}
				},
				validator: [{
					type: 'notNil',
					parameters: {}
				}],
				bottomCalc: bcAvgNonZero,
				bottomCalcParams: {
					dataKey: 'value',
					callbacks: rosTabInstance.callbacks ?? {}
				},
			},
			...dayColumns,
			{
				title: 'Weekly Hrs',
				cssClass: 'roster-lastGroupColumn',
				columns: [
					{
						minWidth: 64,
						title: 'N/O',
						field: 'avgHrFactors.weekly.overtime',
						mutator: (value, data, type, params, column) =>
						{
							return aggr(data).avgHrFactors.weekly.overtime
						},
						bottomCalc: bcAvgNonZero,
						formatter: formatNumNull,
						bottomCalcFormatter: formatNumNull,
					},
					{
						minWidth: 64,
						cssClass: 'roster-lastGroupColumn',
						title: 'N/O/S',
						field: 'avgHrFactors.weekly.sunday',
						mutator: (value, data, type, params, column) =>
						{
							return aggr(data).avgHrFactors.weekly.sunday
						},
						bottomCalc: bcAvgNonZero,
						formatter: formatNumNull,
						bottomCalcFormatter: formatNumNull,
						// , mutator
						// , bottomCalc
					},
				],
			},
			{
				title: 'Monthly Hrs',
				columns: [
					{
						minWidth: 64,
						title: 'N',
						field: 'avgHrFactors.monthly.normal',
						mutator: (value, data, type, params, column) =>
						{
							return aggr(data).avgHrFactors.monthly.normal
						},
						bottomCalc: botCalcMonthAvg,
						bottomCalcParams: hwColCalc,
						formatter: formatNumNull,
						bottomCalcFormatter: formatNumNull,
					},
					{
						minWidth: 64,
						title: 'O',
						field: 'avgHrFactors.monthly.overtime',
						mutator: (value, data, type, params, column) =>
						{
							return aggr(data).avgHrFactors.monthly.overtime
						},
						bottomCalc: botCalcMonthAvg,
						bottomCalcParams: hwColCalc,
						formatter: formatNumNull,
						bottomCalcFormatter: formatNumNull,
					},
					{
						minWidth: 64,
						title: 'S',
						field: 'avgHrFactors.monthly.sunday',
						mutator: (value, data, type, params, column) =>
						{
							// /**legacy behaviour */
							// if (_.isNil(normal_overtime) || _.isNil(normal_overtime_sunday))
							// {
							// 	return null
							// }
							return aggr(data).avgHrFactors.monthly.sunday
						},
						bottomCalc: botCalcMonthAvg,
						bottomCalcParams: hwColCalc,
						formatter: formatNumNull,
						bottomCalcFormatter: formatNumNull,
					},
				],
			}
		]
		return columns
	}

	getBlankRow(seq)
	{
		seq = seq ?? (this.table.getDataCount() || 1);
		return RosterPattern.create(seq);
	}

	#tableBuilt = false;
	callbacks = {
		onChange: $.Callbacks('unique'),
		onValidationFail: $.Callbacks('unique'),
	}

	rosterData = [];
	constructor(data)
	{
		const _this = this;
		this.assemble();

		/**Full screen mode */
		$(this.tableElement.element).appendTo(RosterTabulator.RootContainer);

		const $fteWrapper = _dce('div tabulator-footer');
		this.$footerElement = _dce('div').text('ayy lmao')
		.addClass('border-top border-dark')
		.css({
			'min-height': 24
		})
		.appendTo($fteWrapper);

		const tableColumns = RosterTabulator.generateColumns(this);

		const rData = data ?? _([0, 20]).thru(
			(v) => _.range(...v)
		).map(
			seq => this.getBlankRow(seq + 1)
		).flatten().value();

		this.rosterData = rData;

		const tableOptions = _.assign(
			// {},
			{ data: this.rosterData },
			RosterTabulator.#DefaultTableOptions,
			{ columns: tableColumns },
			{
				footerElement: $fteWrapper[0],
			},
		);


		// this.containers.root
		// 	.attr('id', this.ctn_id)
		// 	.appendTo(
		// 		RosterTabulator.RootContainer
		// 	);
		// const ctnFluid = _dce('div container-fluid').appendTo(
		// 	RosterTabulator.RootContainer
		// ).append(
		// 	this.containers.root
		// )

		this.table = new Tabulator(
			`#${this.table_id}`, tableOptions
		);

		this.table.on('tableBuilt', () =>
		{
			this.onTableBuilt()
		});


	}

	onTableBuilt()
	{
		const _this = this;
		const inits = {clipboard: _this.table.options.clipboard};


		this.controls.elements = {

			autoFill: this.controls.addBtn(
				_dce('button btn btn-primary')
					.text('Auto-fill').on(
						'click', function (e)
					{
						_this.autoFill();
						_this.table.getRows().forEach(r => r.reformat());
					}),

				_dce('button btn btn-danger')
					.text('Clear').toggleClass('bg-danger').on(
						'click', function (e)
					{
						_this.clear();
						_this.table.getRows().forEach(r => r.reformat());
					}),

				_dce('button btn btn-outline-secondary shadow-none').attr({
					'data-bs-toggle': "button",
					'aria-pressed': inits.clipboard
				}).addClass(
					'active', function() {
						return inits.clipboard
					}
				).append(
					_cbi('clipboard2-check-fill')
				).on('click', function(e){

					let val = _this.table.options.clipboard;
					const $this = $(this).toggleClass('active', !!!val);

					_this.table.options.clipboard = !val;
					_this.table.recalc();
				}).button()

			)
		};

		const onShiftPatternChange = (...args) =>
		{
			const firstPattern = this.rosterData[0];
			const columnAverages = this.calcResults.bottom;
			const patternsEqual = Shift.PatternsAreEqual(firstPattern, columnAverages);
			if (patternsEqual === null)
			{
				this.$footerElement.removeClass(
					'text-danger fw-bold'
				).text('')

			} else if (!patternsEqual)
			{
				this.$footerElement.addClass(
					'text-danger fw-bold'
				).text('Shift patterns not equal.')
			} else
			{
				this.$footerElement.removeClass(
					'text-danger fw-bold'
				).text('Shift patterns OK.')
			}
		}
		this.callbacks.onChange.add(onShiftPatternChange);

		const onWeekValidationFail = ({ pattern, day, cPath, reason, }) =>
		{
			// const { seq } = pattern;
			// const { week } = day;

			// const cells = _(this.getDays(seq)).filter(
			// 	c =>
			// 	{
			// 		const v = c.getValue();
			// 		return v instanceof RosterDay && v.week === week
			// 	}
			// )

			// _(cells).forEach(c => {
			// 	$(c.getElement()).addClass(
			// 		'border border-danger bg-danger bg-opacity-50'
			// 	)
			// });
			console.dir({ pattern, day, cPath, reason, })

			this.$footerElement.addClass(
				'text-danger fw-bold'
			).text(reason)

		}
		this.callbacks.onValidationFail.add(onWeekValidationFail);

		this.table.setData(this.rosterData).then(() =>
		{
			this.rosterData.forEach(pattern =>
			{
				const { onChange, onValidationFail } = pattern.callbacks.days;

				onChange.add((...args) => this.callbacks.onChange.fire(...args));
				onValidationFail.add((...args) => this.callbacks.onValidationFail.fire(...args));
			})

			this.#tableBuilt = true;
		});

	}

	get data()
	{
		return this.table.getData()
	}
	get calcResults()
	{
		if (!this.#tableBuilt) return null;
		return this.table.getCalcResults()
	}

	static create(p)
	{
		return new this(p)
	}

	autoFill(nRows = 20)
	{
		// if (this.data.length >= 20) return this;
		// nRows = _.min([20 - this.data.length, nRows])

		const _days = _.flatten(_.range(0, 4).map(i => _.constant([
			8, 8, 8, 8, 8, 0, 0,
		])()));

		let idx = 0;
		while (nRows--)
		{
			this.rosterData[idx++].schedule(_.cloneDeep(_days))
			// this.rosterData.forEach(
			// 	(pattern) => pattern.schedule(_.cloneDeep(_days))
			// );
		}
		this.table.setData(this.rosterData);
		return this
	}
	clear()
	{
		_(this.rosterData).forEach(pattern => pattern.clear());
		this.table.setData(this.rosterData, true)
		this.table.getRows().forEach(r => r.reformat());

	}

	getDays(seq)
	{
		if (_.isArray(seq))
		{
			return seq.map(s => this.getDays(s));
		}

		return this.table
			.getRow(seq).getCells()
			// .map(c => c.getValue())
			.filter(c => c.getValue() instanceof RosterDay);

	}
	getDay(seq, idxDay)
	{
		return this.table.getRow(seq).getCell(`days.day_${idxDay}`)
	}
}