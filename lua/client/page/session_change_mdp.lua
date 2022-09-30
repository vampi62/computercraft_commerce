function page_session_change_mdp()
	table.insert(global_term_objet_write,{x = 19, y = 5, text = "changement email", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 6, y = 7, text = "email       :", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 23, y = 15, text = "envoyer", back_color = 128, text_color = 1})

	table.insert(global_term_objet_write,{x = 19, y = 7, text = global_variable["email"], back_color = 128 + change_color_champ_select("email"), text_color = 1})
	table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 7, ymax = 7, parametre={action="variable",nom="email",type="text"}, back_color = 128 + change_color_champ_select("email")})

	table.insert(global_term_objet_select,{xmin = 23, xmax = 29, ymin = 15, ymax = 15, parametre={action="action",id="changemail"}, back_color = 128})
end