import React from 'react';
import moment from 'moment';
import Countdown from './Countdown';

function Payday({date}) {
	const diffDates = moment(date).startOf('day').diff(moment().startOf('day'), 'days');

	return (
		<Countdown
			duration={ moment(date).daysInMonth() }
			diff={ diffDates }
			topMessage={ 'Dni' }
			bottomMessage={ 'Do wypłaty' }
			endMessage={ 'Dzień wypłaty' }
		/>
	);
}

export default Payday;
