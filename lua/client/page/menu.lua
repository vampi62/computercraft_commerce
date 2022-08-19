function page_menu()
    table.insert(global_objet_write,{x = 12, y = 5, text = "login", back_color = 256, text_color = 1})
    table.insert(global_objet_write,{x = 12, y = 7, text = "offres", back_color = 256, text_color = 1})
    table.insert(global_objet_write,{x = 30, y = 7, text = "mes offres", back_color = 256, text_color = 1})
    table.insert(global_objet_write,{x = 12, y = 9, text = "commandes", back_color = 256, text_color = 1})
    table.insert(global_objet_write,{x = 12, y = 11, text = "transaction", back_color = 256, text_color = 1})

    table.insert(global_objet_select,{xmin = 12, xmax = 22, ymin = 5, ymax = 5, name = "page_login", back_color = 256})
    table.insert(global_objet_select,{xmin = 12, xmax = 22, ymin = 7, ymax = 7, name = "page_offres", back_color = 256})
    table.insert(global_objet_select,{xmin = 30, xmax = 41, ymin = 7, ymax = 7, name = "page_mes_offres", back_color = 256})
    table.insert(global_objet_select,{xmin = 12, xmax = 22, ymin = 9, ymax = 9, name = "page_commandes", back_color = 256})
    table.insert(global_objet_select,{xmin = 12, xmax = 22, ymin = 11, ymax = 11, name = "page_transactions", back_color = 256})

    if global_session["role"] == "10" then
        table.insert(global_objet_write,{x = 12, y = 15, text = "admin", back_color = 256, text_color = 1})
        table.insert(global_objet_select,{xmin = 12, xmax = 22, ymin = 15, ymax = 15, name = "page_admin", back_color = 256})
    end
end