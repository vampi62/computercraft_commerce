function genere_scroll_barre(liste_ou_pas,x_barre,yval,y_min,y_max)
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
	nbr_point_par_y = math.floor(pas/(y_max-y_min))
	if nbr_point_par_y < 1 then
		nbr_point_par_y = 1
	end
	nbr_point_par_y = -nbr_point_par_y
	for j=1, y_max-y_min do
		if yval <= math.floor(nbr_point_par_y*(j-1)) and yval > math.floor(nbr_point_par_y*j) then
			table.insert(global_term_objet_select,{xmin = x_barre, xmax = x_barre, ymin = j+y_min, ymax = j+y_min, value={action="action",id="scroll",value=math.floor(nbr_point_par_y*j+1)}, back_color = 512})
			if global_edit_variable["type"] ~= "int" and global_edit_variable["type"] ~= "float" and global_edit_variable["type"] ~= "select" then
				if j == 1 then
					global_limite_scroll_haut = true
				elseif j == y_max-y_min then
					global_limite_scroll_bas = true
				end
			end
		else
			table.insert(global_term_objet_select,{xmin = x_barre, xmax = x_barre, ymin = j+y_min, ymax = j+y_min, value={action="action",id="scroll",value=math.floor(nbr_point_par_y*j+1)}, back_color = 8})
		end
	end
end