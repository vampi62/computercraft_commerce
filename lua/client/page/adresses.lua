function page_adresses()
    global_limite_scroll_haut = false
    global_limite_scroll_bas = false
    for j=1, #global_liste_adresses do
        local y = global_scroll + j
        if y <= global_max_y_page and y >= global_min_y_page then
            if j == 1 then
                global_limite_scroll_haut = true
            end
            if j == #global_liste_adresses and y == global_max_y_page then
                global_limite_scroll_bas = true
            end
            table.insert(global_objet_write,{x = 1, y = y, text = "                    |      |            |     |", back_color = 256, text_color = 1})
            table.insert(global_objet_write,{x = 1, y = y, text = global_liste_adresses[j]["nom"], back_color = 256, text_color = 1})
            table.insert(global_objet_write,{x = 21, y = y, text = global_liste_adresses[j]["type"], back_color = 256, text_color = 1})
            table.insert(global_objet_write,{x = 29, y = y, text = global_liste_adresses[j]["coo"], back_color = 256, text_color = 1})
            table.insert(global_objet_write,{x = 42, y = y, text = global_liste_adresses[j]["use"], back_color = 256, text_color = 1})
            table.insert(global_objet_write,{x = 49, y = y, text = "+", back_color = 256, text_color = 1})
            table.insert(global_objet_select,{xmin = 48, xmax = 50, ymin = y, ymax = y, name = "adresse", value = j, back_color = 256}) -- bouton select
        elseif y > global_max_y_page then
            break
        end
    end
    table.insert(global_objet_write,{x = 42, y = 3, text = "new addr", back_color = 256, text_color = 1})
    table.insert(global_objet_select,{xmin = 42, xmax = 49, ymin = 3, ymax = 3, name = "new_addr", back_color = 256})
    table.insert(global_objet_write,{x = 1, y = 4, text = " nom                |type  | coo        |use  |    ", back_color = 256, text_color = 1})

    table.insert(global_objet_write,{x = 20, y = 4, text = global_value_grille[1], back_color = 256, text_color = 1})
    table.insert(global_objet_select,{xmin = 1, xmax = 20, ymin = 4, ymax = 4, name = "change_value_grille", value = 1, back_color = 256})
    table.insert(global_objet_write,{x = 27, y = 4, text = global_value_grille[2], back_color = 256, text_color = 1})
    table.insert(global_objet_select,{xmin = 22, xmax = 27, ymin = 4, ymax = 4, name = "change_value_grille", value = 2, back_color = 256})
    table.insert(global_objet_write,{x = 40, y = 4, text = global_value_grille[3], back_color = 256, text_color = 1})
    table.insert(global_objet_select,{xmin = 29, xmax = 40, ymin = 4, ymax = 4, name = "change_value_grille", value = 3, back_color = 256})
    table.insert(global_objet_write,{x = 46, y = 4, text = global_value_grille[4], back_color = 256, text_color = 1})
    table.insert(global_objet_select,{xmin = 42, xmax = 46, ymin = 4, ymax = 4, name = "change_value_grille", value = 4, back_color = 256})
end