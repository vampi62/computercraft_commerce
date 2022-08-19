function page_nav()
    table.insert(global_objet_write,{x = 1, y = 1, text = "pseudo", back_color = 32768, text_color = 1})
    table.insert(global_objet_write,{x = 15, y = 1, text = "role", back_color = 32768, text_color = 1})
    table.insert(global_objet_write,{x = 23, y = 1, text = "compte", back_color = 32768, text_color = 1})
    table.insert(global_objet_write,{x = 38, y = 1, text = "adresse", back_color = 256, text_color = 1})

    table.insert(global_objet_write,{x = 1, y = 2, text = global_session["pseudo"], back_color = 32768, text_color = 1})
    table.insert(global_objet_write,{x = 14, y = 2, text = global_config["role"][global_session["role"]], back_color = 32768, text_color = 1})
    table.insert(global_objet_write,{x = 23, y = 2, text = global_session["compte"], back_color = 32768, text_color = 1})
    table.insert(global_objet_write,{x = 38, y = 2, text = global_session["adresse"], back_color = 256, text_color = 1})

    table.insert(global_objet_write,{x = 1, y = 19, text = "config poste", back_color = 256, text_color = 1})
    table.insert(global_objet_write,{x = 37, y = 19, text = ":      /  /", back_color = 32768, text_color = 1})

    table.insert(global_objet_write,{x = 35, y = 19, text = global_time["hour"], back_color = 32768, text_color = 1})
    table.insert(global_objet_write,{x = 38, y = 19, text = global_time["min"], back_color = 32768, text_color = 1})
    table.insert(global_objet_write,{x = 42, y = 19, text = global_time["day"], back_color = 32768, text_color = 1})
    table.insert(global_objet_write,{x = 45, y = 19, text = global_time["month"], back_color = 32768, text_color = 1})
    table.insert(global_objet_write,{x = 48, y = 19, text = global_time["year"], back_color = 32768, text_color = 1})
    
    if global_page == "menu" then
        table.insert(global_objet_select,{xmin = 1, xmax = 12, ymin = 19, ymax = 19, name = "page_config_config", back_color = 256})
    elseif global_page == "menu_admin" or global_page == "mise_a_jour" or global_page == "info" then
        table.insert(global_objet_select,{xmin = 1, xmax = 12, ymin = 19, ymax = 19, name = "page_config_config", back_color = 256})
    else
        table.insert(global_objet_select,{xmin = 1, xmax = 12, ymin = 19, ymax = 19, name = "page_menu", back_color = 256})
    end

    table.insert(global_objet_select,{xmin = 38, xmax = 51, ymin = 1, ymax = 2, name = "page_adresse", back_color = 256})

    if global_message_http ~= -1 then
        table.insert(global_objet_write,{x = 3, y = 17, text = global_message_http, back_color = 256, text_color = 1})
        table.insert(global_objet_select,{xmin = 2, xmax = 50, ymin = 17, ymax = 17, name = "page_message_http", back_color = 256})
    end
end