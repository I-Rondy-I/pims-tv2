import React from 'react';
import {Card, Icon, Image} from 'semantic-ui-react';

const WeatherOk = ({name, temp, icon}) => (
	<Card>
		<Card.Content textAlign={'center'}>
			<Card.Header >{name}</Card.Header>
			<Image src={icon} wrapped ui={false} />
			<Card.Description>
				<h1>{ temp.toPrecision(3) } °C</h1>
			</Card.Description>
		</Card.Content>
	</Card>
);

const WeatherNull = () => (
	<Card>
		<Card.Content textAlign={'center'}>
			<Card.Header >Błąd pobierania pogody</Card.Header>
			<Card.Description>
				<Icon.Group size="huge">
					<Icon loading size="large" name="circle notch" />
					<Icon size="mini" name="cloud" />
				</Icon.Group>
			</Card.Description>
		</Card.Content>
	</Card>
);

function Weather({name, temp, icon}) {
	if (name != null) {
		return <WeatherOk name={name} temp={temp} icon={icon} />;
	}

	return <WeatherNull />;
}

export default Weather;
