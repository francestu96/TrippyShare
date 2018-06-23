Esercizio:

- Per setup DB:
    ./db/setup_db.php
- Per homepage
    ./index.php
- Per clean_db
    ./db/clean_db.php

Utente di default: mario@rossi.it, password: rowling
Se un utente è loggato apparirà il nome dell'utente in alto a destra. Per effettuare il logout cliccare sul nome.


Bonus: 
- Sappiamo che non sarebbe corretto mostrare all'utente che una mail è già presente, ma questo è un progetto didattico, e abbiamo inserito questa "feature"
per dimostrare che siamo in grado di fare richieste Ajax. 
- Abbiamo utilizzato i require("common/footer.php"); per riciclare il codice. Vedi qui: http://php.net/manual/en/function.require.php
- Molti tra i file nella cartella assets sono per il template del nostro sito, utili per la parte grafica e non per questa esercitazione.
