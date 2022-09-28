function page_session_change_email()
    table.insert(global_term_objet_write,{x = 15, y = 5, text = "changement mot de passe", back_color = 32768, text_color = 1})
    table.insert(global_term_objet_write,{x = 6, y = 7, text = "mdp         :", back_color = 32768, text_color = 1})
    table.insert(global_term_objet_write,{x = 6, y = 9, text = "confirm     :", back_color = 32768, text_color = 1})
    table.insert(global_term_objet_write,{x = 6, y = 11, text = "ancien mdp  :", back_color = 32768, text_color = 1})
    table.insert(global_term_objet_write,{x = 23, y = 15, text = "envoyer", back_color = 128, text_color = 1})

    table.insert(global_term_objet_write,{x = 19, y = 7, text = global_variable["mdp_len"], back_color = 128 + change_color_champ_select("mdp"), text_color = 1})
    table.insert(global_term_objet_write,{x = 19, y = 9, text = global_variable["confirm_len"], back_color = 128 + change_color_champ_select("confirm"), text_color = 1})
    table.insert(global_term_objet_write,{x = 19, y = 11, text = global_variable["ancienmdp_len"], back_color = 128 + change_color_champ_select("ancienmdp"), text_color = 1})
    table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 7, ymax = 7, parametre={action="variable",nom="mdp",type="code"}, back_color = 128 + change_color_champ_select("mdp")})
    table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 9, ymax = 9, parametre={action="variable",nom="confirm",type="code"}, back_color = 128 + change_color_champ_select("confirm")})
    table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 11, ymax = 11, parametre={action="variable",nom="ancienmdp",type="code"}, back_color = 128 + change_color_champ_select("ancienmdp")})
    
    table.insert(global_term_objet_select,{xmin = 23, xmax = 29, ymin = 15, ymax = 15, parametre={action="action",id="changemdp"}, back_color = 128})
end