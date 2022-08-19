function page_panier()
    global_limite_scroll_haut = false
    global_limite_scroll_bas = false
    for j=1, #global_panier do
        local y = global_scroll + j
        if y <= global_max_y_page and y >= global_min_y_page then
            if j == 1 then
                global_limite_scroll_haut = true
            end
            if j == #global_panier and y == global_max_y_page then
                global_limite_scroll_bas = true
            end
            table.insert(global_objet_write,{x = 1, y = y, text = "         |                |        |          |", back_color = 256, text_color = 1})
            table.insert(global_objet_write,{x = 1, y = y, text = global_liste_offres[global_panier["id"][j]]["vendeur"], back_color = 256, text_color = 1}) -- vendeur
            table.insert(global_objet_write,{x = 11, y = y, text = global_liste_offres[global_panier["id"][j]]["nom"], back_color = 256, text_color = 1}) -- nom
            table.insert(global_objet_write,{x = 28, y = y, text = global_liste_offres[global_panier["id"][j]]["prix"], back_color = 256, text_color = 1}) -- prix
            table.insert(global_objet_write,{x = 37, y = y, text = global_liste_offres[global_panier["id"][j]]["dispo"], back_color = 256, text_color = 1}) -- stock
            table.insert(global_objet_write,{x = 49, y = y, text = "+", back_color = 256, text_color = 1})
            table.insert(global_objet_select,{xmin = 48, xmax = 50, ymin = y, ymax = y, name = "edit_panier", value = j, back_color = 256}) -- bouton select
        elseif y > global_max_y_page then
            break
        end
    end
    
    table.insert(global_objet_write,{x = 1, y = 4, text = "vendeur  | nom            |prix    |quantite  |    ", back_color = 256, text_color = 1})
    table.insert(global_objet_write,{x = 42, y = 3, text = "commande", back_color = 256, text_color = 1})
    table.insert(global_objet_select,{xmin = 42, xmax = 49, ymin = 3, ymax = 3, name = "panier_commande", back_color = 256})
    
    table.insert(global_objet_write,{x = 9, y = 4, text = global_value_grille[1], back_color = 256, text_color = 1})
    table.insert(global_objet_select,{xmin = 1, xmax = 9, ymin = 4, ymax = 4, name = "change_value_grille", value = 1, back_color = 256})
    table.insert(global_objet_write,{x = 26, y = 4, text = global_value_grille[2], back_color = 256, text_color = 1})
    table.insert(global_objet_select,{xmin = 11, xmax = 26, ymin = 4, ymax = 4, name = "change_value_grille", value = 2, back_color = 256})
    table.insert(global_objet_write,{x = 35, y = 4, text = global_value_grille[3], back_color = 256, text_color = 1})
    table.insert(global_objet_select,{xmin = 28, xmax = 35, ymin = 4, ymax = 4, name = "change_value_grille", value = 3, back_color = 256})
    table.insert(global_objet_write,{x = 46, y = 4, text = global_value_grille[4], back_color = 256, text_color = 1})
    table.insert(global_objet_select,{xmin = 37, xmax = 46, ymin = 4, ymax = 4, name = "change_value_grille", value = 4, back_color = 256})
end