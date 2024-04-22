import React, {useEffect, useState} from 'react';
import moment from 'moment';
import Countdown from './Countdown';

function EndWeek({date}) {
	const [now, setNow] = useState(moment());

	useEffect(
		() => {
			const interval = setInterval(() => setNow(moment()), 60000);
			return () => {
				clearInterval(interval);
			};
		}, [],
	);

	const diff = countHoursToWeekend(moment().isoWeekday(), now);

	return (
		<Countdown
			duration={ 40 }
			diff={ diff }
			topMessage={ 'Godzin' }
			bottomMessage={ 'Do weekendu' }
			endMessage={ 'Weekend!' }
		/>
	);
}

function countHoursToWeekend(weekday, now) {
	let hours = 40;

	if (weekday === 6 || weekday === 7) {
		return 0;
	}

	hours -= (weekday - 1) * 8;

	const workStart = moment().startOf('day').add(8, 'hours');

	const diff = now.diff(workStart, 'hours');

	return hours - diff;
}

export default EndWeek;
