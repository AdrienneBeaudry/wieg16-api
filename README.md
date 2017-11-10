# Övningar för Lektion 3: API:er
## Övning 1
Nu är det dags att börja exponera den data som du hämtat hem i lektion 2 övning 3.
Gör en fil som heter customers.php som skriver ut all data från tabellen i json-format på skärmen.
Skicka lämplig header för att visa att det är json-data du skickar och inte vanlig html.
## Övning 2
Bygg vidare så att man kan hämta ut en kund i taget.
Genom att ange en GET-parameter (förslagsvis customer_id) så skall man kunna få ut en enskild kund.
Exempel på url: http://wieg16-api.dev/customers.php?customer_id=1
Denna url skall då visa mig kunden med id 1 i json-format.
## Övning 3
Det kan vara så att man skriver ett customer_id som inte finns.
Skriv kod som hanterar att du inte får någon träff i databasen.
En http statuskod på 404 måste skickas och ett lämpligt meddelande i json skall skrivas ut.
Exempel {"message": "Customer not found"}
## Övning 4
Skriv kod för att enbart visa kundens adress.
Exempel på url: http://wieg16-api.dev/customers.php?customer_id=1&address=true
Då skall adressen för kunden med id 1 skrivas ut på skärmen i json-format.
## Övning 5
Datan som du hämtat hem tidigare är lite dåligt strukturerad. Det har visat sig att vi har behov av att veta vilka kunder som tillhör samma företag.
Skapa en separat tabell för företagen (förslagsvis companies) och koppla ihop den tabellen med din customers-tabell.
Skriv sedan kod som går igenom datan och plockar ut företagsnamnen.
Företagsnamnen lagras sedan i den nya separata tabellen och kunder med detta företagsnamn skall få samma company_id.
## Övning 6
Utöka din customers.php så att man kan hämta kunder baserat på company_id.
Om company_id anges så skall alla kunder med detta id visas.
Exempel på url: http://wieg16-api.dev/customers.php?company_id=1
Denna url skall då visa mig alla kunder med company_id 1 i json-format.