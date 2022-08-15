// var _ = require('lodash')

// const aggr = function ()
// {
// 	return {
// 		scheduled: function ()
// 		{
// 			return _(this.data).filter('scheduled').value();
// 		},
// 		count()
// 		{
// 			return this.scheduled().length;
// 		},
// 		inPattern()
// 		{
// 			return this.count() || null
// 		},
// 		sum()
// 		{
// 			return _(this.scheduled()).sumBy('hours');
// 		},
// 		avg()
// 		{
// 			const len = this.count();
// 			if (!len) return 0;
// 			return this.sum / len;
// 		},
// 		max()
// 		{
// 			return _.maxBy(this.scheduled(), 'hours')?.hours ?? null;
// 		},
// 		min()
// 		{
// 			return _.minBy(this.scheduled(), 'hours')?.hours ?? null;
// 		},
// 	}
// }

// function Aggregates(data = [])
// {

// 	return {
// 		data: data,
// 		scheduled: function ()
// 		{
// 			return _(this.data).filter('scheduled').value();
// 		},
// 		count()
// 		{
// 			return this.scheduled().length;
// 		},
// 		inPattern()
// 		{
// 			return this.count() || null
// 		},
// 		sum()
// 		{
// 			return _(this.scheduled()).sumBy('hours');
// 		},
// 		avg()
// 		{
// 			const len = this.count();
// 			if (!len) return 0;
// 			return this.sum / len;
// 		},
// 		max()
// 		{
// 			return _.maxBy(this.scheduled(), 'hours')?.hours ?? null;
// 		},
// 		min()
// 		{
// 			return _.minBy(this.scheduled(), 'hours')?.hours ?? null;
// 		},
// 		averageHourFactors()
// 		{

// 		}
// 	}
// }

// const data = [
// 	{
// 		scheduled: true,
// 		hours: 5,
// 	},
// 	{
// 		scheduled: false,
// 		hours: null,
// 	},
// 	{
// 		scheduled: true,
// 		hours: 12,
// 	},
// 	{
// 		scheduled: false,
// 		hours: 0,
// 	},
// ]


// const proxy = new Proxy(data, {
// 	get(target, prop, receiver)
// 	{
// 		const aggrs = Aggregates(target);
// 		let value = Reflect.get(target, prop, aggrs);
// 		console.log(target)
// 		console.log(prop)
// 		// console.log(receiver)
// 		console.log(value, typeof value)

// 		if (prop in aggrs && typeof value == 'function')
// 		{
// 			if (prop == 'scheduled')
// 			{
// 				return aggrs.bind({ data: target })
// 			} else
// 			{
// 				// return receiver[prop]()
// 			}
// 		}

// 		if (prop in target)
// 		{
// 			return target[prop]
// 		}
// 	},
// 	// apply(target, thisArg, argsList)
// 	// {
// 	// 	console.log(target)
// 	// 	console.log(thisArg)
// 	// 	console.log(argsList)

// 	// }
// });

// console.log(Aggregates(data).scheduled())