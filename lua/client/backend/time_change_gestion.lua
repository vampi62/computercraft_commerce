function time_change_gestion()
	genere_term_affichage()
	for k ,v in pairs(global_monitor_list) do
		genere_mon_affichage(k)
	end
end