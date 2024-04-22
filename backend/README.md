# pims-tv2 [Backend]
## Wstęp
Po stronie backendu aplikacja:
* Na bieżąco pobiera informację o aplikacjach
  * Dodatkowo zapamiętuje czasy wystąpień zmiany stanów aplikacji
* Pobiera informację o pogodzie korzystając z API
* Na podstawie algorytmu wylicza datę dnia wyplaty wynagrodzenia
* Lączy wszystkie otrzymane dane i udostępnia ich w formie GraphQL do Frontend'u
  
### Wymagania:
###### - PHP [8.0+]
###### - Composer
###### - [OpenWeatherMap](https://openweathermap.org/) (klucz API)
###### - Docker (Zaleca się)
> Linux:
>
> ```sudo apt update```
>
> ```sudo apt install docker.io```

>Windows:
>
>```To be continued...```
---
## Instalacja
#### BitBucket:
```
git clone https://bitbucket-hq.tme.eu/scm/pims/pims-tv2.git
```
---
## Konfiguracja
#### Pobieranie zależności
###### Terminal:
```
composer install --no-dev
```
#### *Docker zbieranie projektu
###### Terminal:
```
docker-compose build
```
---
## Użytkowanie
#### Pierwszy krok:

 Zmiana nazwy
> pims-tv2/backend/ ```.env.dist``` --> pims-tv2/backend/ ```.env```
#### Kolejny krok:
Uzupelnienie parametrów w pliku konfiguracyjnym: [.ENV file](../backend/.env.dist)
###### Opis parametrów API dla pogody
| Parametr                | Typ     | Opis                               | Domyślnie                                       |
| ----------------------- | ------- | ---------------------------------- | ----------------------------------------------- |
| OPENWEATHERMAP_ENDPOINT | string  | Podstawowa część Request'u do API  | https://api.openweathermap.org/data/2.5/onecall |
| OPENWEATHERMAP_APIKEY   | string  | API klucz dla wykonania Request'ów |                                                 |
| OPENWEATHERMAP_LON      | float   | Longtitude                         | 19.4667                                         |
| OPENWEATHERMAP_LAT      | float   | Latitude                           | 51.75                                           |

###### Opis parametrów Aplikacji
| Parametr                | Typ     | Opis                               | Domyślnie     |
| ----------------------- | ------- | ---------------------------------- | ------------- |
| ETL_HOST                | string  | Link dla pobierania danych o ETL   |               |

###### Opis innych parametrów
| Parametr                | Typ     | Opis                                           | Domyślnie      |
| ----------------------- | ------- | ---------------------------------------------- | -------------- |
| WEATHER_FUTURE_TIME     | integer | Godzina, dla której udostępniamy dane pogodowe | 16             |
| FOOD_LIST_FILE          | string  | Ścieżka do pliku z danymi o dostawach jedzenia | food_list.json |

#### Uruchamianie
###### Terminal:
```
php -S [HOST]:[PORT]
```
#### *Docker uruchamianie
###### Terminal:
```
docker-compose up
```

## Dodanie/Redagowanie danych
### Dodanie nowej Aplikacji
* Utworzyć nową klasę o nazwie Aplikacji w folderze "ApiReader", która będzie implementować interfejs [ApiReader](src/ApiReader.php)
* W pliku [index.php](index.php) dodać objekt aplikacji do '$appDataReader' :
```
$appDataReader->addAppObject([objekt utworzonej klasy]);
```
### Dodanie/Zmiana informacji o dostawcach jedzenia
* Redagowanie pliku [food_list.json](food_list.json)
### To be continued...