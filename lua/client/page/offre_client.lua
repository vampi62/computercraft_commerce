function page_offre_client()
	global_limite_scroll_haut = false
	global_limite_scroll_bas = false
	genere_scroll_barre(#global_liste_offre[0],51)
	table.insert(global_term_objet_write,{x = 1, y = global_min_y_page, text = "vendeur       |nom            |prix   |stock  |", back_color = 32768, text_color = 1})
	for j=0, #global_liste_offre[0] do
		local y = global_scroll + j + global_min_y_page + 1
		if y <= global_max_y_page and y > global_min_y_page then
			table.insert(global_term_objet_write,{x = 1, y = y, text = "              |               |       |       |", back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 1, y = y, text = global_liste_offre[2][j], back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 16, y = y, text = global_liste_offre[7][j], back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 32, y = y, text = global_liste_offre[3][j], back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 41, y = y, text = global_liste_offre[4][j], back_color = 32768, text_color = 1})
			table.insert(global_term_objet_write,{x = 49, y = y, text = j, back_color = 128, text_color = 1})
			table.insert(global_term_objet_select,{xmin = 48, xmax = 50, ymin = y, ymax = y, value={action="page",id=33,value=global_liste_offre[0][j]}, back_color = 128})
		elseif y > global_max_y_page then
			break
		end
	end
end