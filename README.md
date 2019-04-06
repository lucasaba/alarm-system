# AlarmSystem - Refactoring legacy code

Un esercizio per vedere come riscrivere codice legacy senza "rompere" la compatibilità
e applicando dei buoni principi di programmazione.

Il codice è una rilettura del TripServiceKata di 
[Sandro Mancuso](https://github.com/sandromancuso/trip-service-kata) nella
versione php di [Andrea Francia](https://github.com/andreafrancia/trip-service-kata)

## AlarmSystem

Il programma antifurto che ci dobbiamo apprestare a modificare gestisce una serie
di zone e di eventi.

Per evitare i falsi positivi, il nostro impianto antifurto non emette allarme a
meno che non ci siano già stati eventi nelle zone collegate a quella in cui è stato
scatenato l'evento. 

Il servizio che dobbiamo correggere è proprio quello che viene interrogato per
sapere se esistono zone collegate in cui sono scattati eventi.


## Riferimenti

https://www.youtube.com/watch?v=_NnElPO5BU0

https://www.youtube.com/watch?v=92Vn9WeaiLA