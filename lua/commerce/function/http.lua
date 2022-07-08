function get_commande_list()
    local get_command, err = http.get("http://"..url.."/api/routeur.php?action=list_commande&player="..user.."&mdp="..mdp.."&api_access=1")
    if get_command then
		local get_command = get_command.readAll()
		if get_command ~= "db_error" then
			local val = "<br />"
            local return_val = split(get_command,val)
			local val = "',"
            local return_command = {}
            table.insert(return_command, split(return_val[1],val)) --id
            table.insert(return_command, split(return_val[2],val)) --id_offre
            table.insert(return_command, split(return_val[3],val)) --id_transaction
            table.insert(return_command, split(return_val[4],val)) --nom_commande
            table.insert(return_command, split(return_val[5],val)) --expediteur
            table.insert(return_command, split(return_val[6],val)) --recepteur
            table.insert(return_command, split(return_val[7],val)) --quantite
            table.insert(return_command, split(return_val[8],val)) --somme
            table.insert(return_command, split(return_val[9],val)) --prix_unitaire
            table.insert(return_command, split(return_val[10],val)) --type
            table.insert(return_command, split(return_val[11],val)) --livraison
            table.insert(return_command, split(return_val[12],val)) --suivie
            table.insert(return_command, split(return_val[13],val)) --description
            table.insert(return_command, split(return_val[14],val)) --statuts
            return return_command
        end
    else
        local get_command = "http_error"
	end
    return get_command
end
function modif_statuts_commande(id,new_statuts)
    local get_command, err = http.get("http://"..url.."/api/routeur.php?action=edit_commande_statuts_commerce&player="..user.."&mdp="..mdp.."&id="..id.."&statuts="..new_statuts)
    if get_command then
		local get_command = get_command.readAll()
		if get_command ~= "db_error" then
			local val = "<br />"
            local return_val = split(get_command,val)
            if return_val[1] == message_code_ok then
                return true
            end
            return false
        end
    else
        local get_command = "http_error"
    end
    return get_command
end
function update_offre(id,stock)
    local get_command, err = http.get("http://"..url.."/api/routeur.php?action=edit_commande_statuts_commerce&player="..user.."&mdp="..mdp.."&id="..id.."&nbr_dispo="..stock.."&api_access=1")
    if get_command then
		local get_command = get_command.readAll()
		if get_command ~= "db_error" then
            local val = "<br />"
            local return_val = split(get_command,val)
            if return_val[1] == message_code_ok then
                return true
            end
            return false
        end
    else
        local get_command = "http_error"
    end
    return get_command
end