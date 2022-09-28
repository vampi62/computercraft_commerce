function page_session_inscription()
    table.insert(global_term_objet_write,{x = 21, y = 5, text = "inscription", back_color = 32768, text_color = 1})
    table.insert(global_term_objet_write,{x = 6, y = 7, text = "pseudo      :", back_color = 32768, text_color = 1})
    table.insert(global_term_objet_write,{x = 6, y = 9, text = "mdp         :", back_color = 32768, text_color = 1})
    table.insert(global_term_objet_write,{x = 6, y = 11, text = "confirm     :", back_color = 32768, text_color = 1})
    table.insert(global_term_objet_write,{x = 6, y = 13, text = "email       :", back_color = 32768, text_color = 1})
    table.insert(global_term_objet_write,{x = 23, y = 15, text = "envoyer", back_color = 128, text_color = 1})

    table.insert(global_term_objet_write,{x = 19, y = 7, text = global_variable["pseudo"], back_color = 128 + change_color_champ_select("pseudo"), text_color = 1})
    table.insert(global_term_objet_write,{x = 19, y = 9, text = global_variable["mdp_len"], back_color = 128 + change_color_champ_select("mdp"), text_color = 1})
    table.insert(global_term_objet_write,{x = 19, y = 11, text = global_variable["confirm_len"], back_color = 128 + change_color_champ_select("confirm"), text_color = 1})
    table.insert(global_term_objet_write,{x = 19, y = 13, text = global_variable["email"], back_color = 128 + change_color_champ_select("email"), text_color = 1})
    table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 7, ymax = 7, parametre={action="variable",nom="pseudo",type="text"}, back_color = 128 + change_color_champ_select("pseudo")})
    table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 9, ymax = 9, parametre={action="variable",nom="mdp",type="code"}, back_color = 128 + change_color_champ_select("mdp")})
    table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 11, ymax = 11, parametre={action="variable",nom="confirm",type="code"}, back_color = 128 + change_color_champ_select("confirm")})
    table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 13, ymax = 13, parametre={action="variable",nom="email",type="text"}, back_color = 128 + change_color_champ_select("email")})

    table.insert(global_term_objet_select,{xmin = 23, xmax = 29, ymin = 15, ymax = 15, parametre={action="action",id="inscription"}, back_color = 128})
end