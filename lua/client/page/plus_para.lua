function page_plus_para(type_page)
    if type_page == "offre" then
        local text1 = {
            "vendeur     :",
            "nom         :",
            "prix        :",
            "stock       :",
            "type        :",
            "livraison   :",
            "adresse     :",
            "description :"
        }
        local text2 = {
            global_plus_para["nom"],
            global_plus_para["utilisateur"],
            global_plus_para["type"],
            global_plus_para["livraison"],
            global_plus_para["prix"],
            global_plus_para["quantite"]
        }
        local coo_y = {
            6,
            8,
            10,
            12,
            14,
            16,
            18
        }
    elseif type_page == "adresse" then
        local text1 = {
            "nom         :",
            "type        :",
            "coo         :",
            "description :"
        }
        local text2 = {
            global_plus_para["nom"],
            global_plus_para["type"],
            global_plus_para["coo"],
            global_plus_para["description"]
        }
        local coo_y = {
            6,
            8,
            10,
            12
        }
    elseif type_page == "transaction" then
        local text1 = {
            "commande    :",
            "terminal    :",
            "crediteur   :",
            "debiteur    :",
            "somme       :",
            "type        :",
            "statut      :",
            "description :",
            "date        :"
        }
        local text2 = {
            global_plus_para["commande"],
            global_plus_para["admin"],
            global_plus_para["crediteur"],
            global_plus_para["debiteur"],
            global_plus_para["somme"],
            global_plus_para["type"],
            global_plus_para["statut"],
            global_plus_para["description"],
            global_plus_para["date"]
        }
        local coo_y = {
            6,
            8,
            10,
            12,
            14,
            16,
            18,
            20,
            22
        }
    elseif type_page == "commande" then
        local text1 = {
            "transaction :",
            "nom         :",
            "expediteur  :",
            "adresse exp :",
            "adresse des :",
            "prix        :",
            "quantite    :",
            "somme       :",
            "type        :",
            "livraison   :",
            "suivie      :",
            "statut      :",
            "date        :",
            "description :"
        }
        local text2 = {
            global_plus_para["transaction"],
            global_plus_para["nom"],
            global_plus_para["utilisateur"],
            global_plus_para["adresse_expediteur"],
            global_plus_para["adresse_destinataire"],
            global_plus_para["prix"],
            global_plus_para["quantite"],
            global_plus_para["somme"],
            global_plus_para["type"],
            global_plus_para["livraison"],
            global_plus_para["suivie"],
            global_plus_para["statut"],
            global_plus_para["date"],
            global_plus_para["description"]
        }
        local coo_y = {
            6,
            8,
            10,
            12,
            14,
            16,
            18,
            20,
            22,
            24,
            26,
            28,
            30,
            32,
            34,
            36
        }
    end
    local offset_text_long = 0

    global_limite_scroll_haut = false
    global_limite_scroll_bas = false
    for j=1, #text1 do
        local y = global_scroll + coo_y[j] + offset_text_long
        if y <= global_max_y_page and y >= global_min_y_page then
            if j == 1 then
                global_limite_scroll_haut = true
            end
            if j == #text1 and y == global_max_y_page then
                global_limite_scroll_bas = true
            end

            table.insert(global_objet_write,{x = 2, y = y, text = text1[j], back_color = 256, text_color = 1}) -- text
            if type(text2[j]) == "table" then
                for i=1, #text2[j] do
                    offset_text_long = offset_text_long + 1
                    if y + i <= global_max_y_page and y >= global_min_y_page then
                        table.insert(global_objet_write,{x = 7, y = y + i, text = text2[j][i], back_color = 256, text_color = 1}) -- valeur de la variable
                    elseif y + i > global_max_y_page then
                        global_limite_scroll_bas = false
                        break
                    end
                end
            else
                table.insert(global_objet_write,{x = 15, y = y, text = text2[j], back_color = 256, text_color = 1}) -- valeur de la variable
            end
        elseif y > global_max_y_page then
            break
        end
    end
    
    table.insert(global_objet_write,{x = 38, y = 1, text = "filtres " .. type_page, back_color = 256, text_color = 1})
    table.insert(global_objet_write,{x = 38, y = 1, text = "valider les filtres", back_color = 256, text_color = 1})
    table.insert(global_objet_select,{xmin = 2, xmax = 50, ymin = 17, ymax = 17, name = "valide_filtre", back_color = 256})

end