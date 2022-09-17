function page_nav()
	table.insert(global_term_objet_write,{x = 1, y = 1, text = "pseudo", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 19, y = 1, text = "compte", back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 33, y = 1, text = "adresse", back_color = 128, text_color = 1})

	table.insert(global_term_objet_write,{x = 1, y = 2, text = global_session["pseudo"], back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 19, y = 2, text = convert_grand_nombre(global_session["compte"]), back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 33, y = 2, text = global_session["defautadresse"]["nom"], back_color = 128, text_color = 1})

	table.insert(global_term_objet_write,{x = 37, y = 19, text = ":      /  /", back_color = 32768, text_color = 1})

	table.insert(global_term_objet_write,{x = 35, y = 19, text = global_ntp["heure"], back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 38, y = 19, text = global_ntp["minute"], back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 42, y = 19, text = global_ntp["jour"], back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 45, y = 19, text = global_ntp["mois"], back_color = 32768, text_color = 1})
	table.insert(global_term_objet_write,{x = 48, y = 19, text = global_ntp["annee"], back_color = 32768, text_color = 1})

	if global_page_visible == 10 then
		table.insert(global_term_objet_select,{xmin = 1, xmax = 12, ymin = 19, ymax = 19, value={action="page",id=200}, back_color = 128})
		table.insert(global_term_objet_write,{x = 1, y = 19, text = "config poste", back_color = 128, text_color = 1})
	else
		table.insert(global_term_objet_select,{xmin = 1, xmax = 12, ymin = 19, ymax = 19, value={action="page",id=-1}, back_color = 128})
		table.insert(global_term_objet_write,{x = 1, y = 19, text = "retour", back_color = 128, text_color = 1})
	end
	if global_session["pseudo"] ~= "" and global_session["mdp"] ~= "" then
		table.insert(global_term_objet_select,{xmin = 33, xmax = 51, ymin = 1, ymax = 2, value={action="page",id=90}, back_color = 128})
	else
		table.insert(global_term_objet_select,{xmin = 33, xmax = 51, ymin = 1, ymax = 2, value={action="page",id=20}, back_color = 128})
	end
	if global_message ~= "" then
		local messagetext = split(global_message, "-")
		if messagetext[1] == "succes " then
			messagecolor = 32
		elseif messagetext[1] == "erreur " then
			messagecolor = 16384
		else
			messagecolor = 128
		end 
		table.insert(global_term_objet_write,{x = 3, y = 17, text = string.sub(messagetext[2],2), back_color = messagecolor, text_color = 1})
		table.insert(global_term_objet_select,{xmin = 2, xmax = 50, ymin = 17, ymax = 17, value={action="action",id="disable_message"}, back_color = messagecolor})
	end
end