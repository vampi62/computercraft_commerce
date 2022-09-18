function page_offre_commerce()
	global_limite_scroll_haut = false
	global_limite_scroll_bas = false
	if #global_liste["offre"] < 1 then
		global_liste["offre"] = http_commande("http_offre")
	end
	genere_scroll_barre(#global_liste["offre"],51)
	table.insert(global_term_objet_write,{x = 1, y = global_min_y_page, text = "                    |        |       |     |", back_color = 32768, text_color = 1})
	local colonne_liste = {{text="nom                ",champ=8,type="string"},{text="prix   ",champ=4,type="int"},{text="stock ",champ=5,type="int"}}
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
		table.insert(global_term_objet_select,{xmin = x_colonne, xmax = x_colonne + string.len(colonne_liste[j]["text"].." "), ymin = global_min_y_page, ymax = global_min_y_page, value={action="action",id="rangeliste",value={liste="offre",champ=colonne_liste[j]["champ"],type=colonne_liste[j]["type"]}}, back_color = 128})
		x_colonne = x_colonne + string.len(colonne_liste[j]["text"].."  ")
	end
	for j=1, #global_liste["offre"] do
		local y = global_scroll + j + global_min_y_page
		if y <= global_max_y_page and y > global_min_y_page then
			table.insert(global_term_objet_write,{x = 1, y = y, text = "                    |        |       |     |", back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 1, y = y, text = global_liste["offre"][j][8], back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 23, y = y, text = convert_grand_nombre(global_liste["offre"][j][4]), back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 32, y = y, text = convert_grand_nombre(global_liste["offre"][j][5]), back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 39, y = y, text = "histo", back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 45, y = y, text = " edit ", back_color = 128, text_color = 1})
			table.insert(global_term_objet_select,{xmin = 45, xmax = 50, ymin = y, ymax = y, value={action="page",id=133,value={id=global_liste["offre"][j][1]}}, back_color = 128})
		elseif y > global_max_y_page then
			break
		end
	end
end