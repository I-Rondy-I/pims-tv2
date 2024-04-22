import React from 'react';
import StatusElement from './StatusElement';
import {Grid, GridColumn} from 'semantic-ui-react';

function Status({apps}) {
	const elements = apps.map((app, index) => (
		<GridColumn key={ index }>
			<StatusElement name={ app.name } logo={'./logo/' + app.name.toLowerCase() + '.svg'} status={ app.status } />
		</GridColumn>
	));
	return (
		<div>
			<Grid columns="equal">
				{ elements }
			</Grid>
		</div>
	);
}

export default Status;
