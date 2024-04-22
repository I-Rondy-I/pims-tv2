# pims-tv2 [Frontend]
## Wstęp
Po stronie frontendu aplikacja:
* Udostępnia bieżącą informację o stanach Aplikacij Działu Internet(TME)
  * W postaci okrągłych krawędzi w podanym kolorze:
 
| Status | Opis                                  | Kolor                                                    | Kod koloru  |
| ------ | ------------------------------------- | -------------------------------------------------------- | ------------|
| -1     | Brak polączenia                       | ![](https://via.placeholder.com/15/000000/000000?text=+) | [#000000]   |
| 0      | Aplikacja dziala w pełni sprawnie     | ![](https://via.placeholder.com/15/21BA45/000000?text=+) | [#21BA45]   |
| 1      | Aplikacja posiada problemy do naprawy | ![](https://via.placeholder.com/15/FBBD08/000000?text=+) | [#FBBD08]   |
| 2      | Aplikacja ma krytyczne problemy       | ![](https://via.placeholder.com/15/DB2828/000000?text=+) | [#DB2828]   |

* Wyświetlanie logów z blędami dla każdej aplikacji
* Informacja o pogodach na bieżąco oraz na fajrant
* Informacja o Dacie i godzinie
* Informowanie o dostawach jedzenia
* Progressbary pokazujące: 
  * Ile zostalo godzin pracy w tym tygodniu
  * Za ile dni będzie dzień wyplaty wynagrodzeń

### Wymagania:
###### - Node JS
>Linux:
>
>```sudo apt update```
>
>```sudo apt install nodejs```

>Windows:
>
>```To be continued...```
___
## Instalacja
#### BitBucket:
```
git clone https://bitbucket-hq.tme.eu/scm/pims/pims-tv2.git
```
___
## Konfiguracja
#### Pobieranie zależności
###### Terminal:
```
npm install
```
___
## Getting Started

#### Uruchamianie
###### Terminal:
```
npm start
```
## Dodanie/Redagowanie danych
### Dodanie nowej Aplikacji
* Do folderu ```public/logo``` wrzucić logo dla aplikacji z jej nazwą(małymi literami) oraz rozszerzeniem ```.svg```
### Dodanie/Zmiana informacji o dostawcach jedzenia
* Do folderu ```public/food_logo``` wrzucić logo dla dostawców z ich nazwą(małymi literami) oraz rozszerzeniem ```.png```
### To be continued...