import React, {useEffect, useState} from 'react';
import moment from 'moment';
import 'moment/locale/pl';

function DateTime() {
	moment.locale('pl');

	const [value, setValue] = useState(new moment());

	useEffect(
		() => {
			const interval = setInterval(() => setValue(new moment()), 1000);
			return () => {
				clearInterval(interval);
			};
		}, [],
	);

	return (
		<div>
			<h2 style={{textAlign: 'center'}}>
				{value.format('dddd, DD.MM.YYYYr.')}
			</h2>
			<h1 style={{textAlign: 'center', fontSize: '7em'}}>
				{value.format('HH:mm:ss')}
			</h1>
		</div>
	);
}

export default DateTime;
