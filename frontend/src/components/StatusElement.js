import React from 'react';
import './StatusElement.css';

function StatusElement({name, logo, status}) {
	return (
		<div className={'element-container'}>
			<img src={logo} alt={name} style={{borderColor: getColorFromStatus(status)}} height={150} width={150}/>
		</div>
	);
}

function getColorFromStatus(status) {
	switch (status) {
		case 0:
			return '#21BA45';
		case 1:
			return '#FBBD08';
		case 2:
			return '#DB2828';
		default:
			return '#000';
	}
}

export default StatusElement;
