function genere_menu_tableau(colonne_liste,liste)
	local x_colonne = 1
	for j=1, #colonne_liste do
		if global_variable["rangeliste"]["id"] == colonne_liste[j]["champ"] then
			if global_variable["rangeliste"]["mode"] == "+" then
				table.insert(global_term_objet_write,{x = x_colonne, y = global_min_y_page, text = colonne_liste[j]["text"].."v", back_color = 128, text_color = 1})
			else
				table.insert(global_term_objet_write,{x = x_colonne, y = global_min_y_page, text = colonne_liste[j]["text"].."^", back_color = 128, text_color = 1})
			end
		else
			table.insert(global_term_objet_write,{x = x_colonne, y = global_min_y_page, text = colonne_liste[j]["text"].." ", back_color = 128, text_color = 1})
		end
		table.insert(global_term_objet_select,{xmin = x_colonne, xmax = x_colonne + string.len(colonne_liste[j]["text"].." "), ymin = global_min_y_page, ymax = global_min_y_page, value={action="action",id="rangeliste",value={liste=liste,champ=colonne_liste[j]["champ"],type=colonne_liste[j]["type"]}}, back_color = 128})
		x_colonne = x_colonne + string.len(colonne_liste[j]["text"].."  ")
	end
end