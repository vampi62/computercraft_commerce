function page_session_code_mail()
    table.insert(global_term_objet_write,{x = 15, y = 5, text = "code reinit mot de passe", back_color = 32768, text_color = 1})
    table.insert(global_term_objet_write,{x = 6, y = 7, text = "pseudo      :", back_color = 32768, text_color = 1})
    table.insert(global_term_objet_write,{x = 6, y = 9, text = "code mail   :", back_color = 32768, text_color = 1})
    table.insert(global_term_objet_write,{x = 23, y = 15, text = "envoyer", back_color = 128, text_color = 1})

    table.insert(global_term_objet_write,{x = 19, y = 7, text = global_variable["pseudo"], back_color = 128 + change_color_champ_select("pseudo"), text_color = 1})
    table.insert(global_term_objet_write,{x = 19, y = 9, text = global_variable["codemail"], back_color = 128 + change_color_champ_select("codemail"), text_color = 1})
    table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 7, ymax = 7, parametre={action="variable",nom="pseudo",type="text"}, back_color = 128 + change_color_champ_select("pseudo")})
    table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 9, ymax = 9, parametre={action="variable",nom="codemail",type="code"}, back_color = 128 + change_color_champ_select("codemail")})

    table.insert(global_term_objet_select,{xmin = 23, xmax = 29, ymin = 15, ymax = 15, parametre={action="action",id="codemail"}, back_color = 128})
end