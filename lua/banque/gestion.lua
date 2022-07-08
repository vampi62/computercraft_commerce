function init()
    apikey = ""
    url = ""
    user = ""

    statuts_attente = "echange accepter paiement en attente"
    statuts_valide = "echange accepter paiement valider"
    statuts_refus = "echange accepter paiement refuser"
    message_code_ok = "0"
    
    0: succes - commande realiser
    1: succes - commande executer mais pas de retour
    2: erreur - privilege insufisant
    3: erreur - login incorrect
    4: erreur - parametre manquant
    5: erreur - utilisateur existant
    6: erreur - pas switch transaction
    10: erreur - limite offre atteint
    11: erreur - edition status incorrect
    12: erreur - offre inactive ou invalide
    13: erreur - pas de fond
    14: erreur - plafond prêt atteint
    15: erreur - pas de stock
    20: erreur -
    21: erreur - le prix est incorrect
    22: erreur - le stock est incorrect



    refresh_time = 15-30
    interval_minute_db = 1-5
    id = {}
    prix = {}
    dispo = {}
    type = {}
    livraison = {}
    offre = {id,prix,dispo,type,livraison}


    stock_dispo[1] = 1000
    stock_resa[1] = 1000
end

if interval_minute_db <= 0 then
    interval_minute_db = 1
end

function main()
	parallel.waitForAny(init, affichage, clavier, ntp, program)
end
run_prog = true
while run_prog do
	local etat, error_mes = pcall(main)
	if not etat then
		local file = fs.open('log', 'a')
		file.writeLine(os.day()..':'..os.time()..' '..error_mes)
		file.close()
        if mise_a_jour then
            run_prog = false
            print("le programme à céssé de fonctionner")
            print("alors qu'une mise à jour à été installer récemment")
            print("verifier qu'il n'y ai pas de conflit avec votre custom")
            print("signaler le probleme si vous n'utiliser pas de custom")
            print("si vous shouhaitait restaurer un backup,")
            print("remplacer tous les fichers par ceux du repertoire :")
            print("backup_update")
            n = read()
        end
    end
	sleep(0.2)
end