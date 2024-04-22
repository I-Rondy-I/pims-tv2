import React, {useEffect, useState} from 'react';
import {Header, Image, Modal} from 'semantic-ui-react';
import moment from 'moment';

function getActualFood(food) {
	let foodElement = null;

	food.forEach(element => {
		if (
			moment() >= moment(element.time, 'HH:mm').subtract(3, 'minutes')
            && moment() <= moment(element.time, 'HH:mm').add(2, 'minutes')
		) {
			foodElement = element;
		}
	});

	return foodElement;
}

function FoodNotify({food}) {
	const [foodElement, setFoodElement] = useState(null);

	useEffect(
		() => {
			const interval = setInterval(() => {
				setFoodElement(getActualFood(food));
			}, 2000);
			return () => {
				clearInterval(interval);
			};
		}, [food],
	);

	if (foodElement) {
		return <FoodNotifyModal name={foodElement.name} message={foodElement.message}/>;
	}

	return null;
}

function FoodNotifyModal({name, message}) {
	const [open, setOpen] = useState(true);

	useEffect(
		() => {
			const interval = setInterval(() => {
				setOpen(open => !open);
			}, 7000);
			return () => {
				clearInterval(interval);
			};
		}, [],
	);

	return (
		<Modal size="tiny" open={open} centered={false} >
			<Modal.Content>
				<Image src={'food_logo/' + name.toLowerCase() + '.png'} size="small" floated="left" />
				<Header textAlign={'center'} as={'h1'}>{name}</Header>
				<Header textAlign={'center'} as={'h3'}>{message}</Header>
			</Modal.Content>
		</Modal>
	);
}

export default FoodNotify;
