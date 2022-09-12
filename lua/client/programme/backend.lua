function backend()
	local ancien_global_scroll = 0
	local ancien_global_ntp = -1 -- -1 pour generer l'affichage du demarrage
	local horloge_back = 0.05
	while true do
		sleep(horloge_back)
		if global_value_click["action"] ~= nil then -- click sur la fenetre terminal
			click_change_gestion()
			global_value_click = {}
		end
		if global_clavier ~= "" then -- input clavier fenetre terminal
			key_change_gestion()
			global_clavier = ""
			global_maint_key = ""
		end
		if global_scroll ~= ancien_global_scroll then -- scroll souris fenetre terminal
			scroll_change_gestion(ancien_global_scroll)
			ancien_global_scroll = global_scroll
		end
		if global_ntp["minute"] ~= ancien_global_ntp then -- changement temps
			time_change_gestion()
			ancien_global_ntp = global_ntp["minute"]
		end
		if global_rednet_message ~= "" then -- rednet message
			rednet_change_gestion()
			global_rednet_message = ""
		end
		if global_value_touch["action"] ~= nil then -- monitor_touch
			touch_change_gestion()
			global_value_touch = {}
		end


		if global_message ~= "" then
			global_compteur_tempo_message_http = global_compteur_tempo_message_http + horloge_back
			if global_compteur_tempo_message_http >= global_local_config["delay_seconde"] then
				global_message = ""
				global_compteur_tempo_message_http = 0
				genere_term_affichage()
			end
		end
	end
end