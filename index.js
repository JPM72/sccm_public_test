import './js/Model/Roster.js';
import { Parser } from './js/Model/spreadsheet.js';
import { RosterTabulator } from "./js/ui/Tabulators.js";
import './js/ui/templates/BaseComponents.js';

export function init()
{
	const t = RosterTabulator.create();
	window.rt = t;
}

export async function _load()
{
	const data = await fetch('http://127.0.0.1:80/projects/sccm/php/getAppData.php').then(
		r => r.json()
	);
	return data;
}

// console.log(Parser.Model)

