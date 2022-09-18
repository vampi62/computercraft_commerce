function genere_scroll_barre(liste_ou_pas,x_barre)
	local nbr_point_par_y = 0
	local pas = 0
	if type(liste_ou_pas) == "table" then
		for j=1, #liste_ou_pas do
			pas = pas + math.floor(string.len(liste_ou_pas[j])/x_barre)
			pas = pas + 1
		end
	else
		pas = liste_ou_pas
	end
	nbr_point_par_y = math.floor(pas/(global_max_y_page-global_min_y_page))
	if nbr_point_par_y < 1 then
		nbr_point_par_y = 1
	end
	nbr_point_par_y = -nbr_point_par_y
	for j=1, global_max_y_page-global_min_y_page do
		if global_scroll <= math.floor(nbr_point_par_y*(j-1)) and global_scroll > math.floor(nbr_point_par_y*j) then
			table.insert(global_term_objet_select,{xmin = x_barre, xmax = x_barre, ymin = j+global_min_y_page, ymax = j+global_min_y_page, value={action="action",id="scroll",value=math.floor(nbr_point_par_y*j+1)}, back_color = 512})
			if global_edit_variable["type"] ~= "int" and global_edit_variable["type"] ~= "float" then
				if j == 1 then
					global_limite_scroll_haut = true
				elseif j == global_max_y_page-global_min_y_page then
					global_limite_scroll_bas = true
				end
			end
		else
			table.insert(global_term_objet_select,{xmin = x_barre, xmax = x_barre, ymin = j+global_min_y_page, ymax = j+global_min_y_page, value={action="action",id="scroll",value=math.floor(nbr_point_par_y*j+1)}, back_color = 8})
		end
	end
end