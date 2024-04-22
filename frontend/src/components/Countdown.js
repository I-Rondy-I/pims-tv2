import React from 'react';
import {CountdownCircleTimer} from 'react-countdown-circle-timer';
import './Countdown.css';

function Countdown({diff, duration, bottomMessage, topMessage, endMessage}) {
	return (
		<div className="timer-wrapper">
			<CountdownCircleTimer
				onComplete={() => [false, 5000]}
				isPlaying={ false }
				duration={ duration }
				initialRemainingTime={ diff }
				size={ 180 }
				strokeWidth={ 12 }

				colors={[
					['#db2828', 0.33],
					['#fbbd08', 0.33],
					['#21ba45', 0.33],
				]}
			>
				<CircleTimerIsEnd
					isEnd={ diff === 0}
					diff={ diff }
					bottomMessage={ bottomMessage }
					topMessage={ topMessage }
					endMessage={ endMessage } />
			</CountdownCircleTimer>
		</div>
	);
}

function CircleTimerIsEnd({isEnd, diff, bottomMessage, topMessage, endMessage}) {
	if (isEnd) {
		return (
			<div>
				<h1 className="textTimerEnd" style={{fontSize: '1.5em', marginBottom: '-20px'}}> {endMessage} </h1>
				<h1 className="textTimerEnd" style={{fontSize: '1.5em', textAlign: 'center'}}> 😀 </h1>
			</div>
		);
	}

	return (
		<div>
			<h2 style={{fontSize: '1.5em', textAlign: 'center'}} className="textTimerDays">{topMessage}</h2>
			<h2 style={{marginTop: '-20px', marginBottom: '-30px', textAlign: 'center'}} className="textTimerDays">{ diff }</h2>
			<h2 style={{fontSize: '1.3em'}} className="textTimerDays">{bottomMessage}</h2>
		</div>
	);
}

export default Countdown;
