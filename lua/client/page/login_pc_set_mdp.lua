function page_login_pc_set_mdp()
	creation_variable({"mdp","mdp_len","confirm","confirm_len"},{"","","",""})
	
	table.insert(global_term_objet_write,{x = 15, y = 5, text = "mot de passe poste local", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 6, y = 7, text = "mdp         :", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 6, y = 9, text = "confirm     :", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 23, y = 15, text = "envoyer", back_color = 128, text_color = 1})

	table.insert(global_term_objet_write,{x = 19, y = 7, text = global_variable["mdp_len"], back_color = 128 + change_color_champ_select("mdp"), text_color = 1})
	table.insert(global_term_objet_write,{x = 19, y = 9, text = global_variable["confirm_len"], back_color = 128 + change_color_champ_select("confirm"), text_color = 1})
	table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 7, ymax = 7, parametre={action="variable",nom="mdp",type="code"}, back_color = 128 + change_color_champ_select("mdp")})
	table.insert(global_term_objet_select,{xmin = 19, xmax = 33, ymin = 9, ymax = 9, parametre={action="variable",nom="confirm",type="code"}, back_color = 128 + change_color_champ_select("confirm")})

	table.insert(global_term_objet_select,{xmin = 23, xmax = 29, ymin = 15, ymax = 15, parametre={action="action",id="setlocalmdp"}, back_color = 128})
	if global_message ~= "" then
		local messagetext = split(global_message, "-")
		if messagetext[1] == "succes " then
			messagecolor = 128
		elseif messagetext[1] == "erreur " then
			messagecolor = 16384
		else
			messagecolor = 32768
		end 
		table.insert(global_term_objet_write,{x = 3, y = 17, text = string.sub(messagetext[2],2), back_color = messagecolor, text_color = 1})
		table.insert(global_term_objet_select,{xmin = 2, xmax = 50, ymin = 17, ymax = 17, parametre={action="action",id="disable_message"}, back_color = messagecolor})
	end
end