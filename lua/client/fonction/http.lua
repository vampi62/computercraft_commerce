function http_get_commande_list()
    local get_command, err = http.get("http://"..url.."/api/routeur.php?action=list_commande&player="..user.."&mdp="..mdp.."&api_access=1")
    if get_command then
		local get_command = get_command.readAll()
		if get_command ~= "db_error" then
			local val = "<br />"
            local return_val = split(get_command,val)
			local val = "',"
            
            local id = split(return_val[1],val)
            local id_offre = split(return_val[2],val)
            local id_transaction = split(return_val[3],val)
            local nom_commande = split(return_val[4],val)
            local expediteur = split(return_val[5],val)
            local recepteur = split(return_val[6],val)
            local quantite = split(return_val[7],val)
            local somme = split(return_val[8],val)
            local prix_unitaire = split(return_val[9],val)
            local type = split(return_val[10],val)
            local livraison = split(return_val[11],val)
            local suivie = split(return_val[12],val)
            local description = split(return_val[13],val)
            local statuts = split(return_val[14],val)
            return {id,id_offre,id_transaction,nom_commande,expediteur,recepteur,quantite,somme,prix_unitaire,type,livraison,suivie,description,statuts}
		end
	end
end
function http_creation_transaction(id)
    local crea_transaction, err = http.get("http://"..url.."/api/routeur.php?action=transaction&player="..user.."&mdp="..mdp.."&ref_commande="..id.."&type=commerce&expediteur=na&recepteur=na&somme=na&description=na")
    if crea_transaction then
		local crea_transaction = crea_transaction.readAll()
		if crea_transaction ~= "db_error" then
			local val = "<br />"
            local return_val = split(crea_transaction,val)
            return return_val[1]
        else
            return "db_error"
        end
    end
end
function http_get_ntp(refresh_time)
    local get_ntp, err = http.get("http://"..url.."/api/routeur.php?action=time")
    if get_ntp then
		local get_ntp = get_ntp.readAll()
        local taille = string.len(get_ntp)
        local val = "<br />"
        local t = 1
        local val_posd = {}
        local val_posf = {}
        for j = 1, taille do
            local test = string.sub(get_ntp,c,c+5)
            if string.find(test,val) then
                val_posd[t] = c - 1
                val_posf[t] = c + 6
                t = t + 1
            end
        end

        local Minute = string.sub(get_ntp,1,val_posd[1])
        local Hour = string.sub(get_ntp,val_posf[1],val_posd[2])
        local am_pm = string.sub(get_ntp,val_posf[2],val_posd[3])
        local day = string.sub(get_ntp,val_posf[3],val_posd[4])
        local mois = string.sub(get_ntp,val_posf[4],val_posd[5])

        local Minute = tonumber(Minute)
        local Hour = tonumber(Hour)
        local day = tonumber(day)
        local mois = tonumber(mois)

        if am_pm == "PM" then
            local Hour = Hour + 12
            if Hour > 23 then
                local Hour = 0
            end
        end
        if day <= 9 then
            local day = "0"..day
        end
        if mois <= 9 then
            local mois = "0"..mois
        end
        return {Minute,Hour,day,mois,refresh_time}
    end
end