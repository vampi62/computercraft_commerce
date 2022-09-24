function page_menu()
	table.insert(global_term_objet_write,{x = 23, y = 5, text = "session", back_color = 128, text_color = 1})

	table.insert(global_term_objet_write,{x = 12, y = 6, text = "PORTAIL", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 12, y = 7, text = "CLIENT", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 9, y = 9, text = "offres", back_color = 128, text_color = 1})
	table.insert(global_term_objet_write,{x = 9, y = 11, text = "commandes", back_color = 128, text_color = 1})
	table.insert(global_term_objet_write,{x = 9, y = 13, text = "transactions", back_color = 128, text_color = 1})

	table.insert(global_term_objet_write,{x = 33, y = 6, text = "PORTAIL", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 33, y = 7, text = "COMMERCE", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 31, y = 9, text = "offres", back_color = 128, text_color = 1})
	table.insert(global_term_objet_write,{x = 31, y = 11, text = "commandes", back_color = 128, text_color = 1})

	table.insert(global_term_objet_select,{xmin = 9, xmax = 21, ymin = 9, ymax = 9, value={action="page",id=30}, back_color = 128})

	if global_session["pseudo"] ~= "" and global_session["mdp"] ~= "" then
		table.insert(global_term_objet_select,{xmin = 9, xmax = 21, ymin = 11, ymax = 11, value={action="page",id=50}, back_color = 128})
		table.insert(global_term_objet_select,{xmin = 9, xmax = 21, ymin = 13, ymax = 13, value={action="page",id=60}, back_color = 128})

		table.insert(global_term_objet_select,{xmin = 31, xmax = 43, ymin = 9, ymax = 9, value={action="page",id=130}, back_color = 128})
		table.insert(global_term_objet_select,{xmin = 31, xmax = 43, ymin = 11, ymax = 11, value={action="page",id=150}, back_color = 128})
	else
		table.insert(global_term_objet_select,{xmin = 9, xmax = 21, ymin = 11, ymax = 11, value={action="page",id=20}, back_color = 128})
		table.insert(global_term_objet_select,{xmin = 9, xmax = 21, ymin = 13, ymax = 13, value={action="page",id=20}, back_color = 128})

		table.insert(global_term_objet_select,{xmin = 31, xmax = 43, ymin = 9, ymax = 9, value={action="page",id=20}, back_color = 128})
		table.insert(global_term_objet_select,{xmin = 31, xmax = 43, ymin = 11, ymax = 11, value={action="page",id=20}, back_color = 128})
	end

	table.insert(global_term_objet_select,{xmin = 22, xmax = 30, ymin = 5, ymax = 5, value={action="page",id=20}, back_color = 128})
end