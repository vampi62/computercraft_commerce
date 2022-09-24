function time_change_gestion()
	--[[ -----a revoir
	if not global_http_enable then -- tentative de reconnexion
		recup_http_config()
	end
	if global_http_enable then
		if global_session["mdp"] ~= nil and global_session["pseudo"] ~= nil then
			local id_message_resync_http = http_get("listuserdata&mdp="..global_session["mdp"].."&pseudo="..global_session["pseudo"],true)
			if type(id_message_resync_http) == "table" then
				global_session = id_message_resync_http
				id_message_resync_http = nil
			end
		end
	end
	]]--
	genere_term_affichage()
	for k ,v in pairs(global_monitor_list) do
		genere_mon_affichage(k)
	end
end