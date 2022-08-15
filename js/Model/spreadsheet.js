// var _ = require('lodash');
// var formula = require('excel-formula');

const aliases = {
	columns_daysInPattern_ntAvgHourFactor: 'D4:E23',
	row: {
		days: 'F4:AM4',
		week: {
			'1': {
				sunday: 'L4'
			},
			'2': {
				sunday: 'S4'
			},
			'3': {
				sunday: 'Z4'
			},
			'4': {
				sunday: 'AG4'
			},
		}
	},
	daysInPattern: {
		value: 'D4',
		column: 'D4:D23',
		count: 'D24',
		average: 'C24'
	},
	ntAvgHourFactor: {
		value: 'E4',
		column: 'E4:E23',
		average: 'E24',
	},
	// line: {
	// 	daysInPattern: {
	// 		value: 'D4',
	// 		column: 'D4:D23',
	// 		count: 'D24',
	// 		average: 'C24'
	// 	},
	// },
	weeklyHours: {
		NtOt: {
			value: 'AN4',
			column: 'AN4:AN23',
			average: 'AN24'
		},
		NtOtSt: {
			value: 'AO4',
			column: 'AO4:AO23',
			average: 'AO24'
		},
	},
	monthlyHours: {
		Nt: {
			sum: 'AQ4'
		},
		Ot: {
			sum: 'AR4'
		},
		St: {
			sum: 'AS4'
		},
	},
	allWorkPatternsEqual: 'G24',
	dayShiftLine: 'F4:AG23',
	_TRUE_: 'TRUE()',
	_FALSE_: 'FALSE()',
};
export class Parser
{
	static Constants = [
		[/\" \"/g, '_BLANK']
		, [/\"\"/g, '_EMPTY_STR']
		, [/\"PATTERN TOO LONG\!\"/g, 'pattern_invalid_too_long']
		, [/\"PATTERN TOO SHORT\!\"/g, 'pattern_invalid_too_short']
		, [/\"DAYS OFF\?\"/g, 'pattern_invalid_no_days_off']
		, [
			/\"ALL WORK PATTERNS ARE NOT THE SAME\!\! COST NOT CALCULATED\"/g,
			'allWorkPatterns_invalid_notEqual'
		]
	];
	static Formulas = {};
	static Model = {};
	static KeyMap = {};

	static Replacers = [];
	static SortReplacers()
	{
		Parser.Replacers.push(...Parser.Constants);
		Parser.Replacers.sort((a_, b_) =>
		{
			let [a, b] = [a_[0], b_[0]];

			const lenDif = b.length - a.length;
			if (lenDif === 0)
			{
				a = a.toLowerCase();
				b = b.toLowerCase();
				return ((a < b) ? -1 : ((a > b) ? 1 : 0));
			}

			return lenDif
		})
	}

	static add(value, key, keyPath = [])
	{
		if (_.isObject(value))
		{
			_(value).forEach((v, k) => Parser.add(v, k, [...keyPath, key]));
		} else if (_.isString(value))
		{
			_.set(Parser.KeyMap, value, _.join([...keyPath, key], '.'))
		}
	}

	static ParseObj(obj, key)
	{
		_(obj).forEach((v, k) => Parser.add(v, k));
		this.Model[key] = obj;
	}

	static ParseFormula(formulaStr)
	{
		let s = formulaStr;
		Parser.Replacers.forEach(r =>
		{
			s = s.replaceAll(...r)
		});
		return s
	}
	static addFormula(key_Path, str)
	{
		const parsedFormula = Parser.ParseFormula(str);
		_.set(
			Parser.Formulas, key_Path,
			parsedFormula
		);
		const ccss = 'color:orange; font-weight: bold;'

		console.log(`%ckey_Path:`, 'color:green; font-weight: bold;')
		console.log(`%c${key_Path}:`, 'color:lightgreen; font-weight: bold;')

		// console.log(`%cRaw formula string:`, ccss)
		// console.log(str)

		// console.log('%cFormula', ccss)
		// console.log(parsedFormula)

		console.log(Parser.Format(parsedFormula))
		console.log('\n')
	}

	static Format(str)
	{
		let formatted;
		try
		{
			formatted = excelFormulaUtilities.formatFormula(str);
		} catch (error)
		{
			// formatted = '<Error formatting formula>';
			formatted = str;
		}
		return formatted
	}

	constructor({
		key,
		expr,
		reviver
	})
	{

	}
}
Parser.ParseObj(aliases, 'DS');
Parser.Replacers = _.toPairs(Parser.KeyMap);
Parser.SortReplacers();

// const formulas = [
// 	[
// 		'DS.daysInPattern',
// 		'=IF(SUM(F4:AM4)=0," ",COUNT(F4:AM4))'
// 	],
// 	[
// 		'DS.ntAvgHourFactor.value',
// 		'=IF(COUNT(F4:AM4)=0," ", IF(COUNT(F4:AM4)<7,"PATTERN TOO SHORT!",IF(COUNT(F4:AM4)>28,"PATTERN TOO LONG!",IF(MIN(F4:AM4)>0,"DAYS OFF?",IF(AN4>45,45,AN4)))))'
// 	],
// 	[
// 		'DS.weeklyHours.NtOt.average',
// 		'=IF(COUNT(F4:AM4)=0," ",IF(OR(D4=7,D4=14,D4=21,D4=28),SUM(SUM(F4:AM4)-L4-S4-Z4-AG4)/D4*7,SUM(F4:AM4)/COUNT(F4:AM4)*6))'
// 	],
// 	[
// 		'DS.weeklyHours.NtOtSt.average',
// 		// '=IF((SUM(F4:AM4))>0,SUM((SUM(F4:AM4))/COUNTA(F4:AM4)*7),"")'
// 		'=IF(SUM(F4:AM4)>0,SUM(SUM(F4:AM4)/COUNTA(F4:AM4)*7),"")'
// 	],
// 	[
// 		'DS.allWorkPatternsEqual',
// 		'=IF(F24=" "," ","ALL WORK PATTERNS ARE NOT THE SAME!! COST NOT CALCULATED")'
// 	],
// 	[
// 		'DS.monthlyHours.Nt.sum',
// 		'=IF(AN4=" ","",SUM(E4*4.33))'
// 	],
// 	[
// 		'DS.monthlyHours.Ot.sum',
// 		'=IF(AN4=" ","",SUM(AN4-E4)*4.33)'
// 	],
// 	[
// 		'DS.monthlyHours.St.sum',
// 		'=IF(AN4=" ","",SUM(AO4-AN4)*4.33)'
// 	],
// 	// [
// 	// 	'xxx',
// 	// 	'xxx'
// 	// ],
// ]
// window.fexpr = () => {
// 	formulas.forEach(([keyPath, str]) => Parser.addFormula(keyPath, str));
// }