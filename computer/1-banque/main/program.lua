function program()
	while run_prog do
		if nbr_box_dispo == 1 then
			parallel.waitForAll(box(1))
		elseif nbr_box_dispo == 2 then
			parallel.waitForAll(box(1),box(2))
		elseif nbr_box_dispo == 3 then
			parallel.waitForAll(box(1),box(2),box(3))
		elseif nbr_box_dispo == 4 then
			parallel.waitForAll(box(1),box(2),box(3),box(4))
		elseif nbr_box_dispo == 5 then
			parallel.waitForAll(box(1),box(2),box(3),box(4),box(5))
		elseif nbr_box_dispo == 6 then
			parallel.waitForAll(box(1),box(2),box(3),box(4),box(5),box(6))
		elseif nbr_box_dispo == 7 then
			parallel.waitForAll(box(1),box(2),box(3),box(4),box(5),box(6),box(7))
		elseif nbr_box_dispo == 8 then
			parallel.waitForAll(box(1),box(2),box(3),box(4),box(5),box(6),box(7),box(8))
		end
	end
end

function box(numero_box)
	while run_prog do
		if (not xbox == -1 and not ybox == -1) or not textbox == "" then
			routeur(numero_box)
			xbox = -1
			ybox = -1
			textbox = ""
		end
		affichage(numero_box)
	end
end