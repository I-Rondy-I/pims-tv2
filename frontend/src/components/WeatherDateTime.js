import React from 'react';
import Weather from './Weather';
import DateTime from './DateTime';
import {Grid, GridColumn} from 'semantic-ui-react';
import Payday from './Payday';
import EndWeek from './EndWeek';

const WeatherDateTime = ({weather, date}) => (

	<div>
		<Grid columns="equal">
			<GridColumn>
				<Weather name={ weather.now.name } temp={ weather.now.temp } icon={ weather.now.icon } />
			</GridColumn>
			<GridColumn>
				<Payday date={date}/>
			</GridColumn>
			<GridColumn width={5}>
				<DateTime />
			</GridColumn>
			<GridColumn >
				<EndWeek />
			</GridColumn>
			<GridColumn >
				<Weather name={ weather.future.name } temp={ weather.future.temp } icon={ weather.future.icon } />
			</GridColumn>
		</Grid>
	</div>

);

export default WeatherDateTime;
