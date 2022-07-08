function program()
    local list_command = http_get_commande_list()
    for j = 1, #list_command[1] do
        if list_command[14][j] == statuts_attente then
            local return_val = http_creation_transaction(list_command[1][j])
            printlog(list_command[1][j],return_val)
        end
    end
    sleep(interval_minute_db*60)
end