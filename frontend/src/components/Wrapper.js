import React from 'react';
import Section from './Section';
import WeatherDateTime from './WeatherDateTime';
import Status from './Status';
import Reports from './Reports';
import FoodNotify from './FoodNotify';
import {ApolloClient, ApolloProvider, gql, InMemoryCache, useQuery} from '@apollo/client';
import {Container, Divider, Header, Loader, Icon, Dimmer} from 'semantic-ui-react';

const client = new ApolloClient({
	uri: process.env.REACT_APP_BACKEND_HOST,
	cache: new InMemoryCache(),
});

const GraphQL_query = gql`
{
  weather {
    now {
      name
      temp
      icon
    }
    future {
      name
      temp
      icon
    }
  }
  food {
  	name
  	time
  	message
  }
  payday {
    date
  }
  app {
    name
    status
    report {
      rule
      status
      message
      timestamp
    }
  }
}
`;

function Wrapper() {
	return (
		<div>
			<ApolloProvider client={client}>
				<GetDataFromApi />
			</ApolloProvider>
		</div>
	);
}

function GetDataFromApi() {
	const {loading, error, data} = useQuery(GraphQL_query, {pollInterval: 10000});

	if (loading) {
		return (

			<Dimmer active>
				<Loader>Ładowanie</Loader>
			</Dimmer>
		);
	}

	if (error) {
		return (
			<Dimmer active>
				<Header as="h2" icon inverted>
					<Icon name="frown outline" />
                Wystąpił błąd
					<Header.Subheader>Wiadomość: {error.message}</Header.Subheader>
				</Header>
			</Dimmer>
		);
	}

	return (
		<Container fluid>
			<FoodNotify food={ data.food } />
			<Section>
				<WeatherDateTime weather={ data.weather } date={ data.payday.date } />
			</Section>
			<Divider horizontal>
				<Header as="h4">
					<Icon name="server" />
                    Stan aplikacji
				</Header>
			</Divider>
			<Section>
				<Status apps={ data.app } />
				<Reports apps={ data.app } />
			</Section>
		</Container>
	);
}

export default Wrapper;
