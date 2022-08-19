function page_mise_a_jour()
    table.insert(global_objet_write,{x = 20, y = 5, text = "mise a jour", back_color = 32768, text_color = 1})

    table.insert(global_objet_write,{x = 4, y = 6, text = "systeme   installer   nouvelle   maj", back_color = 32768, text_color = 1})
    table.insert(global_objet_write,{x = 2, y = 7, text = global_systeme_nom, back_color = 32768, text_color = 1})
    table.insert(global_objet_write,{x = 15, y = 7, text = global_systeme_version, back_color = 32768, text_color = 1})
    table.insert(global_objet_write,{x = 27, y = 7, text = global_systeme_new_version, back_color = 32768, text_color = 1})

    if global_systeme_version ~= global_systeme_new_version then
        table.insert(global_objet_write,{x = 38, y = 7, text = "X", back_color = 256, text_color = 1})
        table.insert(global_objet_select,{xmin = 37, xmax = 39, ymin = 7, ymax = 7, name = "mise_a_jour", back_color = 256})
    else
        table.insert(global_objet_write,{x = 38, y = 7, text = "-", back_color = 256, text_color = 1})
    end
end