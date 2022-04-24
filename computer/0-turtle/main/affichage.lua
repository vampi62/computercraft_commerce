function affichage()
	while run_prog do
		term.clear()
		term.setCursorPos(1,1)
		print("nbr d'action restant : "..#position_destination)
		print("prod /64 : "..prod_en_cours)
		print("x : "..pos_x)
		print("y : "..pos_y)
		print("z : "..pos_z)
		custom_affichage()
		sleep(0.2)
	end
end