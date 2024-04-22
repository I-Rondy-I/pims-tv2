import React, {useEffect, useState} from 'react';
import moment from 'moment';
import {Header, Icon, Table} from 'semantic-ui-react';

function getMessagesFromApps(apps) {
	const messages = [];
	apps.forEach(app => {
		app.report.forEach(report => {
			if (report.status === false) {
				messages.push({
					app: app.name,
					name: report.rule,
					message: report.message,
					timestamp: report.timestamp,
				});
			}
		});
	});
	return messages;
}

function setBackgroundColor(messages) {
	let name = '';
	let flag = true;
	let color = '';
	const messagesEnd = [];

	messages.forEach(message => {
		if (name !== message.app) {
			name = message.app;
			flag = !flag;

			if (flag) {
				color = '#F9F9F9';
			} else {
				color = '#EEEEEE';
			}
		}

		messagesEnd.push({
			...message,
			backgroundColor: color,
		});
	});

	return messagesEnd;
}

function EmptyMessages({messagesCount}) {
	if (messagesCount === 0) {
		return (
			<Header textAlign={'center'} color={'grey'}>
				<Icon name={'smile outline'}/>
                Brak wiadomości do wyświetlenia
			</Header>
		);
	}

	return null;
}

function Reports({apps}) {
	const [page, setPage] = useState(0);

	let messages = getMessagesFromApps(apps);
	messages = setBackgroundColor(messages);

	useEffect(
		() => {
			const interval = setInterval(() => {
				if (messages.length > 0) {
					setPage(page => page + 1);
				} else {
					setPage(0);
				}
			}, 5000);
			return () => {
				clearInterval(interval);
			};
		}, [messages],
	);

	if (messages.length > 0) {
		if (page + 1 > Math.ceil(messages.length / 10)) {
			setPage(0);
		}
	}

	const limitedMessages = messages.slice(page * 10, page * 10 + 10);

	const rows = limitedMessages.map((row, index) => (
		<Table.Row key={index} style={{backgroundColor: row.backgroundColor}}>
			<Table.Cell collapsing>{row.app}</Table.Cell>
			<Table.Cell>{row.name}</Table.Cell>
			<Table.Cell>{row.message}</Table.Cell>
			<Table.Cell>{moment(row.timestamp * 1000).fromNow()}</Table.Cell>
		</Table.Row>
	));

	return (
		<div>
			<Table celled>
				<Table.Header align="center">
					<Table.Row>
						<Table.HeaderCell colSpan="4"> Informacje o błędach
                            ({page + 1}/{Math.max(Math.ceil(messages.length / 10), 1)})
						</Table.HeaderCell>
					</Table.Row>
				</Table.Header>

				<Table.Body>

					<Table.Row>
						<Table.Cell collapsing style={{fontWeight: 700}}> Aplikacja </Table.Cell>
						<Table.Cell style={{fontWeight: 700}}> Zasada </Table.Cell>
						<Table.Cell style={{fontWeight: 700}}> Wiadomość </Table.Cell>
						<Table.Cell style={{fontWeight: 700, width: '250px'}}> Czas wystąpienia </Table.Cell>
					</Table.Row>

					{rows}

				</Table.Body>
			</Table>
			<EmptyMessages messagesCount={messages.length} />
		</div>
	);
}

export default Reports;
