function prod()
    






    sleep(interval_minute_prod*60)
end
function db_sync()
    local return_bool = false

    list_command = get_commande_list()
    if type(list_command) == "table" then
        for j = 1, #list_command[1] do
            if list_command[14][j] == recherche_statuts_attente then
                for i = 1, #offre[1] do
                    if list_command[1][j] == #offre[1][i] then
                        if stock_dispo[i]-stock_resa[i]-list_command[7][j] > 0 then
                            stock_resa[i] = stock_resa[i] + list_command[7][j]
                            return_bool = modif_statuts_commande(list_command[1][j],change_statuts_accepter)
                        else
                            return_bool = modif_statuts_commande(list_command[1][j],change_statuts_refus)
                        end
                        if return_bool then
                            printlog(list_command[1][j],msg_change_statuts_ok)
                        else
                            printlog(list_command[1][j],msg_change_statuts_nok)
                        end
                    end
                end
            end
        end
        for i = 1, #offre[1] do
            update_offre(offre[1][i],stock_dispo[i]-stock_resa[i])
        end
    else
        printlog(0,list_command)
    end
    sleep(interval_minute_db*60)
end
function traitement()
    local return_bool = false
    if type(list_command) == "table" then
        for j = 1, #list_command[1] do
            if list_command[14][j] == recherche_statuts_paie then
                for i = 1, #id do
                    if list_command[1][j] == #id[i] then
                        traitement_commande(j)
                        return_bool = modif_statuts_commande(list_command[1][j],change_statuts_pret)
                        if return_bool then
                            printlog(list_command[1][j],msg_change_statuts_ok)
                        else
                            printlog(list_command[1][j],msg_change_statuts_nok)
                        end
                    end
                end
            end
        end
    else
        printlog(0,list_command)
    end
    sleep(60)
end